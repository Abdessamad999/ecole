<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'eleves';
    protected $fillable = ['nom', 'prenom', 'date_naissance', 'genre', 'adresse', 'ville', 'code_postal', 'telephone', 'email'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
