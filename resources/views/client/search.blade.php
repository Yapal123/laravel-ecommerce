@extends('layouts.mainPage')
@section('content')
<div class="container ">
   <div class="row ">
     <div class="col-12 text-center mt-5">
       <h2 class="text-center">Результаты поиска:</h2>
       <div class="row ">
        @foreach($prods as $prod)
        <div class="col-lg-3 col-sm-6 text-center">
    <div class="card">
  <a href="{{route('single',$prod->id)}}"><img src="{{ URL::asset('/img/products')}}/{{$prod->category_id}}/{{$prod->name}}.jpg" class="card-img-top" ></a>
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
 </div>
 @endsection