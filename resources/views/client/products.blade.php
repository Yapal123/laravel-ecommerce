@extends('layouts.mainPage')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-3" >
     @include('client.Sidebar')
    
    </div>
    <div class="col-lg-9 col-md-12">

 
  
   

  <div class="container-fluid">
    <div class="row text-center">
      @foreach($prods as $prod)
          <div class="col-md-4 col-sm-6">
          <div class="card">
  <a href="{{route('single',$prod->id)}}"><img src="{{ URL::asset('/img/products')}}/{{$prod->category_id}}/{{$prod->name}}.jpg" class="mainImg" ></a>
  <div class="card-body">
    <h5 class="card-title"><a href="{{route('single',$prod->id)}}">{{$prod->name}}</a></h5>
    <p class="card-text " >
      Брэнд:{{$prod->brand}}
     <h4 class="text-center">{{$prod->price}}$</h4>
    </p>
    <a href="{{route('addToCart',$prod->id)}}" class="btn btn-success m-auto">В корзину</a>
  </div>
</div>
    </div>
    
    @endforeach
      
       
       
      
    </div>
  </div>
  <div class="pag mt-5">
  <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    {{$prods->links()}}
  </ul>
</nav>
</div>
</div>
  </div>
</div>
@endsection