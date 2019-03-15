@extends('layouts.adminPage')
 @section('content')
 @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
  <form class="form-group" method="POST" action="{{route('store')}}" enctype="multipart/form-data" id="addForm">
  	@csrf
        <label>
          Название товара
        </label><br>
        <input type="text" name="name" class="form-control"><br>
        <label>
          Брэнд товара
        </label><br>
        <input type="text" name="brand" class="form-control"><br>
        <label>
          Категория
        </label><br>
        <select class="form-control" name="category" >
          @foreach($cats as $cat)
         <option value="{{$cat->id}}" >{{$cat->title}}</option>
          @endforeach
        </select>
        <label>
          Цена
        </label><br>
        <input type="text" name="price" class="form-control"><br>
        <label>
          Главное изображение
        </label><br>
        <input type="file" name="mainImg" class="form-control"><br>
        <div class="secImg">
        <label>
          Дополнительное изображение
        </label><br>
        <input type="file" name="secondImg[]" class="form-control"><br>
        </div>
        <div class="imgAppend"></div>
        <a href="" id="loadImg">Добавить еще 1 доп. изображение</a><br><br>

        <label>
          Описание
        </label><br>
        <input type="text" name="description" class="form-control"><br>
        <label>
          Количество на складе
        </label><br>
        <input type="number" name="quantity" class="form-control"><br>
        <label>
          Название характеристики
        </label><br>
        <input type="text" name="propTitle[]" class="form-control"><br>
        <label>
          Описание характеристики
        </label><br>
        <input type="text" name="propDesc[]" class="form-control"><br>
        <label>
          Еденица измерения характеристики
        </label><br>
        <input type="text" name="propUnit[]" class="form-control"><br>
        <div class="propAppend"></div>
       <a href="" id="link">Добавать еще 1 группу характеристики</a>
        <input type="submit" name="postItem" class="btn btn-success mt-5" value="Добавить">
      </form>
      @endsection