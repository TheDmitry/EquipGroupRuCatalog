<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['id_group', 'price'])]
class Product extends Model
{
    use HasFactory;

    protected $appends = ['formatted_price']; // Добавлено для автоматического включения аксессора

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group');
    }


    public function price(): HasOne
    {
        return $this->hasOne(Price::class, 'id_product');
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price?->price ?? 0, 2, '.', ' ') . ' ₽';
    }
}
