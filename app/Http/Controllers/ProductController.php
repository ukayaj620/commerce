<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        return view('admin.product.add', [
            'categories' => $categories,
            'url' => 'admin'
        ]);
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.product.edit', [
            'categories' => $categories,
            'product' => $product,
            'url' => 'admin'
        ]);
    }

    public function fetchAll()
    {
        $products = Product::all();
        return view('admin.product.index', [
            'products' => $products,
            'url' => 'admin'
        ]);
    }

    public function fetchById($id)
    {
        $product = Product::find($id);
        return view('admin.product.view', [
            'product' => $product
        ]);
    }

    public function create(Request $request)
    {
        // must in the same order with form
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'category' => 'required',
            'product_rate' => 'required',
            'description' => 'required',
            'image' => 'required|file'
        ]);

        $photo = $request->file('image');
        $image_path = uniqid() . '.' .$photo->extension();
        $path = $photo->storeAs('public/', $image_path);

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'weight' => $request->input('weight'),
            'product_rate' => $request->input('product_rate'),
            'description' => $request->input('description'),
        ]);

        $product->categories()->attach($request->input('category'));

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $image_path
        ]);

        return redirect(route('product.byId', ['id' => $product->id]));
    }

    public function update(Request $request)
    {
        // must in the same order with form
        $request->validate([
            'id' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($request->input('id'));

        Product::whereId($request->input('id'))->update([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'weight' => $request->input('weight'),
            'description' => $request->input('description'),
        ]);

        $product->categories()->detach($product->categories[0]->id);

        $product->categories()->attach($request->input('category'));

        if($request->hasFile('image')) {
            $product_image = ProductImage::where('product_id', '=', $product->id)->first();

            Storage::delete('/public/' . $product_image->image_path);

            $photo = $request->file('image');
            $image_path = uniqid() . '.' .$photo->extension();
            $path = $photo->storeAs('public/', $image_path);

            ProductImage::whereId($product_image->id)->update([
                'image_path' => $image_path
            ]);
        }

        return redirect(route('product.byId', ['id' => $product->id]));
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        return redirect(route('product.fetchAll'));
    }
}
