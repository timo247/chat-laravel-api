<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;
    protected $fillable = ['last_initialization', 'last_activation', 'user_desactivation', 'user_reactivation'];
}
