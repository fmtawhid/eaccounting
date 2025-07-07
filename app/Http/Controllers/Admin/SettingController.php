<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
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
            'permission:setting_view' => ['index'],
            
        ];
    }
    public function index()
    {
        $setting = Setting::find(1);

        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required",
            // "attachments" => "re5uired",
            "email" => "required",
            "address" => "required",
            "city" => "required",
            "zip" => "required",
            "state" => "required",
        ]);

        if ($validator->fails()) {
            // return redirect()->back()->with('error', $validator->errors()->first());
            return response()->json(['error' => $validator->errors()]);
        }

        $setting = Setting::find(1);
        if ($request->hasFile('logo')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:20480',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }

            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // $filepath        = $request->file('image')->storeAs('productimages', $fileNameToStore);
            //

            // $dir        = 'productimages/';
            $request->file('logo')->move(public_path('assets/setting'), $fileNameToStore);

            $setting->logo = $fileNameToStore;
        }

        if ($request->hasFile('favicon')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:20480',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }

            $filenameWithExt = $request->file('favicon')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('favicon')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // $filepath        = $request->file('image')->storeAs('productimages', $fileNameToStore);
            //

            // $dir        = 'productimages/';
            $request->file('favicon')->move(public_path('assets/setting'), $fileNameToStore);

            $setting->favicon = $fileNameToStore;
        }

        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->city = $request->city;
        $setting->zip = $request->zip;
        $setting->state = $request->state;

        $setting->save();

        $user = Auth::user();
        $user->email = $request->email;
        $user->save();

        // return redirect()->back()->with('success', "Setting Updated Successfully");
        // return response()->json(['success' => "Product Created Successfully"]);
        return redirect()->back()->with([
            'success' => "Setting Updated Successfully",
            'active_tab' => $request->input('active_tab'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'The current password is incorrect.');
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        // return redirect()->back()->with('success', "Password Changed Successfully");
        return redirect()->back()->with([
            'success' => "Password Changed Successfully",
            'active_tab' => $request->input('active_tab'),
        ]);
    }
}