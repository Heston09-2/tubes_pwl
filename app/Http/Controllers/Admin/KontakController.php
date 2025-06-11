<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class KontakController extends Controller
{
     public function index()
    {
        
        $contacts = Contact::with('pelajar')->latest()->paginate(15);

        return view('admin.contacts.index', compact('contacts'));
    }
}
