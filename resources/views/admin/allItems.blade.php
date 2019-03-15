@extends('layouts.adminPage')
@section('content')
<form class="form-inline" method="GET" action="{{route('allItems')}}">
  <div class="form-group mb-2">
    
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" class="form-control" id="inputSearch" placeholder="Search" name="search">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Поиск</button>
</form>
     <table class="table">
     	<thead>
     		<tr>
     			<th>
     				ID
     			</th>
     			<th>
     				Изображение
     			</th>
     			<th>
     				Название 	
     			</th>
     			<th>
     				Цена
     			</th>
     			<th>
     				Действия
     			</th>
     		</tr>
     	</thead>
     	<tbody>
     		@foreach($prods as $prod)
     		<tr>
     			<td>
     				{{$prod->id}}
     			</td>
     			<td>
     				<img src="{{ URL::asset('/img/products')}}/{{$prod->category_id}}/{{$prod->name}}.jpg" class="allItemsImg">
     			</td>
     			<td>
     				<a href="{{route('single',$prod->id)}}">{{$prod->name}}</a>
     			</td>
     			<td>
     				{{$prod->price}}
     			</td>
     			<td>
     				

     					<form action="{{route('deleteItem',$prod->id)}}" method="post" class="deleteForm">
     						<input type="hidden" name="post_id" value="{{$prod->id}}">
     						@csrf
     						<input type="submit" name="delete" value="Удалить" onclick="if (confirm('Вы уверены?')) {
                                 return true;
                                } else return false;" class="but">
     					</form>
                         <a href="{{route('editItem',$prod->id)}}">Редактировать</a>
     				</form>

     			</td>
     		@endforeach
     		</tr>
     		
     	</tbody>
     </table>
     <nav aria-label="Page navigation example">
  <ul class="pagination">
    {{$prods->links()}}
  </ul>
</nav>

@endsection