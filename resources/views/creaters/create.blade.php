@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新しいクリエイターを追加</h1>

    <form method="POST" action="/creaters">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="product-name">クリエイター名</label>
            <input type="text" name="name" id="product-name" class="form-control">
        </div>
        <div class="form-group">
            <label for="product-description">概要</label>
            <textarea name="description" id="product-description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="product-price">価格</label>
            <input type="number" name="price" id="product-price" class="form-control">
        </div>
        <div class="form-group">
            <label for="product-category">カテゴリ</label>
            <select name="category_id" class="form-control" id="product-category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">クリエイターを登録</button>
    </form>

    <a href="/creaters">一覧に戻る</a>
</div>
@endsection