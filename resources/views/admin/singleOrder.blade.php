@extends('layouts.adminPage')
@section('content')
<table class="table">
     	<h2 >
     		Информация о заказе
     		<hr>
     	</h2>
     	<h5>
     		<strong>Имя покупателя: </strong>{{$order->name}}
     	</h5>
     	<h5>
     		<strong>Фамилия покупателя: </strong>{{$order->secname}}
     	</h5>
     	<h5>
     		<strong>Email:</strong>{{$order->email}}
     	</h5>
     	<h5>
     		<strong>Номер телефона:</strong>{{$order->phone}}
     	</h5>
     	<h5>
     		<strong>Создан:</strong>{{$order->created_at}}
     	</h5>
     	<h3 class="mt-5">
     		Информация о доставке
     		<hr>
     	</h3>
     	<h5>
     		<strong>Тип доставки: </strong>{{$order->delivery}}
     	</h5>
     	<h5>
     		<strong>Комментарий к заказу:</strong> {{$order->comment}}
     	</h5>
     	<h5 class="text-right mt-5">
               <?php 
                    if ($order->delivery == 'courier') {
                         $price = 10;
                    } else $price = 0;
               ?>
     		<strong>Цена доставки:</strong>${{$price}}
     	</h5>
     	<h3 class="mt-5">
     		Purchase
     	</h3>
     	 <table class="table">
     	<thead>
     		<tr>
     			<th>
     				ID
     			</th>
     			<th>
     				Название 	
     			</th>
     			<th>
     				Количество 	
     			</th>
     			<th>
     				Цена
     			</th>
     			<th>
     				Итого
     			</th>
     			
     		</tr>
     	</thead>
     	<tbody>
     		<?php $sum = 0?>
     		@foreach($prodOrders as $prod)
     		<?php 
     			
     		?>
     		<tr>
     			<td>
     				{{$prod->prod_id}}
     			</td>
     			<td>
     				<a href="{{route('editItem',$prod->prod_id)}}">{{$prod->prod_name}} </a>
     			</td>
     			<td>
     				{{$prod->prod_quantity}}
     			</td>
     			<td>
     				{{$prod->prod_price}}
     			</td>
     			<td>
     				{{$prod->prod_subtotal}}
     			</td>
     		<?php $sum += $prod->prod_subtotal ?>

     		</tr>
     		@endforeach
     	</tbody>
     </table>
     <h5 class="text-right mt-5">
     		<strong>ИТОГО:</strong>${{$sum}}
     	</h5>
     <a href="{{route('editOrder',$order->id)}}"><button class="btn btn-outline-primary float-right mt-3 mb-5">Редактировать</button></a>
     <p>

     </p>
@endsection