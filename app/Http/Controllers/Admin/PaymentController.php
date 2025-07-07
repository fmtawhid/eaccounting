<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PaymentsExport;
use App\Http\Controllers\Controller;
use App\Models\Bibag;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use App\Models\Purpose;
use App\Models\Brance;
use App\Models\Account;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use App\Helpers\SmsHelper;

class PaymentController extends Controller
{
    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    public static function middlewareList(): array
    {
        return [
            'permission:payment_view' => ['index'],
            'permission:payment_add' => ['create', 'store'],
            'permission:payment_edit' => ['edit', 'update'],
            'permission:payment_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        

        $purposes = Purpose::all();
        $branches = Brance::all();
        $accounts = Account::all();
        return view('admin.payment.index', compact('purposes', 'branches', 'accounts'));
    }

    public function payment_report(Request $request)
    {
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : null;
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : null;
        $purpose_id = $request->input('purpose_id');
        $brance_id = $request->input('brance_id');     // <-- Add this
        $account_id = $request->input('account_id');   // <-- Add this
        $query = Payment::with(['purpose', 'brance', 'account'])->latest();

        // যদি soft delete থাকে, তাহলে নিচের লাইন যোগ করুন:
        // $query->whereNull('deleted_at');

        if ($fromDate && $toDate) {
            if ($fromDate > $toDate) {
                return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
            }
            $query->whereDate('payments.date', '>=', $fromDate)
                  ->whereDate('payments.date', '<=', $toDate);
        } elseif ($fromDate) {
            $query->whereDate('payments.date', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('payments.date', '<=', $toDate);
        }

        if ($purpose_id) {
            $query->where('payments.purpose_id', $purpose_id);
        }
        if ($brance_id) {
            $query->where('payments.brance_id', $brance_id);
        }
        if ($account_id) {
            $query->where('payments.account_id', $account_id);
        }

        $totalAmount = $query->sum('amount');

        if (request()->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('amount', fn($row) => $row->amount . " TK")
                ->addColumn('purpose', fn($row) => optional($row->purpose)->purpose_name ?? 'N/A')
                ->addColumn('branch', fn($row) => optional($row->brance)->name ?? 'N/A')
                ->addColumn('account', fn($row) => optional($row->account)->name ?? 'N/A')
                
                ->addColumn('date', fn($row) => $row->date ? Carbon::parse($row->date)->format("d-m-Y") : 'N/A')
                ->addColumn('actions', function ($row) {
                    $delete_api = route('payments.destroy', $row);
                    $edit_api = route('payments.edit', $row);
                    $csrf = csrf_token();
                    return <<<CODE
                    <form method='POST' action='$delete_api' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>
                        <a class='btn btn-info btn-sm m-1' href='$edit_api'><i class="ri-edit-box-fill"></i></a>
                        <button type='submit' class='btn delete btn-danger btn-sm m-1'><i class="ri-delete-bin-fill"></i></button>
                    </form>
                    <button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}'><i class="ri-eye-fill"></i></button>
                    CODE;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $purposes = Purpose::all();
        $branches = Brance::all();
        $accounts = Account::all();
        
        return view('admin.payment.payments_report', compact('purposes', 'totalAmount', 'fromDate', 'toDate', 'purpose_id', 'branches', 'accounts'));
    }

    public function store(Request $request)
{
    $request->validate([
        'reciept_no' => 'required|unique:payments,reciept_no',
        'date' => 'required|date_format:d-m-Y',
        'name' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'amount_in_words' => 'required|string|max:255',
        'purpose_id' => 'required|exists:purposes,id',
        'brance_id' => 'required|exists:brances,id',
        'account_id' => 'required|exists:accounts,id',
        'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
    ]);

    // Payment Create
    $payment = Payment::create([
        'reciept_no' => $request->reciept_no,
        'date' => Carbon::createFromFormat('d-m-Y', $request->date),
        'name' => $request->name,
        'purpose_id' => $request->purpose_id,
        'brance_id' => $request->brance_id,
        'account_id' => $request->account_id,
        'amount' => $request->amount,
        'amount_in_words' => $request->amount_in_words,
    ]);

    // Attachments Upload & Save
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $storedName = $filename . '_' . time() . '.' . $extension;
            $file->move(public_path('assets/attachements'), $storedName);

            PaymentAttachment::create([
                'payment_id' => $payment->id,
                'file_path' => $storedName,
                'file_name' => $storedName,
                'file_type' => $extension,
            ]);
        }
    }

    // Update Account amount (balance) by adding the payment amount
    $account = Account::find($request->account_id);
    if ($account) {
        $account->amount += $request->amount;  // amount field ধরে নিচ্ছি ব্যালেন্স হিসেবে
        $account->save();
    }

    return response()->json(['success' => 'Payment created successfully']);
}


    public function edit(Payment $payment)
    {
        $purposes = Purpose::all();
        $branches = Brance::all();
        $accounts = Account::all();
        $attachments = $payment->attachments()->get();
        return view('admin.payment.edit', compact('payment', 'purposes', 'attachments', 'branches', 'accounts'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'reciept_no' => 'required|unique:payments,reciept_no,' . $payment->id,
            'date' => 'required|date_format:d-m-Y',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'purpose_id' => 'required|exists:purposes,id',
            'brance_id' => 'required|exists:brances,id',
            'account_id' => 'required|exists:accounts,id',
            'amount_in_words' => 'required|string|max:255',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
            'delete_attachments' => 'array',
            'delete_attachments.*' => 'integer|exists:payment_attachments,id',
        ]);

        // আগের অ্যাকাউন্ট (যে একাউন্টে আগে পেমেন্ট ছিল)
        $oldAccount = Account::find($payment->account_id);
        // নতুন অ্যাকাউন্ট (যে একাউন্টে এখন পেমেন্ট হবে)
        $newAccount = Account::find($request->account_id);

        // আগের অ্যাকাউন্ট থেকে আগের amount কমানো
        if ($oldAccount) {
            $oldAccount->amount -= $payment->amount;
            if ($oldAccount->amount < 0) {
                $oldAccount->amount = 0; // নেগেটিভ ব্যালেন্স হলে 0 সেট করা হলো, দরকারে পরিবর্তন করো
            }
            $oldAccount->save();
        }

        // পেমেন্ট আপডেট
        $payment->update([
            'reciept_no' => $request->reciept_no,
            'date' => Carbon::createFromFormat('d-m-Y', $request->date),
            'name' => $request->name,
            'amount' => $request->amount,
            'purpose_id' => $request->purpose_id,
            'brance_id' => $request->brance_id,
            'account_id' => $request->account_id,
            'amount_in_words' => $request->amount_in_words,
        ]);

        // নতুন অ্যাকাউন্টে amount যোগ করা
        if ($newAccount) {
            $newAccount->amount += $request->amount;
            $newAccount->save();
        }

        // ডিলিট করার জন্য অ্যাটাচমেন্টস
        if ($request->has('delete_attachments')) {
            $attachmentsToDelete = PaymentAttachment::whereIn('id', $request->delete_attachments)->get();
            foreach ($attachmentsToDelete as $attachment) {
                if (file_exists(public_path('assets/attachements/' . $attachment->file_path))) {
                    unlink(public_path('assets/attachements/' . $attachment->file_path));
                }
                $attachment->delete();
            }
        }

        // নতুন অ্যাটাচমেন্ট ফাইল আপলোড
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $file->move(public_path('assets/attachements'), $fileNameToStore);

                PaymentAttachment::create([
                    'payment_id' => $payment->id,
                    'file_path' => $fileNameToStore,
                    'file_name' => $filenameWithExt,
                    'file_type' => $extension
                ]);
            }
        }

        return redirect()->route('payments.report')->with('success', 'Payment updated successfully.');
    }


