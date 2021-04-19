<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function fetchAll() {
        $categories = Category::all();
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
        ]);
        Category::create($request->all());
        $categories = Category::all();
        return redirect('/category');
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'category_name' => 'required',
            'description' => 'required',
        ]);
        // TODO. Find out why $request->all() can't return a true output
        Category::whereId($request->input('id'))->update([
            'category_name' => $request->input('category_name'),
            'description' => $request->input('description'),
        ]);
        return redirect('/category');
    }

    public function delete($id) {
        Category::find($id)->delete();
        return redirect('/category');
    }
}
