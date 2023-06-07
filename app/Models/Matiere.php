<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $table = 'matieres';
    protected $fillable = ['nom', 'description'];

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
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

