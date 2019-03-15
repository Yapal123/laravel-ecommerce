@extends('layouts.mainPage')

@section('content')
<div class="container">

	<div class="row">

		<div class="col-lg-4 col-sm-12 text-center">
			<h3 class="text-center mt-4">
				Информация о вас

			</h3>
			 @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
			<form method="POST" action="{{route('order')}}" ><br>
				<p class="text-center text-info">
					Все поля обязательны к заполнению*
				</p>
				@csrf
				<?php if (Auth::check()):?>
				<label>
					Ваше имя:
				</label><br>
				<input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" required> <br>
				<label>
					 Ваша фамилия:
				</label><br>
				<input type="text" name="secname" class="form-control" value="{{Auth::user()->secname}}" required><br>
				<label>
					Email:
				</label><br>
				<input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" required><br>
				<?php else:?>
				<label>
					Ваше имя:
				</label><br>
				<input type="text" name="name" class="form-control"> <br>
				<label>
					 Ваша фамилия:
				</label><br>
				<input type="text" name="secname" class="form-control"><br>
				<label>
					Email:
				</label><br>
				<input type="email" name="email" class="form-control"><br>
				<label>
					<?php endif?>
					Домашний адрес:
				</label><br>
				<input type="text" name="adress" class="form-control"><br>
				<label>
					Номер телефона:
				</label><br>
				<input type="text" name="phone" class="form-control"><br>
				<label>
					Тип доставки:
				</label><br>
				<select class="form-control" name="delivery">
		         <option value="courier" >Courier($10.00)</option>
		         <option value="Pickup" >Pickup from our shop ($0.00)</option>
		        </select>
				<label>
					Комментарий к заказу:
				</label><br>
				<textarea class="form-control" name="comment" id="zakComment"></textarea><br>
				<input type="submit" name="buyFinal" class="btn btn-success " value="Купить">
				</form>
				
		</div>
		<div class="col-lg-8 col-sm-12">
			<h3 class="text-center mt-4">
				Ваши товары
			</h3>
				<table class="table" id="table">
				
				
				<thead>
					<tr>
						  <th scope="col">Изображение</th>
					      <th scope="col">Название продукта</th>
					      <th scope="col">Изготовитель</th>
					      <th scope="col">Цена</th>
					      <th scope="col">Количество</th>
					      <th scope="col">Итого</th>
					      
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
	                        	{{ $details['quantity'] }}
	                    	</td>
						<td>
							${{$details['price'] * $details['quantity']}}
						</td>
						 
					</tr>

						@endforeach
						<caption class="text-right">
						<strong>
							Итого:
						</strong>
						${{$total}}
					</caption> 
					@endif
				</tbody>
				
			</table>
			
			
		</div>
	</div>
</div>
@endsection