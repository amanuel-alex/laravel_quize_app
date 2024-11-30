<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Specify the fields that are mass assignable
    protected $fillable = ['question_text', 'option_a', 'option_b', 'option_c', 'correct_option'];
}
