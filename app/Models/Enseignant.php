<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;
    protected $table = 'enseignants';
    protected $fillable = ['nom', 'prenom', 'email', 'telephone', 'adresse', 'date_naissance'];

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class);
    }

    public function emploisDuTemps()
    {
        return $this->hasMany(EmploiDuTemps::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
}
