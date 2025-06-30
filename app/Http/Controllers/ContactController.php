<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function send(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'telephone' => 'nullable|string|max:30',
            'message'   => 'required|string|max:2000',
        ],[
          "name.required" =>"Le champs nom est requis" ,
           "email.required" =>"Le champs email est requis" ,
            "telephone.required" =>"Le champs téléphone est requis" ,
             "message.required" =>"Le champs message es requis" , 
        ]);

        Contact::firstOrCreate($validated);  
    return response()->json(['message' => 'Message enregistré avec succès.'], 201);

    }

    

    public function index()
    {
        $messages = Contact::latest()->get();
        return view('admin.messages._index', compact('messages'));
    }
     public function destroy($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success', 'Message supprimé avec succès.');
    }
}
