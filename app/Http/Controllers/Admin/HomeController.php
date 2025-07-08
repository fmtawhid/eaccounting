<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Payment;
use App\Models\Expense;
use App\Models\Account;
use App\Models\Brance; // Assuming you have a Brance model

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function dashboard(Request $request)
    {
    $filter = $request->input('filter', 'all');

    switch ($filter) {
        case '7days': $from = Carbon::now()->subDays(7); break;
        case '15days': $from = Carbon::now()->subDays(15); break;
        case '30days': $from = Carbon::now()->subDays(30); break;
        case '6months': $from = Carbon::now()->subMonths(6); break;
        case '1year': $from = Carbon::now()->subYear(); break;
        case '5years': $from = Carbon::now()->subYears(5); break;
        case 'this_month': $from = Carbon::now()->startOfMonth(); break;
        default: $from = null;
    }

    $paymentsQuery = Payment::query();
    $expensesQuery = Expense::query();

    if ($from) {
        $paymentsQuery->where('created_at', '>=', $from);
        $expensesQuery->where('created_at', '>=', $from);
    }

    $totalAmount = $paymentsQuery->sum('amount');
    $totalExpenses = $expensesQuery->sum('amount');
    $totalProfit = $totalAmount - $totalExpenses;

    $accounts = Account::with('brance')->get();

    $brances = Brance::with(['payments', 'expenses'])->get()->map(function ($brance) use ($from) {
        $paymentSum = $from
            ? $brance->payments()->where('created_at', '>=', $from)->sum('amount')
            : $brance->payments()->sum('amount');

        $expenseSum = $from
            ? $brance->expenses()->where('created_at', '>=', $from)->sum('amount')
            : $brance->expenses()->sum('amount');

        return [
            'id' => $brance->id,
            'name' => $brance->name,
            'total_payment' => $paymentSum,
            'total_expense' => $expenseSum,
            'net_balance' => $paymentSum - $expenseSum,
        ];
    });

    
    // ✅ Monthly Data for Chart
    $monthlyExpenses = Expense::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
        ->when($from, fn($q) => $q->where('date', '>=', $from))
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

    $monthlyPayments = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
        ->when($from, fn($q) => $q->where('date', '>=', $from))
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

    // Fill in missing months
    $expensesData = $paymentsData = array_fill(1, 12, 0);
    foreach ($monthlyExpenses as $month => $amount) {
        $expensesData[$month] = round($amount, 2);
    }
    foreach ($monthlyPayments as $month => $amount) {
        $paymentsData[$month] = round($amount, 2);
    }

    $branchPieChart = $brances->map(function ($branch) {
        return [
            'name' => $branch['name'],
            'value' => $branch['net_balance'],
        ];
    })->values();

        return view('admin.dashboard.index', compact(
        'totalAmount', 'totalExpenses', 'totalProfit', 'filter',
        'accounts', 'brances',
        'expensesData', 'paymentsData',
        'branchPieChart'
    ));


    }

}