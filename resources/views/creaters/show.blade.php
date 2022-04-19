@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-5 offset-1">
            <img src="{{ asset('img/dummy.png')}}" class="w-100 img-fuild">
        </div>
        <div class="col">
            <div class="d-flex flex-column">
                <h1 class="">
                    {{$creater->name}}
                </h1>
                <p class="">
                    {{$creater->description}}
                </p>
                <hr>
                <p class="d-flex align-items-end">
                    登録者数 {{$creater->price}}人
                </p>
            </div>
            @auth
            <form method="POST" class="m-3 align-items-end">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$creater->id}}">
                <input type="hidden" name="name" value="{{$creater->name}}">
                <input type="hidden" name="price" value="{{$creater->price}}">

                <input type="hidden" name="weight" value="0">
                <div class="row">
                    <div class="col-5">
                         @if($creater->isFavoritedBy(Auth::user()))
                         <a href="/creaters/{{ $creater->id }}/favorite" class="btn samazon-favorite-button text-favorite w-100">
                             <i class="fa fa-heart"></i>
                             お気に入り解除
                         </a>
                         @else
                         <a href="/creaters/{{ $creater->id }}/favorite" class="btn samazon-favorite-button text-favorite w-100">
                             <i class="fa fa-heart"></i>
                             お気に入り
                         </a>
                         @endif
                    </div>
                </div>
            </form>
            @endauth
        </div>

        <div class="offset-1 col-12">
            <hr class="w-100">
            <h3 class="float-left">プロモーションに繋げたい商品群を記載　(会員のみ記載・閲覧可能)</h3>
        </div>

        <div class="col-12 offset-1">
           <div class="row">
                 @foreach($reviews as $review)
                 <div class="col-5">
                     <p class="h3">{{$review->content}}</p>
                     <label>{{$review->created_at}}</label>
                        <div>
                          @if($review->is_liked_by_auth_user())
                            <a href="{{ route('reviews.unlike', ['id' => $review->id]) }}" class="btn btn-success btn-sm">Wishes<span class="badge">{{ $review->likes->count() }}</span></a>
                          @else
                            <a href="{{ route('reviews.like', ['id' => $review->id]) }}" class="btn btn-secondary btn-sm">Wishes<span class="badge">{{ $review->likes->count() }}</span></a>
                          @endif
                        </div>
                 </div>
                 @endforeach
             </div>
 <hr>
             @auth
             <div class="row">
                 <div class="offset-1 col-9">
                     <form method="POST" action="/creaters/{{ $creater->id }}/reviews">
                         {{ csrf_field() }}
                         <textarea name="content" class="form-control m-2"></textarea>
                         <button type="submit" class="btn samazon-submit-button ml-2">新プロモーション案を追加</button>
                     </form>
                 </div>
             </div>
             @endauth
        </div>
    </div>
</div>
@endsection