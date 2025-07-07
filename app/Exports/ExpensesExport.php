<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExpensesExport implements FromView
{

    protected $fromDate;
    protected $toDate;
    protected $expense_head_id;

    public function __construct($fromDate, $toDate,$expense_head_id)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->expense_head_id = $expense_head_id;
    }


    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {
        // Build the query with necessary joins and filters
        $query = Expense::with('expenseHead')
        ->join('expense_heads', 'expense_heads.id', '=', 'expenses.expense_head_id')
        ->select('expenses.*', 'expense_heads.expense_head_name as expense_head_name')
        ->latest();

        // Apply date filters
        if ($this->fromDate && $this->toDate) {
            $query->whereDate('expenses.date', '>=', $this->fromDate)
                ->whereDate('expenses.date', '<=', $this->toDate);
        } elseif ($this->fromDate) {
            $query->whereDate('expenses.date', '>=', $this->fromDate);
        } elseif ($this->toDate) {
            $query->whereDate('expenses.date', '<=', $this->toDate);
        }

        if ($this->expense_head_id) {
            $query->where('expenses.expense_head_id', $this->expense_head_id);
        }
        $expenses = $query->get();

        return view('admin.expenses.export_pdf', [
            'expenses' => $expenses,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ]);
    }
}
