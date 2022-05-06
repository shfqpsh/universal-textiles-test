<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    public function getPackBySize($pack_size)
    {
        return Pack::Where([['pack_size', '=', $pack_size]])->get();

    }
}
