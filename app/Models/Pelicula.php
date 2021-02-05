<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $fillable=['titulo','estreno','año','cantidad','categoria_id'];
}
