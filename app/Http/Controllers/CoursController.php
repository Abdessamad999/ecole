<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
    $cours = DB::table('cours')
    ->join('matieres', 'cours.matiere_id', '=', 'matieres.id')
    ->join('enseignants', 'cours.enseignant_id', '=', 'enseignants.id')
    ->select('cours.*', 'matieres.nom as matiere_nom', 'enseignants.nom as enseignant_nom')
    ->orderBy('jour')
    ->orderBy('heure_debut')
    ->paginate(10);

    return view('cours.index', ['cours' => $cours]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = DB::table('matieres')->get();
        $enseignants = DB::table('enseignants')->get();
        return view('cours.create', ['matieres' => $matieres,'enseignants' => $enseignants]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        						

    $validatedData = $request->validate([
        "nom"=> ['required', 'string'],
        "salle"=> ['required', 'integer'],
        'titre' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string'],
        'matiere_id' => ['required', 'integer', 'exists:matieres,id'],
        'enseignant_id' => ['required', 'integer', 'exists:enseignants,id'],
        'jour' =>  'required',
        'heure_debut' => 'required|date_format:H:i|after_or_equal:8:00',
        'heure_debut' => 'required|date_format:H:i|before: heure_fin',
        'heure_fin' => 'required|date_format:H:i|after: heure_debut',
        'heure_fin' => 'required|date_format:H:i|before_or_equal:19:00',
    ]); 
    // Enregistrement du nouveau cours dans la base de données
    DB::table('cours')->insert([
        "nom"=> $validatedData['nom'],
        "salle"=> $validatedData['salle'],
        'titre' => $validatedData['titre'],
        'description' => $validatedData['description'],
        'matiere_id' => $validatedData['matiere_id'],
        'enseignant_id' => $validatedData['enseignant_id'],
        'jour' => $validatedData['jour'],
        'heure_debut' => $validatedData['heure_debut'],
        'heure_fin' => $validatedData['heure_fin'],
    ]);
    return redirect()->route('cours.index')->with('success', 'Le cours a été ajouté avec succès.');
 
}

    /**
     * Display the specified resource.
     */
    public function show(Cours $cours)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $cours)
    {
        
// Retrieve the Cours object from the database
$cours = DB::table('cours')->where('id', $cours)->first();

// Retrieve the list of Enseignant objects from the database
$enseignants = DB::table('enseignants')->get();

// Retrieve the list of Matiere objects from the database
$matieres = DB::table('matieres')->get();

// Pass the data to the view
return view('cours.edit', compact('cours', 'enseignants', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $cours)
    {
        $validatedData = $request->validate([
            "nom"=> ['required', 'string'],
            "salle"=> ['required', 'integer'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'matiere_id' => ['required', 'integer', 'exists:matieres,id'],
            'enseignant_id' => ['required', 'integer', 'exists:enseignants,id'],
            'jour' =>  'required',
            'heure_debut' => 'required|date_format:H:i|after_or_equal:8:00',
            'heure_debut' => 'required|date_format:H:i|before: heure_fin',
            'heure_fin' => 'required|date_format:H:i|after: heure_debut',
            'heure_fin' => 'required|date_format:H:i|before_or_equal:19:00',
        ]);
        
        // Mise à jour du cours dans la base de données
        DB::table('cours')->where('id', $cours)->update([
        "nom"=> $validatedData['nom'],
        "salle"=> $validatedData['salle'],
        'titre' => $validatedData['titre'],
        'description' => $validatedData['description'],
        'matiere_id' => $validatedData['matiere_id'],
        'enseignant_id' => $validatedData['enseignant_id'],
        'jour' => $validatedData['jour'],
        'heure_debut' => $validatedData['heure_debut'],
        'heure_fin' => $validatedData['heure_fin'],
        ]);
    
        return redirect()->route('cours.index')->with('success', 'Le cours a été ajouté avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cours)
    {
        DB::table('cours')->where('id', '=', $cours)->delete();

        return redirect()->route('cours.index')->with('success', 'Le cours a été supprimé avec succès');
    }
    public function filter_cours(Request $request)
    {
        $nom = $request->input('nom');
        $matieres = DB::table('matieres')->get();
        $enseignants = DB::table('enseignants')->get();
        $cours = DB::table('cours')
        ->join('matieres', 'cours.matiere_id', '=', 'matieres.id')
        ->join('enseignants', 'cours.enseignant_id', '=', 'enseignants.id')
        ->select('cours.*', 'matieres.nom as matiere_nom', 'enseignants.nom as enseignant_nom')
        ->where('cours.nom', 'like', '%' . $nom . '%')
         ->orderBy('cours.nom')
         ->get();
    
        return view('cours.index', compact('cours'));
    }
    public function trie_cours(Request $request)
    {
        $colonne = $request->input('colonne');
        $ordre = $request->input('ordre');
        $cours = DB::table('cours')
                        ->join('matieres', 'cours.matiere_id', '=', 'matieres.id')
                        ->join('enseignants', 'cours.enseignant_id', '=', 'enseignants.id')
                        ->select('cours.*', 'matieres.nom as matiere_nom', 'enseignants.nom as enseignant_nom')
                        ->orderBy($colonne, $ordre)
                        ->get();
        return view('cours.index', compact('cours'));
    
    }
}



   