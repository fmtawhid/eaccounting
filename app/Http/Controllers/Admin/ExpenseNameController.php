<?php

// app/Http/Controllers/Admin/ExpenseNameController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseName;
use DataTables;

class ExpenseNameController extends Controller
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
            'permission:expense_name_view' => ['index'],
            'permission:expense_name_add' => ['create', 'store'],
            'permission:expense_name_edit' => ['edit', 'update'],
            'permission:expense_name_delete' => ['destroy'],
        ];
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = ExpenseName::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $edit_url = route('expense_names.edit', $row);
                    $delete_url = route('expense_names.destroy', $row);
                    $csrf = csrf_token();
                    $buttons = '';

                    if (auth()->user()->can('expense_name_edit')) {
                        $buttons .= "<a href='{$edit_url}' class='btn btn-sm btn-info m-1'><i class='ri-edit-box-fill'></i></a>";
                    }

                    if (auth()->user()->can('expense_name_delete')) {
                        $buttons .= "<form method='POST' action='{$delete_url}' class='d-inline dform'>
                                        <input type='hidden' name='_method' value='DELETE'>
                                        <input type='hidden' name='_token' value='{$csrf}'>
                                        <button type='submit' class='btn btn-sm btn-danger delete m-1'><i class='ri-delete-bin-fill'></i></button>
                                    </form>";
                    }

                    return $buttons;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $expenseNames = ExpenseName::all();
        return view('admin.expense_names.index', compact('expenseNames'));
    }

    public function create()
    {
        return view('admin.expense_names.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:expense_names,name',
            'note' => 'nullable|string',
        ]);

        ExpenseName::create($request->only('name', 'note'));

        return redirect()->route('expense_names.index')->with('success', 'Expense Name created successfully.');
    }

    public function edit(ExpenseName $expense_name)
    {
        return view('admin.expense_names.edit', compact('expense_name'));
    }

    public function update(Request $request, ExpenseName $expense_name)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:expense_names,name,' . $expense_name->id,
            'note' => 'nullable|string',
        ]);

        $expense_name->update($request->only('name', 'note'));

        return redirect()->route('expense_names.index')->with('success', 'Expense Name updated successfully.');
    }

    public function destroy(ExpenseName $expense_name)
    {
        $expense_name->delete();
        return redirect()->route('expense_names.index')->with('success', 'Expense Name deleted successfully.');
    }
}
