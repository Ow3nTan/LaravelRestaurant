<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteSetting;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $options = WebsiteSetting::all();
        return view('admin/website_settings/index', compact('options'));
    }
    public function update(Request $request)
    {

        $options = $request->all();
    
        // Loop through the options and update each one in the database
        foreach ($options as $optionName => $optionValue) {

            WebsiteSetting::where('option_name', $optionName)->update(['option_value' => $optionValue]);
        }
    
        return redirect()->route('website_settings.index')->with('success', 'Website settings updated successfully.');
    }
    
    
}
