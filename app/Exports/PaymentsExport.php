<?php
namespace App\Exports;

use App\Models\Payment;
use App\Models\Purpose;
use App\Models\Brance;
use App\Models\Account;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentsExport implements FromView
{
    protected $fromDate;
    protected $toDate;
    protected $purpose_id;
    protected $brance_id; // Uncomment if needed
    protected $account_id; // Uncomment if needed

    public function __construct($fromDate, $toDate, $purpose_id, $brance_id = null, $account_id = null)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->purpose_id = $purpose_id;
        // Uncomment if needed
        $this->brance_id = $brance_id;
        $this->account_id = $account_id;
    }

    public function view(): View
    {
        $query = Payment::with('sreni', 'bibag', 'purpose')->latest();

        if ($this->fromDate) {
            $query->whereDate('payments.created_at', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('payments.created_at', '<=', $this->toDate);
        }

        if ($this->purpose_id) {
            $query->where('payments.purpose_id', $this->purpose_id);
        }

 
        // Uncomment if needed
        if ($this->brance_id) {
            $query->where('payments.brance_id', $this->brance_id);
        }
        if ($this->account_id) {
            $query->where('payments.account_id', $this->account_id);
        }

        $payments = $query->get();
        $totalAmount = $payments->sum('amount');

        $purposeName = $this->purpose_id ? Purpose::find($this->purpose_id)?->name : null;
        $branceName = $this->brance_id ? Brance::find($this->brance_id)?->name : null;
        $accountName = $this->account_id ? Account::find($this->account_id)?->name : null;


        return view('admin.payment.export_pdf', [
            'payments' => $payments,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'totalAmount' => $totalAmount,
            'purposeName' => $purposeName,
            'branceName' => $branceName,
            'accountName' => $accountName,
        ]);
    }
}


