<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $pageSize = $request->integer('pagesize', 12);

        $products = $this->productQuery($request)
            ->paginate($pageSize)
            ->withQueryString();

        return view('catalog.index', compact('products'));
    }

    public function group(Group $parent, Request $request): View
    {
        $pageSize = $request->integer('pagesize', 12);

        $parent->load('childrenRecursive');
        $path = $parent->getPath();

        // Текущая ветка
        $groupIds = $parent->getChildrenIds();

        $products = $this->productQuery($request)
            ->whereIn('id_group', $groupIds)
            ->paginate($pageSize)
            ->withQueryString();


        return view('catalog.group', compact('parent', 'products', 'path'));
    }

    public function product(Product $product): View
    {
        $product->load(['group', 'price']);

        $breadcrumbs = $product->group->getPath();

        return view('catalog.product', compact('product', 'breadcrumbs'));
    }

    private function productQuery(Request $request): \Illuminate\Database\Eloquent\Builder
    {
        $allowedSorts = ['name', 'price'];
        $sort = in_array($request->input('sort', 'name'), $allowedSorts, true)
            ? $request->input('sort', 'name')
            : 'name';

        $direction = $request->input('direction', 'asc') === 'desc' ? 'desc' : 'asc';

        $query = Product::with(['group', 'price']);

        if ($sort === 'price') {
            $query->leftJoin('prices', 'products.id', '=', 'prices.id_product')
                  ->select('products.*')
                  ->orderBy('prices.price', $direction);
        } else {
            $query->orderBy('products.name', $direction);
        }

        return $query;
    }
}