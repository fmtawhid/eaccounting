<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseHead;

use DataTables;


class ExpenseHeadController extends Controller
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
            'permission:expense_head_view' => ['index'],
            'permission:expense_head_add' => ['create', 'store'],
            'permission:expense_head_edit' => ['edit', 'update'],
            'permission:expense_head_delete' => ['destroy'],

        ];
    }




    public function index()
    {
        $expenseHeads = ExpenseHead::all();

        // Check if the request is an AJAX call
        if (request()->ajax()) {
            return DataTables::of($expenseHeads)
                ->addIndexColumn() // Adds a sequential index column
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('expense_heads.destroy', $row);
                    $edit_api = route('expense_heads.edit', $row);
                    $csrf = csrf_token();
                    $action = '';

                    // Add Edit Button if the user has the 'expense_head_edit' permission
                    if (auth()->user()->can('expense_head_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit expense head details'>
                                        <i class='ri-edit-box-fill'></i>
                                    </a>";
                    }

                    // Add Delete Button if the user has the 'expense_head_delete' permission
                    if (auth()->user()->can('expense_head_delete')) {
                        $action .= "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                                        <input name='_method' type='hidden' value='DELETE'>
                                        <input name='_token' type='hidden' value='$csrf'>
                                        <button type='submit' class='btn delete btn-danger btn-sm m-1' title='Delete expense head'>
                                            <i class='ri-delete-bin-fill'></i>
                                        </button>
                                    </form>";
                    }

                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions']) // Render 'actions' column as raw HTML
                ->make(true);
        }

        return view('admin.expense_heads.index', compact('expenseHeads'));
    }


    /**
     * Show the form for creating a new expense head.
     */
    public function create()
    {
        return view('admin.expense_heads.create');
    }

    /**
     * Store a newly created expense head in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_head_name' => 'required|string|max:255|unique:expense_heads,expense_head_name',
            'description' => 'required|string',
        ]);

        ExpenseHead::create([
            'expense_head_name' => $request->expense_head_name,
            'description' => $request->description,
        ]);

        return redirect()->route('expense_heads.create')->with('success', 'Expense Head created successfully.');
    }

    /**
     * Show the form for editing the specified expense head.
     */
    public function edit(ExpenseHead $expense_head)
    {
        return view('admin.expense_heads.edit', compact('expense_head'));
    }

    /**
     * Update the specified expense head in storage.
     */
    public function update(Request $request, ExpenseHead $expense_head)
    {
        $request->validate([
            'expense_head_name' => 'required|string|max:255|unique:expense_heads,expense_head_name,' . $expense_head->id,
            'description' => 'required|string',
        ]);

        $expense_head->update([
            'expense_head_name' => $request->expense_head_name,
            'description' => $request->description,
        ]);

        return redirect()->route('expense_heads.index')->with('success', 'Expense Head updated successfully.');
    }

    /**
     * Remove the specified expense head from storage.
     */
    public function destroy(ExpenseHead $expense_head)
    {
        // Check if the Expense Head has any associated Expenses
        if ($expense_head->expenses()->exists()) {
            // Redirect back with an error message if Expenses exist
            return redirect()->route('expense_heads.index')
                             ->with('error', 'Cannot delete Expense Head because it is associated with existing Expenses.');
        }

        // If no associated Expenses, proceed to delete
        $expense_head->delete();

        // Redirect back with a success message
        return redirect()->route('expense_heads.index')
                         ->with('success', 'Expense Head deleted successfully.');
    }
}
