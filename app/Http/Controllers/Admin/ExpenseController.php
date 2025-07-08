<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExpensesExport;
use App\Models\Expense;
use App\Models\ExpenseAttachment;
use App\Models\ExpenseHead;
use App\Models\Brance;
use App\Models\Account;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DataTables;
use Excel;
use Illuminate\Support\Facades\DB;  // যদি না থাকে তবে উপরে যোগ করো

class ExpenseController extends Controller
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
            'permission:expense_view' => [ 'export_report'],
            'permission:expense_add' => ['create', 'store', 'index'],
            'permission:expense_edit' => ['edit', 'update'],
            'permission:expense_delete' => ['destroy'],
        ];
    }
    
    public function index()
{
    // Fetch expenses with their associated expense head, joined with expense_heads table
    $expensesQuery = Expense::with('expenseHead')
        ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
        ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
        ->latest();

    // Fetch all expense heads for dropdowns or filters in the view
    $expenseHeads = ExpenseHead::all();
    $brances= Brance::all();
    $accounts = Account::all();

    // Check if the request is an AJAX call
    if (request()->ajax()) {
        return DataTables::of($expensesQuery)
            ->addIndexColumn() // Adds a sequential index column
            ->addColumn('created_at_read', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('expense_head', function ($row) {
                return $row->expense_head_name;
            })
            ->addColumn('brance_name', function ($row) {
                return optional($row->brance)->name; // Assuming 'brance' relationship exists
            })
            ->addColumn('account_name', function ($row) {
                return optional($row->account)->name; // Assuming 'account' relationship exists
            })
            ->addColumn('date', function ($row) {
                $date = $row->date ? new Carbon($row->date) : null;
                return $date ? $date->format("d-m-Y") : 'N/A';
            })
            ->addColumn('amount', function ($row) {
                return $row->amount . " TK";
            })

            ->addColumn('actions', function ($row) {
                $delete_api = route('expenses.destroy', $row);
                $edit_api = route('expenses.edit', $row);
                $csrf = csrf_token();
                $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                    <input name='_method' type='hidden' value='DELETE'>
                    <input name='_token' type='hidden' value='$csrf'>";

                // Add Edit Button if the user has the 'expense_edit' permission
                if (auth()->user()->can('expense_edit')) {
                    $action .= "<a class='btn btn-info btn-sm m-1' data-toggle='tooltip' title='Edit expense details' href='$edit_api'>
                        <i class='ri-edit-box-fill'></i>
                    </a>";
                }

                // Add Delete Button if the user has the 'expense_delete' permission
                if (auth()->user()->can('expense_delete')) {
                    $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' title='Delete expense'>
                        <i class='ri-delete-bin-fill'></i>
                    </button>";
                }

                // Close the form tag
                $action .= "</form>";

                // Add additional buttons like 'View Attachments'
                $action .= "<button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                    <i class='ri-eye-fill'></i>
                </button>";

                return $action;
            })
            ->rawColumns(['created_at_read', 'actions', 'expense_head'])
            ->make(true);
    }

    // Return the view with expenses and expense heads data
    return view('admin.expenses.expense_report', compact('expenseHeads', 'brances', 'accounts'));
}


    
    
public function export_report(Request $request)
{
    // Retrieve date filters from the request
    $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y', $request->input('from_date')) : "";
    $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
    $expense_head_id = $request->input('expense_head_id');
    $brance_id = $request->input('brance_id');
    $account_id = $request->input('account_id');
    

    $expensesQuery = Expense::with('expenseHead')
        ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
        ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
        ->latest();

    // Apply date filters if provided
    if ($fromDate && $toDate) {
        if ($fromDate > $toDate) {
            return redirect()->back()->with('error', 'From Date cannot be greater than To Date.');
        }

        $expensesQuery->whereDate('expenses.date', '>=', $fromDate)
            ->whereDate('expenses.date', '<=', $toDate);
    } elseif ($fromDate) {
        $expensesQuery->whereDate('expenses.date', '>=', $fromDate);
    } elseif ($toDate) {
        $expensesQuery->whereDate('expenses.date', '<=', $toDate);
    }

    if ($expense_head_id) {
        $expensesQuery->where('expenses.expense_head_id', $expense_head_id);
    }
    if ($brance_id) {
        $expensesQuery->where('expenses.brance_id', $brance_id);
    }
    if ($account_id) {
        $expensesQuery->where('expenses.account_id', $account_id);
    }   


    $expenseHeads = ExpenseHead::all();
    $brances = Brance::all();
    $accounts = Account::all();

    // Get the filtered expenses for calculating the total
    $filteredExpenses = $expensesQuery->get();

    // Calculate total amount for filtered expenses only
    $totalAmount = $filteredExpenses->sum('amount');

    // Handling DataTables for AJAX request
    if (request()->ajax()) {
        return DataTables::of($expensesQuery)
            ->addIndexColumn() // Adds a sequential index column
            ->addColumn('created_at_read', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->addColumn('expense_head', function ($row) {
                return $row->expense_head_name;
            })
            ->addColumn('brance_name', function ($row) {
                return optional($row->brance)->name; // Assuming 'brance' relationship exists
            })
            ->addColumn('account_name', function ($row) {
                return optional($row->account)->name; // Assuming 'account' relationship exists
            })
            ->addColumn('amount', function ($row) {
                return $row->amount . " TK";
            })
            ->addColumn('date', function ($row) {
                $date = $row->date ? new Carbon($row->date) : null;
                return $date ? $date->format("d-m-Y") : 'N/A';
            })
            ->addColumn('actions', function ($row) {
                $delete_api = route('expenses.destroy', $row);
                $edit_api = route('expenses.edit', $row);
                $csrf = csrf_token();
                $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                    <input name='_method' type='hidden' value='DELETE'>
                    <input name='_token' type='hidden' value='$csrf'>";

                if (auth()->user()->can('expense_edit')) {
                    $action .= "<a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Edit expense details' href='$edit_api'>
                        <i class='ri-edit-box-fill'></i>
                    </a>";
                }

                if (auth()->user()->can('expense_delete')) {
                    $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='Delete expense'>
                        <i class='ri-delete-bin-fill'></i>
                    </button>";
                }

                $action .= "</form>";
                $action .= "<button type='button' class='btn btn-secondary btn-sm m-1 view-attachments' data-id='{$row->id}' title='View Attachments'>
                    <i class='ri-eye-fill'></i>
                </button>";

                return $action;
            })
            ->rawColumns(['created_at_read', 'actions', 'expense_head'])
            ->make(true);
    }

    $totalAmount = $filteredExpenses->sum('amount');
    // Return the view with filtered expenses, total amount, and expense heads data
    return view('admin.expenses.expense_report', compact('expenseHeads', 'totalAmount', 'brances', 'accounts', 'fromDate', 'toDate', 'expense_head_id', 'brance_id', 'account_id'));
}


    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        $expenseHeads = ExpenseHead::all();
        $brances = Brance::all();
        $accounts = Account::all();
        return view('admin.expenses.create', compact('expenseHeads', 'brances', 'accounts'));
    }

    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_head_id' => 'required|exists:expense_heads,id',
            'name' => 'required|string|max:255',
            'invoice_no' => 'required|string|max:255|unique:expenses,invoice_no',
            'date' => 'required|date_format:d-m-Y',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:500',
            'brance_id' => 'required|exists:brances,id',
            'account_id' => 'required|exists:accounts,id',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
        ]);

        DB::beginTransaction();  // ট্রাঞ্জেকশন শুরু

        try {
            $expense = Expense::create([
                'expense_head_id' => $request->expense_head_id,
                'name' => $request->name,
                'invoice_no' => $request->invoice_no,
                'date' => Carbon::createFromFormat('d-m-Y', $request->date),
                'amount' => $request->amount,
                'note' => $request->note,
                'brance_id' => $request->brance_id,
                'account_id' => $request->account_id,
            ]);

            // অ্যাকাউন্ট থেকে amount বিয়োগ
            $account = Account::findOrFail($request->account_id);

            // amount থেকে এক্সপেন্সের amount বিয়োগ করে আপডেট
            $account->amount = $account->amount - $request->amount;
            if($account->amount < 0){
                // যদি amount নেতিবাচক হয়, তাহলে ত্রুটি দেখানো যেতে পারে
                return response()->json(['error' => 'Account balance cannot be negative'], 422);
            }
            $account->save();

            // attachments handle
            if ($request->hasFile('attachments')) {
                $files = $request->file('attachments');
                foreach ($files as $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $file->move(public_path('assets/attachements'), $fileNameToStore);

                    ExpenseAttachment::create([
                        'expense_id' => $expense->id,
                        'file_path' => $fileNameToStore,
                        'file_name' => $fileNameToStore,
                        'file_type' => $extension,
                    ]);
                }
            }

            DB::commit();  // সফল হলে কমিট

            return response()->json(['success' => "Expense created Successfully"]);

        } catch (\Exception $e) {
            DB::rollback();  // সমস্যা হলে রোলব্যাক

            return response()->json(['error' => 'Failed to create expense: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified expense.
     */


    public function edit(Expense $expense)
    {
        $expenseHeads = ExpenseHead::all();
        $brances = Brance::all();
        $accounts = Account::all();
        $attachments = $expense->attachments()->get();
        return view('admin.expenses.edit', compact('expense', 'expenseHeads', 'attachments', 'brances', 'accounts'));
    }

    
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_head_id' => 'required|exists:expense_heads,id',
            'name' => 'required|string|max:255',
            'invoice_no' => 'required|string|max:255|unique:expenses,invoice_no,' . $expense->id,
            'date' => 'required|date_format:d-m-Y',
            'amount' => 'required|numeric|min:0',
            'brance_id' => 'required|exists:brances,id',
            'account_id' => 'required|exists:accounts,id',
            'note' => 'nullable|string|max:500',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,pdf|max:512',
            'delete_attachments' => 'array',
            'delete_attachments.*' => 'integer|exists:expense_attachments,id',
        ]);

        DB::beginTransaction();

        try {
            // আগের অ্যাকাউন্ট থেকে আগের এক্সপেন্সের amount যোগ করে দাও
            $oldAccount = Account::findOrFail($expense->account_id);
            $oldAccount->amount += $expense->amount;
            $oldAccount->save();

            // নতুন এক্সপেন্স ডেটা আপডেট করো
            $expense->update([
                'expense_head_id' => $request->expense_head_id,
                'name' => $request->name,
                'invoice_no' => $request->invoice_no,
                'date' => Carbon::createFromFormat('d-m-Y', $request->date),
                'amount' => $request->amount,
                'note' => $request->note,
                'brance_id' => $request->brance_id,
                'account_id' => $request->account_id,
            ]);

            // নতুন অ্যাকাউন্ট থেকে amount বিয়োগ করো
            $newAccount = Account::findOrFail($request->account_id);
            $newAccount->amount -= $request->amount;
            if($newAccount->amount < 0){
                DB::rollback();
                return response()->json(['error' => 'Account balance cannot be negative'], 422);
            }
            $newAccount->save();

            // Delete attachments if requested
            if ($request->has('delete_attachments')) {
                $attachmentsToDelete = ExpenseAttachment::whereIn('id', $request->delete_attachments)->get();

                foreach ($attachmentsToDelete as $attachment) {
                    if (file_exists(public_path('assets/attachements/' . $attachment->file_path))) {
                        unlink(public_path('assets/attachements/' . $attachment->file_path));
                    }
                    $attachment->delete();
                }
            }

            // Handle new attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $file->move(public_path('assets/attachements'), $fileNameToStore);

                    ExpenseAttachment::create([
                        'expense_id' => $expense->id,
                        'file_path' => $fileNameToStore,
                        'file_name' => $filenameWithExt,
                        'file_type' => $extension
                    ]);
                }
            }

            DB::commit();

            return response()->json(['success' => "Expense updated successfully"]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to update expense: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified expense from storage.
     */
    public function destroy(Expense $expense)
    {
        foreach ($expense->attachments as $attachment) {
            $filePath = public_path('assets/attachements/' . $attachment->file_path); // fix folder name to match upload
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $expense->delete();

        return redirect()->route('expense.report')->with('success', 'Expense deleted successfully.');
    }


    public function getAttachments(Expense $expense)
    {
        $attachments = $expense->attachments()->get(['file_path', 'file_name', 'file_type']);

        // Generate URLs for the attachments
        $attachments = $attachments->map(function ($attachment) {
            return [
                'url' => asset('assets/attachements/' . $attachment->file_path),
                'name' => $attachment->file_name,
                'file_type' => $attachment->file_type
            ];
        });

        return response()->json(['attachments' => $attachments]);
    }



    public function exportExcel(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);

        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y',$request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $expense_head_id = $request->input('expense_head_id');

        // Format for the filename to include date range
        $filename = 'expense';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.xlsx';

        return Excel::download(new ExpensesExport($fromDate, $toDate,$expense_head_id), $filename);
    }

    // Export to PDF
    public function exportPDF(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ], [
            'to_date.after_or_equal' => 'To Date must be a date after or equal to From Date.',
        ]);
        $fromDate = $request->input('from_date') ? Carbon::createFromFormat('d-m-Y',$request->input('from_date')) : "";
        $toDate = $request->input('to_date') ? Carbon::createFromFormat('d-m-Y', $request->input('to_date')) : "";
        $expense_head_id = $request->input('expense_head_id');
        $brance_id = $request->input('brance_id');
        $account_id = $request->input('account_id');

        // Build the query with necessary joins and filters
        $query = Expense::with(['expenseHead', 'brance', 'account']) // include relations
            ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
            ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
            ->latest();

        // Apply date filters
        if ($fromDate && $toDate) {
            $query->whereDate('expenses.date', '>=', $fromDate)
                ->whereDate('expenses.date', '<=', $toDate);
        } elseif ($fromDate) {
            $query->whereDate('expenses.date', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('expenses.date', '<=', $toDate);
        }
        if ($expense_head_id) {
            $query->where('expenses.expense_head_id', $expense_head_id);
        }
        if ($brance_id) {
            $query->where('expenses.brance_id', $brance_id);
        }
        if ($account_id) {
            $query->where('expenses.account_id', $account_id);
        }

        $expenses = $query->get();

        // Format for the filename to include date range
        $filename = 'expense';
        if ($fromDate && $toDate) {
            $filename .= '_from_' . $fromDate . '_to_' . $toDate;
        } elseif ($fromDate) {
            $filename .= '_from_' . $fromDate;
        } elseif ($toDate) {
            $filename .= '_to_' . $toDate;
        }
        $filename .= '.pdf';

        $pdf = Pdf::loadView('admin.expenses.export_pdf', [
            'expenses' => $expenses,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'expense_head_id' => $expense_head_id,
            'brance_id' => $brance_id,
            'account_id' => $account_id,
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }
        public function getAccountsByBrance($brance_id)
    {
        $accounts = Account::where('brance_id', $brance_id)->get(['id', 'name', 'number']);
        return response()->json($accounts);
    }
}
