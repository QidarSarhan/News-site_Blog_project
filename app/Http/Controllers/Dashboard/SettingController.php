<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $this->authorize('view', $setting);
        return view('dashboard.settings');
    }
    //
    public function update(Request $request , Setting $setting){
        //
        // dd($request->all());

        // Setting::create($request->all());
        //     dd($request->all());
        $data = [
            'image' => 'nullable|image| mimes: jpg,png,jpeg,gif,svg|max:2048',
            'favicon' => 'nullable|image| mimes: jpg,png,jpeg,gif,svg|max:2048',
            'facebook' => 'nullable | string',
            'instagram' => 'nullable | string',
            'phone' => 'nullable | numeric',
            'email' => 'nullable | email',
        ];

        foreach (config('app.languages') as $key => $value) {
            
            $data[$key.'*.title'] = 'nullable | string';
            $data[$key.'*.content'] = 'nullable | string';
            $data[$key.'*.address'] = 'nullable | string';

        }

        // dd($data);

        $validatedData = $request->validate($data);

        $setting->update($request->except('image', 'favicon','_token'));

        // Setting::where('id',1)->update($request->except('image', 'favicon','_token'));

        // dd($request->all());

        // Validator::make($request->all(), $data);

        /* $validatedData = $request->validate([
            'instagram' => 'nullable | string',
            'instagram' => 'nullable | string',
        ]); */

        // dd($request->all());
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            // $data['images']= $filename;
            $path = 'images/' . $filename;
            $setting->update(['logo'=>$path]);
        }

        if ($request->file('favicon')) {
            $file = $request->file('favicon');
            $filename = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            // $data['images']= $filename;
            $path = 'images/' . $filename;
            $setting->update(['favicon'=>$path]);

        }

        /* if ($request->has('logo')) {
            $name = $request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->store('public/images'); // public/adminassets/img
            $setting->update(['logo'=>$path]);
            dd($name, $path);

        }

        if ($request->has('favicon')) {
            $name = $request->file('favicon')->getClientOriginalName();
            $path = $request->file('favicon')->store('public/images'); // public/adminassets/img
            $setting->update(['favicon'=>$path.'/'.$name]);
        } */
        
        // $name = $request->file('image')->getClientOriginalName();
        // $path = $request->file('image')->store('public/images'); // public/adminassets/img
        
        return redirect()->route('dashboard.settings');


        /* echo '<pre>';
        var_dump($_POST);
        // print_r($_POST);
        echo '<pre>'; */
    }
}

