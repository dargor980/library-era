@extends('layouts.app')

@section('titulo', 'Libreria "El Oso"')

@section('content')



<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Inicio de Sesión</h2>
		    <form class="login-form" method="POST" action="{{route('login')}}">
                @csrf
  <div class="form-group">
    <label for="email" class="text-uppercase">Email</label>
    <input id=email" type="email" name="email"  value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control" placeholder="">
    
  </div>
  <div class="form-group">
    <label for="password" class="text-uppercase">Contraseña</label>
    <input type="password" class="form-control" id="password" name="password"  required autocomplete="current-password">
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="remember" id="remember" class="form-check-input"  {{ old('remember') ? 'checked' : '' }}>
      <small>Recordarme</small>
    </label>
    <button type="submit" class="btn btn-login float-right">Iniciar Sesión</button>
  </div>
  
</form>
<div class="copy-text">Created with <i class="fa fa-heart"></i> by dargor980</div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Administra tus ventas</h2>
            <p>Lleva el control exacto de tus ventas, productos y proveedores</p>
        </div>	
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Maximiza tus Ganancias</h2>
            <p>Ten acceso a un dashboard de estadísticas que te ayudarán a maxmizar tus ganancias y minimizar costos. </p>
        </div>	
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>¿Necesitas ayuda?</h2>
            <p>Contáctate a través del siguiente email: <a href="mailto:german.contrerasa@utem.cl">german.contrerasa@utem.cl</a></a></p>
        </div>	
    </div>
  </div>
            </div>	   
		    
		</div>
	</div>
</div>
</section>

@endsection