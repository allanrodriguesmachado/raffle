<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Raffle extends Model
{
    /** @use HasFactory<\Database\Factories\RaffleFactory> */
    use HasFactory;

//    public function applicat(): BelongsTo
//    {
//        return $this->hasMany(Applicat::class);
//    }
}
