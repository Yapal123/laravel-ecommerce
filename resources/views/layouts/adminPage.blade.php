<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Админ панель</title>
  <!-- Font Awesome -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ URL::asset('/css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="wrapper">
  <nav id="sidebar">
    <div class="sidebar-header">
      <h3 class="text-center">
        Админ-панель
      </h3>
    </div>

    <ul class="list-group-flush">
      <li class="list-group-item">
        <a href="{{route('add')}}" >Добавить товар </a>
      </li class="list-group-item">
      <li class="list-group-item">
       <a href="{{route('allItems')}}">Все товары</a>
      </li class="list-group-item">
      <li class="list-group-item">
       <a href="{{route('allOrders')}}"> Все заказы </a>
      </li>
       <li class="list-group-item">
        <a href="/">Главная  </a>
      </li>
    </ul>
  </nav>

  <div id="content">
    <nav >
           <a href="" onclick="return false">
             <i class="fas fa-align-left ml-2" id="sidebarCollapse"> <span>Меню</span></i> 
           </a>
           <br>  
    </nav>

  </div>
   <div class="container">
  <div class="row mt-5">
    <div class="col-12">
    @yield('content')
    </div>
  </div>
</div>
</div>

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
  

</body>

</html>
