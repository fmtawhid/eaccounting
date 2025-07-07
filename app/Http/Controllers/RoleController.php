<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function __construct()
    {
        foreach (self::middlewareList() as $middleware => $methods) {
            $this->middleware($middleware)->only($methods);
        }
    }

    // Define which methods use which permission
    public static function middlewareList(): array
    {
        return [
            'permission:role_view' => ['index'],
            'permission:role_add' => ['create', 'store'],
            'permission:role_edit' => ['edit', 'update'],
            'permission:role_delete' => ['destroy'],
        ];
    }
    /**
     * রোল এবং পারমিশন লোড করা
     */
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $roles = Role::with('permissions')->select(['id', 'name'])->get();
    
    //         return datatables()->of($roles)
    //             ->addIndexColumn()
    //             ->addColumn('permissions', function ($role) {
    //                 return $role->permissions->pluck('name')->implode(', '); // Convert array to comma-separated string
    //             })
    //             ->addColumn('actions', function ($role) {
    //                 return '<a href="' . route('roles.edit', $role->id) . '" class="btn btn-warning btn-sm">Edit</a>
    //                         <button class="btn btn-danger btn-sm delete-role" data-id="' . $role->id . '">Delete not work </button>';
    //             })
    //             ->rawColumns(['actions'])
    //             ->make(true);
    //     }
    //     return view('auth.roles.index');
    // }
    public function index(Request $request)
{
    if ($request->ajax()) {
        $roles = Role::with('permissions')->select(['id', 'name'])->get();

        return datatables()->of($roles)
            ->addIndexColumn()
            ->addColumn('permissions', function ($role) {
                return $role->permissions->pluck('name')->implode(', '); // Convert array to comma-separated string
            })
            ->addColumn('actions', function ($role) {
                $edit_api = route('roles.edit', $role->id);
                $delete_api = route('roles.destroy', $role->id);

                // Start building the action buttons
                $action = '';

                // Add Edit Button if the user has the 'role_edit' permission
                if (auth()->user()->can('role_edit')) {
                    $action .= '<a href="' . $edit_api . '" class="btn btn-warning btn-sm">Edit</a>';
                }

                // Add Delete Button if the user has the 'role_delete' permission
                if (auth()->user()->can('role_delete')) {
                    $action .= '<form method="POST" action="' . $delete_api . '" class="d-inline-block">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input name="_token" type="hidden" value="' . csrf_token() . '">
                                    <button type="submit" class="btn btn-danger btn-sm" style="margin-left: 10px;">Delete</button>
                                 </form>';
                }

                return $action;
            })
            ->rawColumns(['actions']) // Render 'actions' column as raw HTML
            ->make(true);
    }

    return view('auth.roles.index');
}

    


    public function create()
    {
        $permissions = Permission::all(); 
        return view('auth.roles.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create')->withErrors($validator)->withInput();
        }

        $role = Role::create(['name' => $request->name]);

        // Convert permission IDs to permission names
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        
        // Assign permissions to the role
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully with permissions!');
    }



    // public function edit($id)
    // {
    //     $role = Role::with('permissions')->findOrFail($id);
    //     $permissions = Permission::all();
        
    //     return view('auth.roles.edit', compact('role', 'permissions')); // Return View with Data
    // }
    

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|unique:roles,name,' . $id,
    //         'permissions' => 'required|array',
    //         'permissions.*' => 'exists:permissions,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $role = Role::findOrFail($id);
    //     $role->update(['name' => $request->name]);

    //     $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
    //     $role->syncPermissions($permissions);

    //     return response()->json(['message' => 'Role updated successfully!']);
    // }
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        
        return view('auth.roles.edit', compact('role', 'permissions')); // Return View with Data
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.edit', $id)->withErrors($validator)->withInput();
        }

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        // Convert permission IDs to names and assign them to role
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }



    
    // public function destroy($id)
    // {
    //     $role = Role::findOrFail($id);
    //     $role->delete();
    //     return response()->json(['message' => 'Role deleted successfully!']);
    // }
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        try {
            // Remove all permissions associated with this role
            $role->syncPermissions([]);

            // Delete the role
            $role->delete();

            return response()->json(['message' => 'Role deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete role. Please try again.'], 500);
        }
    }
}
