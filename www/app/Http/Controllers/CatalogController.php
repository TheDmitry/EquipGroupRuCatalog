<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $pageSize = $request->integer('pagesize', 12);

        $groups = Group::with('childrenRecursive')->where('id_parent', 0)->get();

        $products = $this->productQuery($request)
            ->paginate($pageSize)
            ->withQueryString();

        return view('catalog.index', compact('groups', 'products'));
    }

    public function group(int $id, Request $request): View
    {
        $pageSize = $request->integer('pagesize', 12);

        // Корень
        $groups = Group::with('childrenRecursive')->where('id_parent', 0)->get();

        // Текущая + путь до нее
        $parent = Group::with('childrenRecursive')->findOrFail($id);
        $path = $parent->getPath();

        // Текущая ветка
        $groupIds = $parent->getChildrenIds();

        $products = $this->productQuery($request)
            ->whereIn('id_group', $groupIds)
            ->paginate($pageSize)
            ->withQueryString();


        return view('catalog.group', compact('parent', 'groups', 'products', 'path'));
    }

    public function product(int $id): View
    {
        $product = Product::with(['group', 'price'])
            ->findOrFail($id);

        return view('catalog.product', compact('product'));
    }

    private function productQuery(Request $request): \Illuminate\Database\Eloquent\Builder
    {
        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $query = Product::with(['group', 'price']);

        if ($sort === 'price') {
            $query->leftJoin('prices', 'products.id', '=', 'prices.id_product')
                  ->orderBy('prices.price', $direction)
                  ->select('products.*', 'prices.price');
        } else {
            $query->orderBy('products.name', $direction);
        }

        return $query;
    }
}