    public function destroy(Payment $payment)
    {
        try {
            $payment->delete(); // Soft Delete
            return response()->json([
                'success' => true,
                'message' => 'Payment deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete payment.'
            ], 500);
        }
    }



    public function exportExcel(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'purpose_id' => 'nullable|exists:purposes,id',
            'brance_id' => 'nullable|exists:brances,id',
            'account_id' => 'nullable|exists:accounts,id',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : null;
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : null;
        $purposeId = $request->input('purpose_id');
        $branceId = $request->input('brance_id');
        $accountId = $request->input('account_id');

        $filename = 'payment';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y') . '_to_' . $toDate->format('d-m-Y');
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y');
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate->format('d-m-Y');
        }
        $filename .= '.xlsx';

        return Excel::download(new PaymentsExport($fromDate, $toDate, $purposeId, $branceId, $accountId), $filename);
    }

    public function exportPDF(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'purpose_id' => 'nullable|exists:purposes,id',
            'brance_id' => 'nullable|exists:brances,id',
            'account_id' => 'nullable|exists:accounts,id',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : null;
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : null;
        $purposeId = $request->input('purpose_id');
        $branceId = $request->input('brance_id');
        $accountId = $request->input('account_id');

        $query = Payment::with('purpose')->latest();

        $query->when($fromDate, fn($q) => $q->whereDate('payments.created_at', '>=', $fromDate));
        $query->when($toDate, fn($q) => $q->whereDate('payments.created_at', '<=', $toDate));
        $query->when($purposeId, fn($q) => $q->where('payments.purpose_id', $purposeId));
        $query->when($branceId, fn($q) => $q->where('payments.brance_id', $branceId));
        $query->when($accountId, fn($q) => $q->where('payments.account_id', $accountId));

        $payments = $query->get();
        $totalAmount = $payments->sum('amount');

        $purposeName = $purposeId ? Purpose::find($purposeId)?->purpose_name : null;
        $branceName = $branceId ? Brance::find($branceId)?->name : null;
        $accountName = $accountId ? Account::find($accountId)?->name : null;

        $filename = 'payment';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y') . '_to_' . $toDate->format('d-m-Y');
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate->format('d-m-Y');
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate->format('d-m-Y');
        }
        $filename .= '.pdf';

        $pdf = Pdf::loadView('admin.payment.export_pdf', [
            'payments' => $payments,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'totalAmount' => $totalAmount,
            'purposeName' => $purposeName,
            'branceName' => $branceName,
            'accountName' => $accountName,
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }

    public function getAttachments(Payment $payment)
    {
        $attachments = $payment->attachments()->get(['file_path', 'file_name', 'file_type']);

        $attachments = $attachments->map(function ($attachment) {
            return [
                'url' => asset('assets/attachements/' . $attachment->file_path),
                'name' => $attachment->file_name,
                'file_type' => $attachment->file_type
            ];
        });

        return response()->json(['attachments' => $attachments]);
    }
}
