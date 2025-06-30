<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Commentaire;
use App\Models\Blog;

class BlogController extends Controller
{
      public function index(){
 $blogs=Blog::with(['user'])->get();
    return view('admin.Blogs._index',['blogs'=>$blogs]);

    }

       public function blog(){
        return response()->json([
            "Blog"=>Blog::with(['comments'])->where('statut',"1")->get()
        ]);
    }

    public function show($id){
         return response()->json([
            "Blog"=>Blog::with(['comments'])->where('id',$id)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'type' => 'required|string|max:50',
            'image' => 'nullable|image|max:2048',
        ]);

      
        // $validated['user_id'] = auth()->id();
          $validated['user_id'] =1;


        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        try {
            Blog::create($validated);
            return redirect()->back()->with('success', 'Article ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }

   public function comments($id)
{
    $blog = Blog::with('comments')->findOrFail($id);
    return response()->json($blog->comments);
}

public function destroycomments($id)
{
    $comment = Comments::findOrFail($id);
 
    $comment->delete();

    return response()->json(['success' => true, 'message' => 'Commentaire supprimé avec succès.']);
}



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'type' => 'required|string|max:50',
            // 'statut' => 'required|string|max:50',
            'image' => 'nullable|image|max:2048',
        ]);

        // $validated['user_id'] = auth()->id();
         $validated['user_id'] = 1;


        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        try {
            $blog->update($validated);
            return redirect()->back()->with('success', 'Article modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la modification : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        try {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->delete();
            return redirect()->back()->with('success', 'Article supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
public function publier($id)
{
    try {
        $blog = Blog::findOrFail($id);

        $blog->update([
            'statut' => '1'
        ]);

        return redirect()->back()->with('success', 'Article publié avec succès.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue lors de la publication.');
    }
}

 
}
