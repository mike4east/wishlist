<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreaterRequest;
use App\Http\Requests\UpdateCreaterRequest;
use App\Models\Creater;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


use Validator;

class CreaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->category !== null) {
             $creaters = Creater::where('category_id', $request->category)->paginate(15);
             $total_count = Creater::where('category_id', $request->category)->count();
         } else {
             $creaters = Creater::paginate(15);
             $total_count = "";
         }
        $categories = Category::all();
         $major_category_names = Category::pluck('major_category_name')->unique();
 
         return view('creaters.index', compact('creaters', 'categories', 'major_category_names'));
         //
    }
      public function favorite(Creater $creater)
     {
         $user = Auth::user();
 
         if ($user->hasFavorited($creater)) {
             $user->unfavorite($creater);
         } else {
             $user->favorite($creater);
         }
 
         return redirect()->route('creaters.show', $creater);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
 
        return view('creaters.create', compact('categories'));
        return view('creaters.create');
         //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCreaterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreaterRequest $request)
    {
        $creater = new Creater();
         $creater->name = $request->input('name');
         $creater->description = $request->input('description');
         $creater->price = $request->input('price');
          $creater->category_id = $request->input('category_id');
         $creater->save();
 
         return redirect()->route('creaters.show', ['id' => $product->id]);
         //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creater  $creater
     * @return \Illuminate\Http\Response
     */
    public function show(Creater $creater)
    {
         $reviews = $creater->reviews()->get();
 
         return view('creaters.show', compact('creater', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creater  $creater
     * @return \Illuminate\Http\Response
     */
    public function edit(Creater $creater)
    {
        $categories = Category::all();
 
        return view('creaters.edit', compact('creater', 'categories'));
        return view('creaters.edit', compact('creater'));
         //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreaterRequest  $request
     * @param  \App\Models\Creater  $creater
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreaterRequest $request, Creater $creater)
    {
        $creater->name = $request->input('name');
         $creater->description = $request->input('description');
         $creater->price = $request->input('price');
         $creater->category_id = $request->input('category_id');

         $creater->update();
 
         return redirect()->route('creaters.show', ['id' => $creater->id]);
         //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creater  $creater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creater $creater)
    {
        $creater->delete();
 
         return redirect()->route('creaters.index');
         //
    }
}
