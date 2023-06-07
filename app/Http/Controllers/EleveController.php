<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\NotesDisponibles;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    
        $eleves = DB::table('eleves')->get();
        return view('eleves.index', ['eleves' => $eleves]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eleves.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'genre' => ['required', Rule::in(['Homme', 'Femme'])],
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:eleves,email',
        ]);
        $eleves=DB::table('eleves')->insert([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_naissance' => $validatedData['date_naissance'],
            'genre' => $validatedData['genre'],
            'adresse' => $validatedData['adresse'],
            'ville' => $validatedData['ville'],
            'code_postal' => $validatedData['code_postal'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
        ]);
        // $request->user()->notify(new NotesDisponibles($eleves));
        return redirect('dashboard/eleves')->with('success', 'L\'élève a été ajouté avec succès !');
    }



    /**
     * Display the specified resource.
     */
    public function show(Eleve $eleve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($eleve)
    {
        $eleve = DB::table('eleves')->find($eleve);
       
        return view('eleves.edit',['eleve' => $eleve]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $eleve)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'genre' => ['required', Rule::in(['Homme', 'Femme'])],
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:eleves,email',
        ]);

        DB::table('eleves')->where('id', $eleve)->update([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_naissance' => $validatedData['date_naissance'],
            'genre' => $validatedData['genre'],
            'adresse' => $validatedData['adresse'],
            'ville' => $validatedData['ville'],
            'code_postal' => $validatedData['code_postal'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
        ]);

        return redirect('dashboard/eleves')->with('success', 'Les informations de l\'élève ont été modifiées avec succès !');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $eleve)
    {
       
        DB::table('eleves')->where('id', $eleve)->delete();
            return redirect()->route('eleves.index')->with('success', 'L\'élève a été supprimé avec succès.');
        
    }
   public function Filter_eleve( $request)
    {
        $nom = $request->input('nom');
               $eleves= DB::table('eleves')
                            ->where('nom', 'like', '%' . $nom . '%')
                            ->get();
                return view('eleves.index', compact('eleves'));

    }
    public function trie_eleve(Request $request,$sort="asc")
    {
        $colonne = $request->input('colonne');
        $ordre = $request->input('ordre');
    
        $eleves = DB::table('eleves')
                        ->select('id', 'nom', 'prenom', 'date_naissance', 'genre', 'adresse', 'ville', 'code_postal', 'telephone', 'email')
                        ->orderBy($colonne, $ordre)
                        ->get();
    
        return view('eleves.index', ['eleves' => $eleves]);
    }
}


