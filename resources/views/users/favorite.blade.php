@extends('layouts.app')

@section('content')
<div class="container  d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>お気に入り</h1>

        <hr>

        <div class="row">
            @foreach ($favorites as $fav)
            <div class="col-md-8 mt-2">
                <div class="d-inline-flex">
                    <a href="{{route('creaters.show', $fav)}}" class="w-25">
                        <img src="{{ asset('img/dummy.png')}}" class="img-fuild w-100">
                    </a>
                    <div class="container mt-3">
                        <h5 class="w-100 samazon-favorite-item-text">{{App\Models\Creater::find($fav->favoriteable_id)->name}}</h5>
                        <h6 class="w-100samazon-favorite-item-text">登録者数 {{App\Models\Creater::find($fav->favoriteable_id)->price}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <a href="/creaters/{{ $fav->id }}/favorite" class="samazon-favorite-item-delete">
                    削除
                </a>
            </div>
            @endforeach
        </div>

        <hr>
    </div>
</div>
@endsection
