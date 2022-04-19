@extends('layouts.app')

@section('content')
<div class="container">
    <h1>クリエイター情報更新</h1>

    <form method="POST" action="/products/{{ $creater->id }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="product-name">商品名</label>
            <input type="text" name="name" id="product-name" class="form-control" value="{{ $creater->name }}">
        </div>
        <div class="form-group">
            <label for="product-description">商品説明</label>
            <textarea name="description" id="product-description" class="form-control">{{ $creater->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="product-price">価格</label>
            <input type="number" name="price" id="product-price" class="form-control" value="{{ $creater->price }}">
        </div>
        <div class="form-group">
            <label for="product-category">カテゴリ</label>
            <select name="category_id" class="form-control" id="product-category">
                @foreach ($categories as $category)
                @if ($category->id == $creater->category_id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-danger">更新</button>
    </form>

    <a href="/creaters">一覧に戻る</a>
</div>
@endsection