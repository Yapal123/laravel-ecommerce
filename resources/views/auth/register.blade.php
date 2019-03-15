@extends('layouts.mainPage')
@section('content')
<div class="container text-center">
  <div class="row">
   <div class="col-lg-4 col-sm-12">
      <form class="form-signin" method="POST" action="{{route('login')}}">
        @csrf
      <img class="mb-4" src="/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Войдите</h1>
      <label for="inputEmail" class="">Email</label>
      <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" required autofocus>
      @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
      <label for="inputPassword" class="">Пароль</label>
      <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Введите свой пароль" required>
      @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Запомнить меня
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Войти</button>

    </form>
   </div>
    <div class="col-lg-4 col-sm-12 mt-2">
      <h2>
        Еще не зарегистрированны?  <br></h2>
        <h4>Пройдите простую регистрацию в пару действий!</h4>
      
    </div>
     <div class="col-lg-4 col-sm-12">
      <form class="form-signin" method="POST" action="{{route('register')}}" >
        @csrf
      <img class="mb-4" src="/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
      <label for="inputEmail" class="">Email </label>
      <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required autofocus >
      @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
      <label for="inputName" class="">Ваше имя</label>
      <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Введите ваше имя" required autofocus >
      @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
       <label for="inputName" class="">Ваша фамилия</label>
      <input type="text" name="secname" id="secname" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Введите вашу фамилию" required  >
      @if ($errors->has('secname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif                         
      <label for="inputPassword" class="">Пароль</label>
      <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Придумайте пароль" required >
      
      <label for="inputPassword1" class="">Повторите пароль</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Введите ваш пароль повторно" required >
      @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="reg">Зарегистрироваться</button>
      
    </form>
   </div>
  </div>
</div>

@endsection