<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    use HasFactory;
    protected $fillable=['headshot','agree','disagree','attribute_type','attribute_name','answer','profile','likes'];

}
