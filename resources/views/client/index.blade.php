@extends('layouts.mainPage')
@section('content')
<div class="container mt-5">
  <div class="row">
   
    <div class="col-2" id="show">
      <h3 class="display-6 mt-3">Категории</h3>
      <ul class="navbar-nav mr-auto  mt-lg-0 ">
        @foreach($cats as $cat)
        <li class="nav-item dropright " >
          <a href="{{route('products', $cat->id)}}" class="nav-link">{{$cat->title}}</a>
         
        </li>
        @endforeach
      </ul>
    </div>

    <div class="col-lg-8 col-sm-12">
      <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="10000">
      <img src="img/600x400.png" class="d-block w-100">
    </div>
    <div class="carousel-item" data-interval="2000">
      <img src="img/600x400.png" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="img/600x400.png" class="d-block w-100">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Туда</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Сюда</span>
  </a>
</div>
    </div>
      <div class="col-2" id="show">
        <h3>Самые популярные товары</h3>
        <ul class="list-group list-group-flush">
          @foreach($prods->unique('brand') as $prod)
          <li class="list-group-item">
            <form method="GET" action="{{route('search')}}">
              <input type="submit" name="id" value="{{$prod->brand}}" class="but">  
            </form>
          </li>
          @endforeach
           
        </ul>
      </div>
  </div>
  <div class="row mt-5">
    <div class="col-12">
      <h1 class="text-center">Самые популярные товары</h1>
    </div>
    <div class="row ">

      @foreach($prods as $prod)
      <div class="col-lg-3 col-sm-6 text-center">
    <div class="card">
  <a href="{{route('single',$prod->id)}}"><img src="{{ URL::asset('/img/products')}}/{{$prod->category_id}}/{{$prod->img_name}}.jpg" class="card-img-top" ></a>
  <div class="card-body">
    <a href="{{route('single',$prod->id)}}"><h5 class="card-title">{{$prod->name}}</h5></a>
    <p class="card-text " >
     
     <h4 class="text-center">${{$prod->price}}</h4>
    </p>
    <a href="{{route('addToCart',$prod->id)}}" class="btn btn-success m-auto">В коризну</a>
  </div>
</div>
    </div>
    @endforeach
       

  </div>
</div>
</div>
@endsection