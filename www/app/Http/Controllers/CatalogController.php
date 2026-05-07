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
        $sort = $request->input('sort', 'name') === 'name' ? 'name' : 'price';
        $direction = $request->input('direction', 'asc') === 'asc' ? 'asc' : 'desc';
        $pageSize = $request->integer('pagesize', 12);



        $groups = Group::where('id_parent', 0)
            ->with('children')
            ->get();

        foreach( $groups as $group ) {
            $groupIds = $group->getProductIds();

            $group->productsCount = Product::where('id_group', $groupIds)->count();
        }

        $products = Product::query()
            ->with(['group', 'price'])
            ->leftJoin('prices', 'products.id', '=', 'prices.id_product')
            ->orderBy(
                $sort === 'price'
                ? 'prices.price'
                : 'products.name',
                $direction
            )
            ->select('products.*')
            ->paginate($pageSize)
            ->withQueryString();
    
        
        return view('catalog.index', compact('groups', 'products'));
    }

    public function group(int $id, Request $request): View
    {
        $parent = Group::find($id);
        $children = Group::where('id_parent', $id);
        $productIds = $parent->getProductIds();

        $products = Product::with(['group', 'price'])
            ->whereIn('id', $productIds)
            ->paginate(12);
        
        return view('catalog.group', compact('parent', 'children', 'products'));
    }

    public function product(int $id, Request $request): View
    {
        $product = Product::with('group', 'price')
            ->findOrFail($id);

        return view('catalog.product', compact('product'));
    }
}