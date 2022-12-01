<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kredit extends Model
{
    use HasFactory;
    protected $table = "kredit";
    protected $id = "id";
    protected $guarded = ['id'];

    public function dataUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
