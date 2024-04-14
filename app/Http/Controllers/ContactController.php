<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'contact_name' => 'required|min:5',
            'contact_email' => 'required|email',
            'contact_subject' => 'required',
            'contact_message' => 'required',
        ]);

        // Process the data, e.g., send an email

        // Return a response
        return back()->with('status', 'Message sent successfully!');
    }
}
