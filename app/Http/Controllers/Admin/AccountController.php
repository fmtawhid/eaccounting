<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Brance;
use DataTables;

class AccountController extends Controller
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
            'permission:account_view' => ['index'],
            'permission:account_add' => ['create', 'store'],
            'permission:account_edit' => ['edit', 'update'],
            'permission:account_delete' => ['destroy'],
        ];
    }

    // List page with AJAX DataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Account::with('brance')->latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('brance_name', fn($row) => optional($row->brance)->name)
                ->addColumn('actions', function ($row) {
                    $edit_url = route('accounts.edit', $row);
                    $delete_url = route('accounts.destroy', $row);
                    $csrf = csrf_token();
                    return <<<HTML
                        <form method='POST' action='{$delete_url}' class='d-inline-block dform'>
                            <input type='hidden' name='_method' value='DELETE'>
                            <input type='hidden' name='_token' value='{$csrf}'>
                            <a href="{$edit_url}" class="btn btn-info btn-sm m-1"><i class="ri-edit-box-fill"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm delete m-1"><i class="ri-delete-bin-fill"></i></button>
                        </form>
                    HTML;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.account.index');
    }

    // Show create page (separate page)
    public function create()
    {
        $brances = Brance::all();
        return view('admin.account.create', compact('brances'));
    }

    // Store new account
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'number' => 'required|string|max:255',
        'brance_id' => 'required|exists:brances,id',
        'amount' => 'nullable|numeric|min:0', // ✅ required বাদ দিয়ে nullable করা হয়েছে
        'note' => 'nullable|string',
    ]);

    Account::create([
        'name' => $request->name,
        'number' => $request->number,
        'brance_id' => $request->brance_id,
        'amount' => $request->amount ?? 0, // ✅ ইনপুট না থাকলে 0 নিবে
        'note' => $request->note,
        'balance' => 0, // বা চাইলে এখানে amount-ও দেওয়া যেতে পারে
    ]);

    return response()->json(['success' => 'Account created successfully.']);
}


    // Show edit page
    public function edit(Account $account)
    {
        $brances = Brance::all();
        return view('admin.account.edit', compact('account', 'brances'));
    }

    // Update account
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'brance_id' => 'required|exists:brances,id',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $account->update($request->only('name', 'number', 'brance_id', 'amount', 'note'));

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    // Delete account
    public function destroy(Account $account)
    {
        try {
            $account->delete();
            return response()->json(['success' => true, 'message' => 'Account deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete account.'], 500);
        }
    }
}
