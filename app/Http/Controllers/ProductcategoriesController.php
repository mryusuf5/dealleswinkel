<?php

namespace App\Http\Controllers;

use App\Models\Productcategories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productcategories = Productcategories::all();
        return view('admin.productcategories.index', compact('productcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = new Productcategories();

        $category->name = ucfirst($request->name);
        $category->description = ucfirst($request->description);
        $this->checkImage($request, $category);

        $category->save();

        return redirect()->route('admin.productcategories.index')->with('success', 'Categorie opgeslagen');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productcategories $productcategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productcategory = Productcategories::where('id', $id)->with('products')->first();

        return view('admin.productcategories.edit', compact('productcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Productcategories::where('id', $id)->first();
        $category->name = ucfirst($request->name);
        $category->description = ucfirst($request->description);
        $this->checkImage($request, $category, true);
        $category->save();

        return redirect()->route('admin.productcategories.index')->with('success', 'Categorie aangepast');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Productcategories::destroy($id);
        Products::where('category_id', $id)->delete();

        return redirect()->route('admin.productcategories.index')->with('success', 'Categorie verwijderd');
    }

    public function userIndex()
    {
        $productcategories = Productcategories::with('products')->get();
        $topProducts = Products::take(3)->get();

        return view('user.welcome', compact(
            'productcategories',
            'topProducts'
        ));
    }

    public function userCategories()
    {
        $productcategories = Productcategories::all();
        $products = Products::all();

        return view('user.productcategories.index', compact(
            'productcategories',
        'products'));
    }

    public function userSingleCategory($id)
    {
        $productcategory = Productcategories::where('id', $id)->with('products')->first();
        $productcategories = Productcategories::all();

        return view('user.productcategories.show', compact(
            'productcategory',
            'productcategories'
        ));
    }

    public function checkImage($request, $productCategory, $update = false)
    {
        if(!$update)
        {
            if($request->file('image'))
            {
                $imageName = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/category/', $imageName);
                $productCategory->image = $imageName;
            }
            else
            {
                $productCategory->image = 'category-default.png';
            }
        }
        else
        {
            if($request->file('image'))
            {
                $imageName = 'category-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move('img/category/', $imageName);
                $productCategory->image = $imageName;
            }
        }

    }
}
