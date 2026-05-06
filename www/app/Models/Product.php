<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['id_group', 'name'])]
class Product extends Model
{
    use HasFactory;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class, 'id_product');
    }

    public function price(): HasOne
    {
        return $this->hasOne(Price::class, 'id_product')->latestOfMany();
    }
}
