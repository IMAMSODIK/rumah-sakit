<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pasien extends Model
{
    use HasFactory;

    public function statusPasien(): HasOne{
        return $this->hasOne(StatusPasien::class);
    }

    public function jenisLayanan(): BelongsTo{
        return $this->belongsTo(JenisLayanan::class);
    }
}
