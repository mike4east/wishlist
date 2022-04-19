@extends('layouts.app')

@section('content')
         <section id="About" class="section">
      <div class="text__center">
        <h1 class="yellow__title">Creater's wishlistとは</h1>

        <p>creater's wishlist はクリエイターをファンの声で後押しするプラットフォームです。</p>

        <p>クリエイターがたくさんいる時代、自分の推しが長く、好きなことを続けられるように<br>
        あなた達の声で、クリエイターとプロモーションを行いたい企業、サービスをつなげます。</p>
          
        <p>※Wishlistの運営が、ファンが記載、投票した内容に沿って、各種事業主に案件のアプローチを行い、<br>
        このサイトの投票を通して実現した案件では、クリエイターとのコラボ商品・サービスを抽選でプレゼントします。</p>

        <img src="./img/ファン起点メディアPF.png" alt="ビジネスプラン" id="main">

      </div>
    </section>

<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories, 'major_category_names' => $major_category_names])
        @endcomponent
    </div>
    <div class="col-9">
        <h1>おすすめクリエイター</h1>
            <div class="row">
            @foreach ($recommend_creaters as $recommend_creater)
            <div class="col-4">
                <a href="/creaters/{{ $recommend_creater->id }}">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="samazon-product-label mt-2">
                            {{ $recommend_creater->name }}<br>
                            <label>登録者 {{ $recommend_creater->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h1>新着クリエイター</h1>
        <div class="row">
            @foreach ($recently_creaters as $recently_creater)
            <div class="col-3">
                <a href="/creaters/{{ $recently_creater->id }}">
                    <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="samazon-product-label mt-2">
                            {{ $recently_creater->name }}<br>
                            <label>登録者 {{ $recently_creater->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection