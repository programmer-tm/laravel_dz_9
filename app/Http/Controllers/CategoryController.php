<?php

namespace App\Http\Controllers;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
	{
		return view('category.index', [
			'categories' => Category::paginate(
				config('categories.paginate')
			)
		]);
	}
}
