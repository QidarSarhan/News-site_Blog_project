<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Psy\CodeCleaner\ValidFunctionNamePass;
// use Yajra\DataTables\Utilities\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {

        // dd($request->header('lang'));

        // $settings = Setting::checkSettings();

        $settings = SettingResource::make(Setting::checkSettings());
        // return $settings->resolve();
        return response()->json(['data' => $settings, 'error' => ''], 200);
        // return response()->json([$settings, 'error' => ''], 200);
    }
}
