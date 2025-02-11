<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;
    protected $table = 'contact';


    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'user_id',
        'image_path'
    ];
    public function user(){
        return $this->belongsTo(user::class);
    }
}
