<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Webuser extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'name',
        'email',
        'password',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(UserOrder::class, 'users_id');
    }
}
