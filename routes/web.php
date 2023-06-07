<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\statisticontoller;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EmploiDuTempsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('', function ($id) {
    
});

Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});
//==============================Translate all pages============================
Route::group(
     [
         'prefix' => LaravelLocalization::setLocale(),
         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
     ], function () {

     //==============================dashboard============================
       Route::get('/dashboard', [HomeController::class,"index"]);
     //==============================eleves============================
       Route::resource('dashboard/eleves', EleveController::class);
       Route::get('/eleves/trie',[EleveController::class,"trie_eleve"] )->name('eleves.trie');
       Route::post('dashboard/eleves/filtre', [EleveController::class,"Filter_eleve"] )->name('Filter_eleve');

       //==============================matieres============================
       Route::resource('dashboard/matieres', MatiereController::class);
       Route::get('/matieres/trie',[MatiereController::class,"trie_matiere"] )->name('matieres.trie');
       Route::post('dashboard/matieres/filtre', [MatiereController::class,"Filter_matiere"] )->name('matiere.filter');
       //==============================enseignants============================

       Route::resource('dashboard/enseignants', EnseignantController::class);
       Route::get('/enseignants/trie',[EnseignantController::class,"trie_enseignant"] )->name('enseignants.trie');
       Route::post('dashboard/enseignants/filtre', [EnseignantController::class,"Filter_enseignant"] )->name('enseignants.filter');
       //==============================cours============================

       Route::resource('dashboard/cours', CoursController::class);
       Route::get('/cours/trie',[coursController::class,"trie_cours"] )->name('cours.trie');
       Route::get('/cours/filter', [coursController::class,"filter_cours"])->name('cours.filter');
       //==============================notes============================
     
       Route::resource('dashboard/notes', NoteController::class);
       Route::get('/notes/trie',[NoteController::class,"trie_notes"] )->name('notes.trie');
       Route::get('/notes/filter', [NoteController::class,"filter_notes"])->name('notes.filter');

       //==============================emplois_du_temps============================


       Route::resource('dashboard/emplois_du_temps', EmploiDuTempsController::class);
       Route::get('/emplois_du_temps/trie',[EmploiDuTempsController::class,"trie_emplois_du_temps"] )->name('emplois_du_temps.trie');
       Route::get('/emplois-du-temps/filter', [EmploiDuTempsController::class, 'filter'])->name('emplois-du-temps.filter');
       
       Route::get('/statistiques/moyennes', [StatistiqueController::class, 'moyennes'])->name('statistiques.moyennes');
       Route::get('/statistiques/taux-reussite', [StatistiqueController::class, 'tauxReussite'])->name('statistiques.tauxReussite');
       

       

    });
  
    


    
