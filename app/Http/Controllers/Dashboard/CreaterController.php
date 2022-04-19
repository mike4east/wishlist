<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Creater;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $sort_query = [];
          $sorted = "";
 
          if ($request->sort !== null) {
              $slices = explode(' ', $request->sort);
              $sort_query[$slices[0]] = $slices[1];
              $sorted = $request->sort;
          }
 
          if ($request->keyword !== null) {
              $keyword = rtrim($request->keyword);
              $total_count = Creater::where('name', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->count();
              $creaters = Creater::where('name', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->sortable($sort_query)->paginate(15);
          } else {
              $keyword = "";
              $total_count = Creater::count();
              $creaters = Creater::sortable($sort_query)->paginate(15);
          }
 
          $sort = [
              '価格の安い順' => 'price asc',
              '価格の高い順' => 'price desc',
              '出品の古い順' => 'updated_at asc',
              '出品の新しい順' => 'updated_at desc'
          ];
 
          return view('dashboard.creaters.index', compact('creaters', 'sort', 'sorted', 'total_count', 'keyword'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $categories = Category::all();
 
          return view('dashboard.creaters.create', compact('categories'));
          //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              $request->validate([
              'name' => 'required',
              'price' => 'required',
              'description' => 'required',
          ],
          [
              'name.required' => '商品名は必須です。',
              'price.required' => '価格は必須です。',
              'description.required' => '商品説明は必須です。',
          ]);
 
          $creater = new Creater();
          $creater->name = $request->input('name');
          $creater->description = $request->input('description');
          $creater->price = $request->input('price');
          $creater->category_id = $request->input('category_id');
          if ($request->input('recommend') == 'on') {
          $creater->recommend_flag = true;
          } else {
          $creater->recommend_flag = false;
          }
          $creater->save();
 
          return redirect()->route('dashboard.creaters.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Creater $creater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Creater $creater)
    {
          $categories = Category::all();
 
          return view('dashboard.creaters.edit', compact('creater', 'categories'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creater $creater)
    {
              $request->validate([
              'name' => 'required',
              'price' => 'required',
              'description' => 'required',
          ],
          [
              'name.required' => '商品名は必須です。',
              'price.required' => '価格は必須です。',
              'description.required' => '商品説明は必須です。',
          ]);
 
          $creater->name = $request->input('name');
          $creater->description = $request->input('description');
          $creater->price = $request->input('price');
          $creater->category_id = $request->input('category_id');
          if ($request->input('recommend') == 'on') {
          $creater->recommend_flag = true;
          } else {
          $creater->recommend_flag = false;
          }
          $creater->update();
 
          return redirect()->route('dashboard.creaters.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creater $creater)
    {
          $creater->delete();
 
          return redirect()->route('dashboard.creaters.index');
        //
    }
}
