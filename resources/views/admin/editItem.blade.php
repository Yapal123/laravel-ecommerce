@extends('layouts.adminPage')
 @section('content')
  <form class="form-group" method="POST" action="{{route('updateItem')}}" enctype="multipart/form-data">
  	@csrf
    @if (count($errors) > 0)

<div class="alert alert-danger">

    <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>

    <ul>

      @foreach ($errors->all() as $error)

          <li>{{ $error }}</li>

      @endforeach

    </ul>

</div>

@endif



@if(session('success'))

<div class="alert alert-success">

  {{ session('success') }}

</div> 

@endif
    <input type="hidden" name="id" value="{{$prod->id}}">
    <input type="hidden" name="category_id" value="{{$prod->category_id}}">
        <label>
          Название продукта
        </label><br>
        <input type="text" name="name" class="form-control" value="{{$prod->name}}"><br>
        <label>
          Производитель
        </label><br>
        <input type="text" name="brand" class="form-control" value="{{$prod->brand}}"><br>
        <label>
        <label>
          Цена
        </label><br>
        <input type="text" name="price" class="form-control" value="{{$prod->price}}"><br>
        <label>
          Описание
        </label><br>
        <input type="text" name="description" class="form-control" value="{{$prod->descr}}"><br>
        <label>
          Количество
        </label><br>
        <input type="text" name="quantity" class="form-control" value="{{$prod->count}}"><br>
         <label>
          Главное изображение
        </label><br>
        <input type="file" name="mainImg" class="form-control"><br>
        @foreach($imgs as $img)
        <label>
          Доп. изображение
        </label><br>
        <input type="file" name="secondImg[]" class="form-control" multiple><br>
        @endforeach
        
        
        @foreach($props as $prop)
        <input type="hidden" name="propId[]" value="{{$prop->id}}">

        <label>
          Название характеристики
        </label><br>
        <input type="text" name="propTitle[]" class="form-control" value="{{$prop->title}}"><br>
        <label>
          Описание характеристики
        </label><br>
        <input type="text" name="propDesc[]" class="form-control" value="{{$prop->description}}"><br>
        <label>
          Еденица измерения характеристики
        </label><br>
        <input type="text" name="propUnit[]" class="form-control" value="{{$prop->unit}}"><br>
        @endforeach

        <input type="submit" name="postItem" class="btn btn-success mt-5" value="Сохранить">
      </form>

      @endsection