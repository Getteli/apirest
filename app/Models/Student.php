<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'birth', 'gerder', 'classroom_id'];

    // formatacao de serializacao
    protected $casts = [
        'birth' => 'date:d/m/Y'
    ];

    // escondendo campos na serializacao - global
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // mostrando campos na serializacao - global
    protected $visible = [
        'name',
        'birth',
        'gerder',
        'classroom_id',
        'is_accepted'
    ];

    protected $appends = [
        'is_accepted'
    ];

    public function getIsAcceptedAttribute()
    {
        return $this->attributes['birth'] > '2002-01-01' ? 'aceito' : 'não aceito';
    }

    /**
    * navegacao entre as relacoes das tabelas
    * 
    * @return void
    */
    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom');
    }
}
