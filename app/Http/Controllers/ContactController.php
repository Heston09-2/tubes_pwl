<?php



namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function showForm()
    {
        $pelajar = Auth::guard('pelajar')->user();
        return view('pelajar.contact.form', compact('pelajar'));
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        $pelajar = Auth::guard('pelajar')->user();

        Contact::create([
            'pelajar_id' => $pelajar->id,
            'name' => $pelajar->name,
            'email' => $pelajar->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Pertanyaan kamu telah dikirim!');
    }
}

