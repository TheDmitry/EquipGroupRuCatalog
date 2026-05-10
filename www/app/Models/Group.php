<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

#[Fillable(['id_parent', 'name'])]
class Group extends Model
{
    use HasFactory;

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'id_parent');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
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
        $ids = Product::where('id_group', $this->id)
            ->pluck('id')
            ->toArray();

        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getProductIds());
        }

        return $ids;
    }

    public function getChildrenIds(): array
    {
        $ids = [$this->id];

        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getChildrenIds());
        }

        return $ids;
    }

    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    public function getPath(): array
    {
        $ids = [$this->id];

        $parent = $this->parent;

        while ($parent) {
            $ids[] = $parent->id;
            $parent = $parent->parent;
        }

        return array_reverse($ids);
    }

    public function getProductsCountAttribute(): int
    {
        $counts = self::getProductsCountWithCache();
        $childrenIds = $this->getChildrenIds();
        return collect($childrenIds)->sum(fn($id) => $counts[$id] ?? 0);
    }

    public static function getProductsCountWithCache(): array
    {
        return Cache::remember('groups_products_count', 300, function () {
            return Product::selectRaw('id_group, COUNT(*) as cnt')
                ->groupBy('id_group')
                ->pluck('cnt', 'id_group')
                ->toArray();
        });
    }
}
