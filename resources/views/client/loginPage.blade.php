@extends('layouts.mainPage')
@section('content')
<div class="container text-center">
  <div class="row">
   <div class="col-lg-4 col-sm-12">
      <form class="form-signin">
      <img class="mb-4" src="/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
   </div>
    <div class="col-lg-4 col-sm-12 mt-2">
      <h2>
        Don`t register yet? <br></h2>
        <h4>Complete this simple process in few steps.</h4>
      
    </div>
     <div class="col-lg-4 col-sm-12">
      <form class="form-signin" action="{{route('register')}}">
        @csrf
      <img class="mb-4" src="/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Registration</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputName" class="sr-only">Your name</label>
      <input type="text" id="inputName" class="form-control" placeholder="Name" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <label for="inputPassword1" class="sr-only">Repeat password</label>
      <input type="password" id="inputPassword1" class="form-control" placeholder="Repeat your password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="reg">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
   </div>
  </div>
</div>

@endsection