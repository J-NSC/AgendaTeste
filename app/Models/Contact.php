<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image_path'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_contacts', 'contact_id', 'user_id');
    }
}
