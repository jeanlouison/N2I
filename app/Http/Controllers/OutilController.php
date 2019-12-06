<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;

class OutilController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Categories::select('name')->get();
        return view('categories')
            ->with('categories', $categories)
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }

    public function category(Request $request, $catName)
    {
        $subjects = Categories::where('name',$catName)->first();;
        return view('contentCategorie')
            ->with('category', $catName)
            ->with('subjects', $subjects)
            ->with('error_message', $request->session()->get('error_message') ?? null);
    }
}
