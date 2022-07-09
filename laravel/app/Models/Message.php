<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;


    use HasFactory;
    protected $fillable = ['contenu', 'user_id', 'created_at'];
    
    public function user() {                    
        return $this->belongsTo(User::class);    
    } 

}
