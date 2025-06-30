<?php

namespace App\Http\Controllers;
use App\Models\Opportunites;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request, $id)
    {
        $job = Opportunites::findOrFail($id);

        if (!$job->is_active || $job->deadline < now()) {
            return response()->json(['message' => "Offre expirée ou désactivée"], 403);
        }

        if (Application::where('user_id', auth()->id())->where('job_offer_id', $job->id)->exists()) {
            return response()->json(['message' => 'Vous avez déjà postulé'], 409);
        }

        $requiredDocs = $job->required_docs;
        $rules = [];

        foreach ($requiredDocs as $doc) {
            $rules["documents.$doc"] = 'required|file|mimes:pdf,jpg,jpeg,png|max:2048';
        }

        $validated = $request->validate($rules + [
            'message' => 'nullable|string|max:1000'
        ]);

        $paths = [];

        foreach ($requiredDocs as $doc) {
            $paths[$doc] = $request->file("documents.$doc")
                ->store("applications/" . auth()->id() . "/$job->id", 'public');
        }

        $application = Application::create([
            'user_id' => auth()->id(),
            'job_offer_id' => $job->id,
            'documents' => $paths,
            'message' => $request->message
        ]);

        return response()->json(['message' => 'Candidature soumise', 'data' => $application], 201);
    }
}
