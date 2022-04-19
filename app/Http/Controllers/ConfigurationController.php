<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    public function index()
    {
        $config = Configuration::all();

        return view("vendor.adminlte.configuration.index")->with('config', $config);
    }


    public function create()
    {
        return view('vendor.adminlte.configuration.add');
    }

    public function store(Request $request)
    {
        $config = new Configuration;
        $config->name = $request->Title_Create;
        $config->status = 0;
        $config->save();
        return redirect()->route("configuration.index")->with('Create news successfully');
    }

    public function updateStatus(Request $request)
    {
        $config = Configuration::findOrFail($request->config_id);
        $config->status = $request->status;
        $config->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }
}
