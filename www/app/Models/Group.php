<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['id_parent', 'name'])]
class Group extends Model
{
    use HasFactory;

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'id_parent');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'id_parent');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id_group');
    }

    public function getProductIds(): array
    {
        $ids = $this->products->pluck('id')->toArray();
        
        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllProductIds());
        }
        
        return $ids;
    }
}
