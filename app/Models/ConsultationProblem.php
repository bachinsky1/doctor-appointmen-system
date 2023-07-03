<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationProblem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'consultation_problems';

    protected $fillable = [
        'hierarchy_level', 
        'classification_place',
        'terminal_type',
        'chapter_id',
        'code1',
        'code2',
        'code3',
        'code4',
        'title1',
        'title2',
        'title3',
        'reference1',
        'reference2',
        'reference3',
        'reference4',
        'reference5',
        'reference6',
        'consultation_id'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
