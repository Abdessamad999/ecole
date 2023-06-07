<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Events\NoteAdded;
use Illuminate\Http\Request;
use App\Mail\NoteNotification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NotesDisponibles;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = DB::table('notes')
        ->join('eleves', 'notes.eleve_id', '=', 'eleves.id')
        ->join('matieres', 'notes.matiere_id', '=', 'matieres.id')
        ->select('notes.id', 'eleves.nom AS eleve_nom', 'matieres.nom AS matiere_nom', 'notes.note', 'notes.date')
        ->orderBy('notes.date', 'desc')->paginate(15)
        // ->get()
        ;
       return view('notes.index', ["notes"=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eleves = DB::table('eleves')->get();
        $matieres = DB::table('matieres')->get();
        return view('notes.create', ['matieres' => $matieres,'eleves' => $eleves]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'eleve_id' => 'required',
            'matiere_id' => 'required',
            'note' => 'required|numeric|between:0,20',
            'date' => 'required|date_format:Y-m-d',
        ]);

       $note= DB::table('notes')->insert([
            'eleve_id' => $validatedData['eleve_id'],
            'matiere_id' => $validatedData['matiere_id'],
            'note' => $validatedData['note'],
            'date' => $validatedData['date'],
        ]);
        $eleve = DB::table('eleves')->select('email', 'nom')->where('id', $validatedData['eleve_id'])->first();
        $matiere = DB::table('matieres')->select('nom')->where('id', $validatedData['matiere_id'])->first();           
        $data = [
            'eleve' => $eleve,
            'matiere' => $matiere,
            'note' => $note,
        ];
        Mail::to($eleve->email)->send(new NoteNotification($data));



        return redirect()->route('notes.index')->with('success', 'La note a été ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($note)
    { 
    $note = DB::table('notes')->where('id', $note)->first();
    // Retrieve the list of Matiere objects from the database
    $matieres = DB::table('matieres')->get();
    $eleves = DB::table('eleves')->get();
    // Pass the data to the view
    return view('notes.edit', compact('eleves', 'matieres',"note"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$note)
    {
        $validatedData = $request->validate([
            'eleve_id' => 'required|numeric',
            'matiere_id' => 'required|numeric',
            'note' => 'required|numeric|min:0|max:20',
            'date' => 'required|date',
        ]);
    
        // Mise à jour de la note dans la base de données avec Query Builder
        DB::table('notes')
            ->where('id', $note)
            ->update([
                'eleve_id' => $validatedData['eleve_id'],
                'matiere_id' => $validatedData['matiere_id'],
                'note' => $validatedData['note'],
                'date' => $validatedData['date'],
            ]);
    
        return redirect()->route('notes.index')->with('success', 'Note update avec succès!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = DB::table('notes')->where('id', $id)->delete();
    
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully');

    }


public function filter_notes(Request $request)
{
    $note = $request->input('note');
    $matieres = DB::table('matieres')->get();
    $eleves = DB::table('eleves')->get();
    $notes = DB::table('notes')
        ->join('eleves', 'notes.eleve_id', '=', 'eleves.id')
        ->join('matieres', 'notes.matiere_id', '=', 'matieres.id')
        ->select('notes.id', 'eleves.nom AS eleve_nom', 'matieres.nom AS matiere_nom', 'notes.note', 'notes.date')
        ->where('notes.note', '=', $note)
        ->orderBy('notes.note')
        ->get();

    return view('notes.index', compact('notes', 'matieres', 'eleves'));



}
public function trie_notes(Request $request)
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
