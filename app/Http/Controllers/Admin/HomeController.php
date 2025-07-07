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



    // public function dashboard(Request $request)
    // {
    //     $filter = $request->input('filter', 'all');

    //     switch ($filter) {
    //         case '7days':
    //             $from = Carbon::now()->subDays(7);
    //             break;
    //         case '15days':
    //             $from = Carbon::now()->subDays(15);
    //             break;
    //         case '30days':
    //             $from = Carbon::now()->subDays(30);
    //             break;
    //         case '6months':
    //             $from = Carbon::now()->subMonths(6);
    //             break;
    //         case '1year':
    //             $from = Carbon::now()->subYear();
    //             break;
    //         case '5years':
    //             $from = Carbon::now()->subYears(5);
    //             break;
    //         case 'this_month':
    //             $from = Carbon::now()->startOfMonth();
    //             break;
    //         default:
    //             $from = null;
    //     }

    //     $paymentsQuery = Payment::query();
    //     $expensesQuery = Expense::query();

    //     if ($from) {
    //         $paymentsQuery->where('created_at', '>=', $from);
    //         $expensesQuery->where('created_at', '>=', $from);
    //     }

    //     $totalAmount = $paymentsQuery->sum('amount');
    //     $totalExpenses = $expensesQuery->sum('amount');
    //     $totalProfit = $totalAmount - $totalExpenses;

    //     return view('admin.dashboard.index', [
    //         'totalAmount' => $totalAmount,
    //         'totalExpenses' => $totalExpenses,
    //         'totalProfit' => $totalProfit,
    //         'filter' => $filter
    //     ]);
    // }


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
        $paymentsQuery->where('date', '>=', $from);
        $expensesQuery->where('date', '>=', $from);
    }

    $totalAmount = $paymentsQuery->sum('amount');
    $totalExpenses = $expensesQuery->sum('amount');
    $totalProfit = $totalAmount - $totalExpenses;

    // ✅ Accounts List
    $accounts = Account::with('brance')->get();

    // ✅ Brance List with total payment, expense, and net balance
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

    return view('admin.dashboard.index', compact(
        'totalAmount', 'totalExpenses', 'totalProfit', 'filter',
        'accounts', 'brances'
    ));
}


}
