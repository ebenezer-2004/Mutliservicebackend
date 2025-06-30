<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    
    public function store(Request $request, Blog $blog)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email',
        'comment' => 'required|string|max:1000',
    ]);

    
    $comment = $blog->comments()->create([
        'name' => $request->name,
        'email' => $request->email,
        'contenu' => $request->comment,
    ]);

    return response()->json([
        'message' => 'Commentaire envoyé avec succès.',
        'comment' => $comment,
    ]);
}

}
