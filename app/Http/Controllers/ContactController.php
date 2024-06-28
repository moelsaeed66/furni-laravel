<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('front.contact.contact-us');
    }

    public function store(Request $request)
    {
        Contact::create($request->all());
        return redirect()->back()->with('success', 'Your message has been sent successfully');
    }
}
