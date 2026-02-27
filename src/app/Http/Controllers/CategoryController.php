<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(CategoryRequest $request){
        $data = $request->validated();
        $category = Category::create($data);

        return $category ? back()->with('success', 'Catégorie ajouté avec succès!') : back()->with('error', 'Un problème a survenu lors de la création de la catégorie') ;
    }
}
