<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignants = DB::table('enseignants')  
        ->join('matieres', 'enseignants.matiere_id', '=', 'matieres.id')
        ->select('enseignants.*', 'matieres.nom as matiere_nom')
        ->get();
        return view('enseignants.index',['enseignants' => $enseignants]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    { 
        $matieres = DB::table('matieres')->get();
        return view('enseignants.create', ['matieres' => $matieres]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:enseignants',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'date_naissance' => 'required|date|before:now',
            "matiere_id"	=>'required|exists:matieres,id',
        ]);
       
        // Création de l'enseignant
        $enseignant = DB::table('enseignants')->insert([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'telephone' => $validatedData['telephone'],
            'adresse' => $validatedData['adresse'],
            'date_naissance' => $validatedData['date_naissance'],
            'matiere_id' => $validatedData['matiere_id'],
        ]);
    
        // Redirection vers la liste des enseignants avec un message de confirmation
        return redirect()->route('enseignants.index')->with('success', 'L\'enseignant a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show( $enseignant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $enseignant)
    {
        
        // Retrieve the Enseignant object from the database
        $enseignant = DB::table('enseignants')->where('id', $enseignant)->first();

        // Retrieve the list of Matiere objects from the database
        $matieres = DB::table('matieres')->get();

        // Pass the data to the view
        return view('enseignants.edit', compact('enseignant', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $enseignants)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:enseignants,email,'.$enseignants,
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'matiere_id' => 'required|integer|exists:matieres,id',
    ]);
    DB::table('enseignants')->where('id', $enseignants)->update([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'telephone' => $validatedData['telephone'],
            'adresse' => $validatedData['adresse'],
            'date_naissance' => $validatedData['date_naissance'],
            'matiere_id' => $validatedData['matiere_id'],
        ]);
        return redirect()->route('enseignants.index')->with('success', 'L\'enseignant a été mis à jour avec succès!');

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $enseignant = DB::table('enseignants')->where('id', $id)->delete();   
        return redirect()->route('enseignants.index')->with('success', 'Enseignant deleted successfully');
    }

public function Filter_enseignant(Request $request)
    {
        $nom = $request->input('nom');
    
        $enseignants = DB::table('enseignants')
                        ->join('matieres', 'enseignants.matiere_id', '=', 'matieres.id')
                        ->select('enseignants.*', 'matieres.nom as matiere_nom')
                        ->where('enseignants.nom', 'like', '%' . $nom . '%')
                        ->orderBy('enseignants.nom')
                        ->get();
        
        return view('enseignants.index', compact('enseignants'));

    } 
    public function trie_enseignant(Request $request)
    {
        $colonne = $request->input('colonne');
        $ordre = $request->input('ordre');
        $enseignants = DB::table('enseignants')
                        ->join('matieres', 'enseignants.matiere_id', '=', 'matieres.id')
                        ->select('enseignants.*', 'matieres.nom as matiere_nom')
                        ->orderBy($colonne, $ordre)
                        ->get();
        return view('enseignants.index', compact('enseignants'));
    
    }
}
