<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
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

    protected static function booted(): void
    {
        static::saved(fn(self $group) => self::flushCache());
        static::deleted(fn(self $group) => self::flushCache());
    }

    public static function rootTree(): Collection
    {
        $ids = Cache::remember('catalog_root_group_ids', 3600, function () {
            return self::where('id_parent', 0)->pluck('id')->toArray();
        });

        return self::with('childrenRecursive')->whereIn('id', $ids)->get();
    }

    public static function flushCache(): void
    {
        Cache::forget('catalog_root_group_ids');
        Cache::forget('catalog_root_groups');
        Cache::forget('groups_products_count');
    }
}
