<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Интернет-магазин</title>
  <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ URL::asset('/css/app.css') }}" rel="stylesheet">
</head>

<body>

  <!-- Start your project here-->

 <nav class="navbar navbar-expand-lg navbar-light  shadow " id="nav">
  <a class="navbar-brand" href="/">Магазин </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{route('about')}}">О нас <span class="sr-only">(current)</span></a>
      </li>
        
      
      
      @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Войти</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <p class="p-0 m-0 mr-4">{{ Auth::user()->name }} </p><span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <?php 
              if (Auth::user() &&  Auth::user()->isAdmin == 1): ?>
               <a class="dropdown-item" href="{{ route('add') }}">
                    Админ-панель
                </a>
              <?php endif ?>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    Выйти
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            
        </li>
    @endguest
      
    </ul>
    <form class="form-inline my-2 my-lg-0" method="GET" action="{{route('search')}}">
      <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search" name="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
    </form>
   
      
    <i class="fa fa-shopping-cart mr-3 ml-3"><a href="{{route('cart')}}">Корзина</a></i>
    <div class="badge badge-danger">
      <?php  if(!empty(session('cart'))):?>
    {{count(session('cart')) }}
    <?php else: ?>
    0
    <?php endif ?>
    </div>
  </div>
</nav>
<div class="cont">
  <div class="container-fluid h-100">
      <div class="row h-100 align-items-center">
    <div class="col-12 mx-auto">
      <h1 class="text-center display-1">
        Место для лого
      </h1>

    </div>
  </div>
  </div>
</div>
<?php 
  $part = explode('/', $_SERVER['REQUEST_URI']);
  if ($part['1'] == 'products'):
?>
@yield('sidebar')
<?php endif ?>

@yield('content')

<footer >

  <div class="row text-center">
    <div class="col-4 mt-3">
      <ul >
        <li >
          <a href="{{route('about')}}">О нас</a>
        </li>
        <li >
          <a href="/">Главная</a>
        </li>
        <li >
          <a href="">Доставка и оплата</a>
        </li>
      </ul>
    </div>
    <div class="col-4 mt-3">
      
    </div>
    <div class="col-4 mt-3">
      <ul >
        <li >
          <i class="fa fa-phone">+380506307629</i>
        </li>
        <li >
          <a href=""><img src="{{ URL::asset('/img/icons/vk-brands.svg')}}" class="vk">  Мы Вконтакте</a>
        </li>
        <li >
          <a href=""><img src="{{ URL::asset('/img/icons/facebook-f-brands.svg')}}" class="vk">  Мы Фейсбук</a>
        </li>
      </ul>
    </div>
    
    
  </div>
</footer>

  <!-- /Start your project here-->

  <!-- SCRIPTS -->

  <!-- JQuery -->
  <script type="text/javascript" src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ URL::asset('/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ URL::asset('/js/mdb.js') }}"></script>
  <script type="text/javascript">
 
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

        
 
    </script>
</body>

</html>
