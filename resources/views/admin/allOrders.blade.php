@extends('layouts.adminPage')
@section('content')
<form class="form-inline" method="GET" action="{{route('allOrders')}}">
  <div class="form-group mb-2">
    
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" class="form-control" id="inputSearch" placeholder="Поиск" name="search">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Найти</button>
</form>
<table class="table">
     	<thead>
     		<tr>
     			<th>
     				ID
     			</th>
     			<th>
     				Название товара
     			</th>
     			<th>
     				Email
     			</th>
     			<th>
     				Товар	
     			</th>
     			<th>
     				Дата заказа 
     			</th>

     		
     		</tr>
     	</thead>
     	<tbody>
     	@foreach($orders as $order)	
     	<?php 
     		$or = $order->where('created_at','=',$order->created_at)->get();
     	?>
     		<tr>
     			<td>
     				{{$order->id}}
     			</td>
     			<td>
     				<a href="{{route('singleOrder',$order->id)}}">{{$order->name}}</a>
     			</td>
     			<td>
     				{{$order->email}}
     			</td>
     			<td>
     				@foreach($or as $r)
     				{{$r->prod_name}}<br>
     				@endforeach
     			</td>
     			<td>
     				{{$order->created_at}}
     			</td>

     		</tr>
     	@endforeach     	
     	</tbody>
     </table>
     <nav aria-label="Page navigation example">
  <ul class="pagination">
    {{$orders->links()}}
  </ul>
</nav>
@endsection