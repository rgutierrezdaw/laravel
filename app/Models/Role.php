<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    protected $fillable = [
            'name',
        ];
}
