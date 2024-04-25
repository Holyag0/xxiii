<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCfc extends Model
{
    protected $table = 'users_cfcs';

    protected $fillable = array
    (  
        'id',
        'cfc_id',
        'user_id', 
        
    );
   
}
