<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    use HasFactory;
    protected $table="EmploiDuTemps";
    protected $fillable = ['intitule', 'horaire_debut', 'horaire_fin', 'jour', 'salle'];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
    
   
}
