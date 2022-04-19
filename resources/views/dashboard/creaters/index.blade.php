@extends('layouts.dashboard')

@section('content')
<h1>クリエイター一覧</h1>
<form method="GET" action="{{ route('dashboard.creaters.index')}}" class="form-inline">
    並び替え
    <select name="sort" onChange="this.form.submit();" class="form-inline ml-2">
        @foreach ($sort as $key => $value)
        @if ($sorted == $value)
        <option value=" {{ $value}}" selected>{{ $key }}</option>
        @else
        <option value=" {{ $value}}">{{ $key }}</option>
        @endif
        @endforeach
    </select>
</form>

<div class="w-75 mt-2">
    <div class="w-75">
        <form method="GET" action="{{ route('dashboard.creaters.index') }}">
            <div class="d-flex flex-inline form-group">
                <div class="d-flex align-items-center">
                    商品ID・商品名
                </div>
                <textarea id="search-products" name="keyword" class="form-controll ml-2 w-50">{{$keyword}}</textarea>
            </div>
            <button type="submit" class="btn samazon-submit-button">検索</button>
        </form>
    </div>

    <div class="d-flex justify-content-between w-75 mt-4">
        <h3>合計{{$total_count}}件</h3>

        <a href="{{ route('dashboard.creaters.create') }}" class="btn samazon-submit-button">+ 新規作成</a>
    </div>
    <div class="table-responsive">
        <table class="table fixed-table mt-5">

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">画像</th>
                    <th scope="col">商品名</th>
                    <th scope="col">登録者</th>
                    <th scope="col">カテゴリ名</th>
                    <th scope="col">親カテゴリ名</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($creaters as $creater)
                <tr>
                    <th scope="row">{{ $creater->id }}</td>
                    <td><img src="{{ asset('img/dummy.png')}}" class="img-fluid w-80"></td>
                    <td>{{ $creater->name }}</td>
                    <td>{{ $creater->price }}</td>
                    <td>{{ $creater->category["name"] }}</td>
                    <td>{{ $creater->category["major_category_name"] }}</td>
                    <td>
                        <a href="/dashboard/creaters/{{ $creater->id }}/edit" class="dashboard-edit-link">編集</a>
                    </td>
                    <td>
                        <a href="/dashboard/creaters/{{ $creater->id }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dashboard-delete-link">
                            削除
                        </a>

                        <form id="logout-form" action="/dashboard/creaters/{{ $creater->id }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $creaters->links() }}
</div>
@endsection