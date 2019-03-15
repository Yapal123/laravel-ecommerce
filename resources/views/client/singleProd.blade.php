@extends('layouts.mainPage')
@section('content')
<div class="container">
  <div class="row">
    
    <div class="col-12">

  <div class="container-fluid mt-5">
    <div class="row text-center">
     <div class="col-lg-6 col-md-12">
     	<img src="{{ URL::asset('/img/products')}}/{{$prod->category_id}}/{{$prod->name}}.jpg" class="mainImg image" >
     	<div class="secimg">
        @foreach($imgs as $img)
     		<img src="{{ URL::asset('/img/products/')}}/{{$prod->category_id}}/{{$img->name}}" class="image secImg">
     		@endforeach
     		
     	</div>
     </div>
     <div class="col-lg-6 col-md-12">
     	<h1 class="text-center">
     		{{$prod->name}}
     	</h1>
     	<ul class="text-center mt-5">
     		<li>
     			<strong>Категория:{{$cat->title}}</strong>
     		</li>
     		<li>
     			<strong>Модель:</strong>{{$prod->name}}
     		</li>
     		<li>
          <?php 
            if ($prod->count > 10) {
              $count = 'Много';
            } elseif ($prod->count <= 10 or $prod->count >5){
              $count = 'Достаточно';
            } elseif($count <=5){
              $count = 'Мало';
            }
          ?>
     			<strong>На складе:</strong>{{$count}}
     		</li>

     	</ul>
     	<h3 class="mt-5">
     		${{$prod->price}}
     	</h3>
      @if($prod->count != 0)
     	<p class="text-success">
     		В наличии
     	</p>
      @else
      <p class="text-danger">
        Нет в наличии
      </p>
      @endif
     	<form class="form-group mt-5" method="GET" action="{{route('addToCart',$prod->id)}}">
     		<input type="submit" name="toCart" class="btn btn-success" value="To cart">
     	</form>
     	<h1 class="text-center">
     		Описание товара:
     	</h1>
     	<p>
     		{{$prod->descr}}
     	</p>
     </div>

    </div>
    <div class="row mt-5">
    	<div class="col-12">
    		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Характеристики</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Комментарии ({{count($comments)}})</a>
  </li>
  
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
 	<table class="table">
 		<thead>
 			<tr>
 				<th>
 					Свойства
 				</th>
 			</tr>
 		</thead>
 		<tbody>
 			@foreach($props as $prop)
	 		<tr>
	 			<td>
	 				
	 					{{$prop->title}}
	 				
	 			</td>
	 			<td>
	 				{{$prop->description}} {{$prop->unit}}
	 			</td>
	 		</tr>
	 		@endforeach
 		</tbody>
 	</table>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  	<h3 class="text-center">
  		Комментарии 
  	</h3>
    @foreach($comments as $comment)
  	<div class="media">
  
  <div class="media-body">
    <h5 class="mt-0"><strong>{{$comment->name}}</strong></h5>
    {{$comment->text}}
  </div>
</div>
  
  @endforeach
   @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
	@if(count($comments) == 0)
    <h3 class="text-center mt-3 mb-3">Еще никто не оставил свой комментарий</h3>
  @endif
@if(!Auth::check())
  	<h3 class="text-center mt-5">Оставьте свой комментарий</h3>
  	<form class="form-group" method="POST" action="{{route('postComment',$prod->id)}}">
      @csrf
  		<label>Ваше имя:</label>
  		<input type="text" name="name" class="form-group"><br>
  		<label>Ваш комментарий:</label><br>
  		<textarea class="txt w-50" name="comment"></textarea>
  		<br>
  		<input type="submit" name="doComment" class="btn btn-primary" value="Прокомментировать">
  	</form>
@else
<h3 class="text-center mt-3">Оставьте свой комментарий</h3>
<form class="mt-5" method="POST" action="{{route('postComment',$prod->id)}}">
  <label>Вашо комментарий:</label><br>
  @csrf
  <input type="hidden" name="name" value="{{Auth::user()->name}}">
  <textarea class="form-group w-50 m-auto txt" name="comment"></textarea><br>
  <input type="submit" name="post" value="Прокомментировать" class="btn btn-primary">
</form>
@endif
  </div>
 
</div>
    	</div>
    </div>
  </div>

</div>
  </div>
</div>
@endsection