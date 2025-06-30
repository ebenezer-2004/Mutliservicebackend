<?php

namespace App\Http\Controllers;
use App\Models\Opportunites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpportuniteController extends Controller
{
     // Afficher la liste des offres
    public function index()
    {
        $offres = Opportunites::latest()->get();
        return view('admin.offres._index', compact('offres'));
    }

     public function offres()
    {
        $offres = Opportunites::latest()->get();
        return response()->json([
            "offres"=>$offres
        ]);
    }


     public function show($id)
    {
        $offres = Opportunites::where('id',$id)->first();
        return response()->json([
            "offres"=>$offres
        ]);
    }

    // Créer une nouvelle offre
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'dure' => 'required|integer',
            'fichier' => 'required|mimes:pdf,doc,docx|max:2048',

            'datefin' => 'required|date',
        ],[
            "title.required"=>"Le titre est requis",
            "description.required"=>"La description est requise",
            "dure.required"=>"La durée est requise",
            "fichier.required"=>"Le fichier est requis",
             "fichier.mimes"=>"Seul les fichiers(pdf,doc,docs) sont acceptés",

         "datefin.required"=>"La date fin est requise"

        ]);

        $filePath = $request->file('fichier')->store('offres', 'public');

        Opportunites::create([
            'title' => $request->title,
            'description' => $request->description,
            'dure' => $request->dure,
            'fichier' => $filePath,
            'datefin' => $request->datefin,
        ]);

        return redirect()->back()->with('success', 'Offre créée avec succès.');
    }

    // Mettre à jour une offre
    public function update(Request $request, Opportunites $opportunite)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'dure' => 'required|integer',
            'fichier' => 'nullable|mimes:pdf,doc,docx',
            'datefin' => 'required|date',
        ]);

        if ($request->hasFile('fichier')) {
            Storage::disk('public')->delete($opportunite->fichier);
            $filePath = $request->file('fichier')->store('offres', 'public');
            $opportunite->fichier = $filePath;
        }

        $opportunite->update([
            'title' => $request->title,
            'description' => $request->description,
            'dure' => $request->dure,
            'datefin' => $request->datefin,
        ]);

        return redirect()->back()->with('success', 'Offre mise à jour.');
    }



public function destroy(Opportunites $opportunite)
{
    if ($opportunite->fichier) {
        Storage::disk('public')->delete($opportunite->fichier);
    }
    $opportunite->delete();
    return redirect()->back()->with('success', 'Offre supprimée.');
}
}
