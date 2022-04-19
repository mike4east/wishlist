<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Creater;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortBy('major_category_name');

        $major_category_names = Category::pluck('major_category_name')->unique();
   
          $recently_creaters = Creater::orderBy('created_at', 'desc')->take(4)->get();
 
         $recommend_creaters = Creater::where('recommend_flag', true)->take(3)->get();
 
        return view('web.index', compact('major_category_names', 'categories', 'recently_creaters', 'recommend_creaters'));
   
     
    }
    //
}
