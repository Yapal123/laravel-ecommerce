@extends('layouts.mainPage')

@section('content')
<div class="container">
	<div class="row" id="table">
		<div class="col-12">
			<h2 class="text-center mt-3">
				Ваша корзина покупок
			</h2>
		
			<table class="table" id="table">
				
				<thead>
					<tr>
						  <th scope="col">Изображение</th>
					      <th scope="col">Название</th>
					      <th scope="col">Изготовитель</th>
					      <th scope="col">Цена</th>
					      <th scope="col">Кол-во</th>
					      <th scope="col">Всего</th>
					      <th scope="col">Действие</th>
					</tr>
				</thead>
				<tbody>
					<?php $total = 0; ?>
					@if(session('cart'))
						@foreach(session('cart') as $id => $details)
						<?php $total += $details['price'] * $details['quantity'] ?> 
							<tr>
						<td>
							<img src="{{ URL::asset('/img/products')}}/{{$details['category']}}/{{$details['name']}}.jpg" class="cartImg">
						</td>
						<td>
							{{$details['name']}}
							
						</td>
						<td>
							{{$details['brand']}}
						</td>
						<td>
							${{$details['price']}}
							</td>
							<td data-th="Quantity">
	                        	<input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" id="quantity" />
	                    	</td>
						<td>
							${{$details['price'] * $details['quantity']}}
						</td>
						  <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}">
                        	<i class="fa fa-refresh">
                        		Обновить
                        	</i>
                        </button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">
                        	<i class="fa fa-trash-o">
                        		Убрать
                        	</i>
                    	</button>
                    </td>
					</tr>

						@endforeach
						<caption class="text-right">
						<strong>
							Всего:
						</strong>
						${{$total}}
					</caption> 
					@endif
				
				</tbody>
			</table>
			<a href="{{route('purchase')}}">
				<button  class="btn btn-success" >
					Оформить заказ
				</button> 
			</a>
	
		</div>
	</div>
</div>
@endsection

 
