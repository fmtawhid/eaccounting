<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purpose;
use Illuminate\Http\Request;
use DataTables;

class PurposeController extends Controller
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
            'permission:purpose_view' => ['index'],
            'permission:purpose_add' => ['create', 'store'],
            'permission:purpose_edit' => ['edit', 'update'],
            'permission:purpose_delete' => ['destroy'],
        ];
    }

    // public function index()
    // {
    //     $purposes = Purpose::all();

    //     // Check if the request is an AJAX call
    //     if (request()->ajax()) {
    //         return DataTables::of($purposes)
    //             ->addIndexColumn() // Adds a sequential index column
    //             ->addColumn('created_at_read', function ($row) {
    //                 return $row->created_at->diffForHumans();
    //             })
    //             ->addColumn('actions', function ($row) {
    //                 $delete_api = route('purposes.destroy', $row);
    //                 $edit_api = route('purposes.edit', $row);
    //                 $csrf = csrf_token();
    //                 $action = <<<CODE
    //             <form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>

    //                 <input name='_method' type='hidden' value='DELETE'><input name='_token' type='hidden' value='$csrf'>
    //                 <a class='btn btn-info btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='$edit_api' data-original-title='Edit product details'>
    //                 <i class="ri-edit-box-fill"></i>
    //                 </a>
                
    //                 <button type='submit' class='btn delete btn-danger btn-sm m-1' data-toggle='tooltip' data-placement='top' title='' href='' data-original-title='Delete product'>
    //                  <i class="ri-delete-bin-fill"></i>
    //                 </button>
    //             </form>
                 
    //             CODE;

    //                 return $action;
    //             })
    //             ->rawColumns(['created_at_read', 'actions'])
    //             ->make(true);
    //     }

    //     return view('admin.purposes.index', compact('purposes'));
    // }

    public function index()
    {
        $purposes = Purpose::all();

        // Check if the request is an AJAX call
        if (request()->ajax()) {
            return DataTables::of($purposes)
                ->addIndexColumn() // Adds a sequential index column
                ->addColumn('created_at_read', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('purposes.destroy', $row);
                    $edit_api = route('purposes.edit', $row);
                    $csrf = csrf_token();

                    // Start the form for the delete button
                    $action = "<form method='POST' action='$delete_api' accept-charset='UTF-8' class='d-inline-block dform'>
                        <input name='_method' type='hidden' value='DELETE'>
                        <input name='_token' type='hidden' value='$csrf'>";

                    // Add Edit Button if the user has the 'purpose_edit' permission
                    if (auth()->user()->can('purpose_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit purpose details'>
                            <i class='ri-edit-box-fill'></i>
                        </a>";
                    }

                    // Add Delete Button if the user has the 'purpose_delete' permission
                    if (auth()->user()->can('purpose_delete')) {
                        $action .= "<button type='submit' class='btn delete btn-danger btn-sm m-1' title='Delete purpose'>
                            <i class='ri-delete-bin-fill'></i>
                        </button>";
                    }

                    // Close the form tag
                    $action .= "</form>";

                    return $action;
                })
                ->rawColumns(['created_at_read', 'actions']) // Render 'actions' column as raw HTML
                ->make(true);
        }

        return view('admin.purposes.index', compact('purposes'));
    }


    /**
     * Show the form for creating a new expense head.
     */
    public function create()
    {
        return view('admin.purposes.create');
    }

    /**
     * Store a newly created expense head in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'purpose_name' => 'required|string|max:255|unique:purposes,purpose_name',
            'description' => 'required|string',
        ]);

        Purpose::create([
            'purpose_name' => $request->purpose_name,
            'description' => $request->description,
        ]);

        return redirect()->route('purposes.index')->with('success', 'Purpose created successfully.');
    }

    /**
     * Show the form for editing the specified expense head.
     */
    public function edit(Purpose $purpose)
    {
        return view('admin.purposes.edit', compact('purpose'));
    }

    /**
     * Update the specified expense head in storage.
     */
    public function update(Request $request, Purpose $purpose)
    {
        $request->validate([
            'purpose_name' => 'required|string|max:255|unique:purposes,purpose_name,' . $purpose->id,
            'description' => 'required|string',
        ]);

        $purpose->update([
            'purpose_name' => $request->purpose_name,
            'description' => $request->description,
        ]);

        return redirect()->route('purposes.index')->with('success', 'Purpose updated successfully.');
    }

    /**
     * Remove the specified expense head from storage.
     */
    public function destroy(Purpose $purpose)
    {
        // Check if the Expense Head has any associated Expenses
        if ($purpose->payments()->exists()) {
            // Redirect back with an error message if Expenses exist
            return redirect()->route('purposes.index')
                             ->with('error', 'Cannot delete purpose because it is associated with existing Expenses.');
        }

        // If no associated Expenses, proceed to delete
        $purpose->delete();

        // Redirect back with a success message
        return redirect()->route('purposes.index')
                         ->with('success', 'Purpose deleted successfully.');
    }
}
