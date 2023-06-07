<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class statisticontoller extends Controller
{
    public function moyennes()
    {
        $matieres = DB::table('matieres')->get();
        $eleves = DB::table('eleves')->get();
        $moyennes = [];

        foreach ($eleves as $eleve) {
            $notes = DB::table('notes')
                ->where('eleve_id', $eleve->id)
                ->pluck('note');

            $moyenne = $notes->isNotEmpty() ? round($notes->avg(), 2) : null;
            $moyennes[$eleve->id] = $moyenne;
        }

        return view('statistic', compact('matieres', 'eleves', 'moyennes'));
    }

    public function tauxReussite()
    {
        $matieres = DB::table('matieres')->get();
        $eleves = DB::table('eleves')->get();
        $tauxReussite = [];

        foreach ($eleves as $eleve) {
            $notes = DB::table('notes')
                ->where('eleve_id', $eleve->id)
                ->pluck('note');

            $nbNotes = $notes->count();
            $nbNotesSup10 = $notes->filter(function ($note) {
                return $note >= 10;
            })->count();

            $taux = $nbNotes > 0 ? round(($nbNotesSup10 / $nbNotes) * 100, 2) : null;
            $tauxReussite[$eleve->id] = $taux;
        }

        return view('statistic', compact('matieres', 'eleves', 'tauxReussite'));
    }
    
}
