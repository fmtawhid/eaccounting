<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;

class UserController extends Controller
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
            'permission:user_view' => ['index'],
            'permission:user_add' => ['create', 'store'],
            'permission:user_edit' => ['edit', 'update'],
            'permission:user_delete' => ['destroy'],
        ];
    }

    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles')->latest()->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('created_at_read', function ($row) {
                    return optional($row->created_at)->diffForHumans() ?? 'N/A';
                })
                ->addColumn('roles', function ($row) {
                    $roles = $row->roles->pluck('name')->implode(', ');
                    return empty($roles) ? ($row->role ?? 'No Role Assigned') : $roles;
                })
                ->addColumn('actions', function ($row) {
                    $delete_api = route('users.destroy', $row);
                    $edit_api = route('users.edit', $row);
                    $csrf = csrf_token();

                    $action = '';

                    if (auth()->user()->can('user_edit')) {
                        $action .= "<a class='btn btn-info btn-sm m-1' href='$edit_api' title='Edit user details'>
                                        <i class='ri-edit-box-fill'></i>
                                    </a>";
                    }

                    if (auth()->user()->can('user_delete')) {
                        $action .= "<form method='POST' action='$delete_api' class='d-inline-block dform'>
                                        <input name='_method' type='hidden' value='DELETE'>
                                        <input name='_token' type='hidden' value='$csrf'>
                                        <button type='submit' class='btn delete btn-danger btn-sm m-1' title='Delete user'>
                                            <i class='ri-delete-bin-fill'></i>
                                        </button>
                                    </form>";
                    }

                    return $action;
                })
                ->rawColumns(['created_at_read', 'roles', 'actions'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        if ($request->has('roles') && !empty($request->roles)) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = 'admin';

        if ($request->has('roles') && !empty($request->roles)) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }

    public function changePassword()
    {
        return view('admin.users.change_password');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
