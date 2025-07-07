<?php
// app/Http/Controllers/Admin/BranceController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brance;
use App\Models\Account;
use DataTables;

class BranceController extends Controller
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
            'permission:brance_view' => ['index'],
            'permission:brance_add' => ['store'],
            'permission:brance_edit' => ['edit', 'update'],
            'permission:brance_delete' => ['destroy'],
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Brance::latest();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    $edit_url = route('brances.edit', $row);
                    $delete_url = route('brances.destroy', $row);
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

        return view('admin.brance.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Brance::create($request->only('name', 'location', 'description'));

        return response()->json(['success' => 'Brance created successfully.']);
    }

    public function edit(Brance $brance)
    {
        return view('admin.brance.edit', compact('brance'));
    }

    public function update(Request $request, $id)
    {
        $brance = Brance::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $brance->update($request->only('name', 'location', 'description'));

        return response()->json(['success' => 'Brance updated successfully.']);
    }

    public function destroy(Brance $brance)
    {
        try {
            $brance->delete();
            return response()->json(['success' => true, 'message' => 'Brance deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete Brance.'], 500);
        }
    }


}
