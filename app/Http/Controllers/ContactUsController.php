<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function submitForm(Request $request)
    {


        return redirect()->route('contact.index')->with('success', 'Pertanyaan Anda telah dikirim. Terima kasih!');
    }
}
