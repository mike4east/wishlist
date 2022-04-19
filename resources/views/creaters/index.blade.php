@extends('layouts.app')

@section('content')
<div class="row">
         <div class="col-2">
         @component('components.sidebar', ['categories' => $categories, 'major_category_names' => $major_category_names])
         @endcomponent
     </div>

    <div class="col-9">
        <div class="container mt-4">
            <div class="row w-100">
                @foreach($creaters as $creater)
                <div class="col-3">
                    <a href="{{route('creaters.show', $creater)}}">
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <p class="samazon-product-label mt-2">
                                {{$creater->name}}<br>
                                <label>{{$creater->price}}</label>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
                 {{ $creaters->links() }}
    </div>
</div>
@endsection
