<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Symptom extends Model
{
    use HasFactory;
    use Searchable;
    protected $searchFields = ['name'];
}
