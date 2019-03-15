@extends('layouts.adminPage')
@section('content')
<form action="{{route('updateOrder')}}" method="POST">
	@csrf
	<input type="hidden" name="id" value="{{$order->id}}">
<table class="table">
     	<h2 >
     		Информация о заказе
     		<hr>
     	</h2>
     	<h5>
     		<strong>Имя покупателя: </strong><input type="text" name="name" class="form-control" value="{{$order->name}}">
     	</h5>
     	<h5>
     		<strong>Фамилия покупателя: </strong><input type="text" name="secondName" class="form-control" value="{{$order->secname}}">
     	</h5>
     	<h5>
     		<strong>Email: </strong><input type="email" name="email" class="form-control" value="{{$order->email}}">
     	</h5>
     	<h5>
     		<strong>Номер телефона: </strong><input type="text" name="phone" class="form-control" value="{{$order->phone}}">
     	</h5>
     	<h5>
     		<strong>Создан:</strong>{{$order->created_at}}
     	</h5>
     	<h3 class="mt-5">
     		Информация о доставке
     		<hr>
     	</h3>
     	<h5>
     		<strong>Тип доставки: </strong>
     		<select class="form-control" name="delivery">
		         <option value="courier" >Курьер($10.00)</option>
		         <option value="Pickup" >Самовывоз($0.00)</option>
		        </select>
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
     		Заказ
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
     				<input type="text" name="quantity[]" class="form-control" value="{{$prod->prod_quantity}}">
     	
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
     		<strong>Всего:</strong>${{$sum}}
     	</h5>
     <input type="submit" name="subOrder" class="btn btn-outline-primary float-right mt-3 mb-5" value="Сохранить">
     </form>
     <p>


     	
     </p>
@endsection