<?php

namespace App\Models;
use App\Models\Opportunites;
use Illuminate\Database\Eloquent\Model;

class Opportunites extends Model
{
    
    protected $table = 'opportunites';
    protected $fillable = [
        'title', 'description', 'dure', 'fichier', 'datefin',
    ];
}
