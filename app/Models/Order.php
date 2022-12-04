<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $id = 'id';
    protected $guarded = ['id'];

    public function dataMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function dataUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
