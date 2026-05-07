<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::where('id_parent', 0)
            ->get();

        $products = Product::query()
            ->with(['group', 'price'])
            ->paginate(12);

        
        return view('catalog.index', compact('groups', 'products'));
    }
}