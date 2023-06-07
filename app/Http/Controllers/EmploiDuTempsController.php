<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploiDuTemps;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmploiDuTempsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emplois_du_temps = DB::table('emplois_du_temps')
        ->join('matieres', 'emplois_du_temps.matiere_id', '=', 'matieres.id')
        ->join('enseignants', 'emplois_du_temps.enseignant_id', '=', 'enseignants.id')
        ->select('emplois_du_temps.*', 'matieres.nom as matiere_nom', 'enseignants.nom as enseignant_nom', 'enseignants.prenom as enseignant_prenom')
        ->orderBy('emplois_du_temps.jour', 'asc')
        ->orderBy('emplois_du_temps.horaire_debut', 'asc')
        ->get();
        return view('emplois_du_temps.index',['emplois_du_temps' => $emplois_du_temps]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = DB::table('matieres')->get();
        $enseignants = DB::table('enseignants')->get();
        return view('emplois_du_temps.create', compact('matieres', 'enseignants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'intitule' => 'required|max:255',
            'horaire_debut' => 'required|date_format:H:i|after_or_equal:8:00',
            'horaire_debut' => 'required|date_format:H:i|before: horaire_fin',
            'horaire_fin' => 'required|date_format:H:i|after: horaire_debut',
            'horaire_fin' => 'required|date_format:H:i|before_or_equal:19:00',
            'jour' => [
                'required',
                Rule::in(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']),
            ],
            'salle' => 'required|max:255',
            'enseignant_id' => 'required|exists:enseignants,id',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        DB::table('emplois_du_temps')->insert([
            'intitule' => $validatedData["intitule"],
            'horaire_debut' => $validatedData["horaire_debut"],
            'horaire_fin' => $validatedData["horaire_fin"],
            'jour' => $validatedData["jour"],
            'salle' => $validatedData["salle"],
            'enseignant_id' => $validatedData["enseignant_id"],
            'matiere_id' => $validatedData["matiere_id"],
        ]);

        return redirect()->route('emplois_du_temps.index')->with('success', 'Emploi du temps ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploiDuTemps $emploiDuTemps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $emploiDuTemps)
    {
    $emplois_du_temps = DB::table('emplois_du_temps')->where('id', $emploiDuTemps)->first();
    // Retrieve the list of Matiere objects from the database
    $enseignants = DB::table('enseignants')->get();
    $matieres = DB::table('matieres')->get();
    // Pass the data to the view
    return view('emplois_du_temps.edit', compact('enseignants', 'matieres',"emplois_du_temps"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'intitule' => 'required|max:255',
            'horaire_debut' => 'required|date_format:H:i|after_or_equal:8:00',
            'horaire_debut' => 'required|date_format:H:i|before: horaire_fin',
            'horaire_fin' => 'required|date_format:H:i|after: horaire_debut',
            'horaire_fin' => 'required|date_format:H:i|before_or_equal:19:00',
            'jour' => [
                'required',
                Rule::in(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']),
            ],
            'salle' => 'required|max:255',
            'enseignant_id' => 'required|exists:enseignants,id',
            'matiere_id' => 'required|exists:matieres,id',
        ]);
    
        $emploidutemps = DB::table('emplois_du_temps')
            ->where('id', $id)
            ->update([
                'intitule' => $validatedData['intitule'],
                'horaire_debut' => $validatedData['horaire_debut'],
                'horaire_fin' => $validatedData['horaire_fin'],
                'jour' => $validatedData['jour'],
                'salle' => $validatedData['salle'],
                'enseignant_id' => $validatedData['enseignant_id'],
                'matiere_id' => $validatedData['matiere_id'],
            ]);
            return redirect()->route('emplois_du_temps.index')->with('success', 'Emploi du temps ajouté avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
   
    DB::table('emplois_du_temps')->where('id', $id)->delete();

    return redirect()->route('emplois_du_temps.index')->with('success', 'L\'emploi du temps a été supprimé.');
}

public function filter(Request $request)
{
    $intitule = $request->input('intitule');
    $emplois_du_temps = DB::table('emplois_du_temps')
        ->join('enseignants', 'emplois_du_temps.enseignant_id', '=', 'enseignants.id')
        ->join('matieres', 'emplois_du_temps.matiere_id', '=', 'matieres.id')
        ->select('emplois_du_temps.*', 'enseignants.nom as enseignant_nom', 'matieres.nom as matiere_nom', 'enseignants.prenom as enseignant_prenom')
        ->where('emplois_du_temps.intitule', 'like', '%' . $intitule . '%')
        ->orderBy('emplois_du_temps.intitule')
        ->get();

    return view('emplois_du_temps.index', compact('emplois_du_temps'));
}
public function trie_emplois_du_temps(Request $request)
{
    $colonne = $request->input('colonne');
    $ordre = $request->input('ordre');
    $emplois_du_temps = DB::table('emplois_du_temps')
    ->join('enseignants', 'emplois_du_temps.enseignant_id', '=', 'enseignants.id')
    ->join('matieres', 'emplois_du_temps.matiere_id', '=', 'matieres.id')
    ->select('emplois_du_temps.*', 'enseignants.nom as enseignant_nom', 'matieres.nom as matiere_nom', 'enseignants.prenom as enseignant_prenom')
    ->orderBy($colonne, $ordre)
    ->get();
    return view('emplois_du_temps.index', compact('emplois_du_temps'));

}
}
