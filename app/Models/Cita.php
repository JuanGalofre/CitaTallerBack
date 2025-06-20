<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cita extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fecha',
        'hora',
        'descripcion',
        'estado'
    ];


    public function usuario(){
        return $this->belongsTo(User::class);
    }

}
