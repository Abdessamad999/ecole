<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matieres = DB::table('matieres')->get();
        return view('matieres.index',['matieres' => $matieres]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matieres.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        $matiere = DB::table('matieres')->insertGetId([
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
        ]);
        return redirect('dashboard/matieres')->with('success', 'La matière a été créée avec succès!');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Matiere $matiere)
    {
// 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
   
        $matiere = DB::table('matieres')->find($id);
       
        return view('matieres.edit',['matiere' => $matiere]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required|string|max:255',
    ]);

    DB::table('matieres')->where('id', $id)->update([
            'nom' => $validatedData['nom'],
            'description' => $validatedData['description'],
        ]);
        return redirect('dashboard/matieres')->with('success', 'La matière a été mise à jour avec succès!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matiere = DB::table('matieres')->where('id', $id)->delete();
    
        if (!$matiere) {
            return response()->json([
                'message' => 'Matière introuvable!'
            ], 404);
        }
    
        return response()->json([
            'message' => 'La matière a été supprimée avec succès!',
        ], 200);
    }
public function Filter_matiere(Request $request)
    {
        $nom = $request->input('nom');
               $matieres= DB::table('matieres')
                            ->where('nom', 'like', '%' . $nom . '%')
                            ->get();
                return view('matieres.index', compact('matieres'));

    } 
    public function trie_matiere(Request $request)
    {
        $colonne = $request->input('colonne');
        $ordre = $request->input('ordre');
        $matieres = DB::table('matieres')
                        ->select('id', 'nom', 'description')
                        ->orderBy($colonne, $ordre)
                        ->get();
        return view('matieres.index', ['matieres' => $matieres]);
    }





}
