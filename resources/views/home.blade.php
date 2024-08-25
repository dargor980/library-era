
@extends('plantilla')

@section('titulo', 'Home')

@section('contenido')
<div class="my-3">
    <div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="my-3 text-center">Panel de Administración</h1>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Nueva Venta</h3>
                        <p>Crea una nueva venta de forma rápida y sencilla</p>

                        <a class="btn btn-success btn-lg">Crear nueva venta</a>
                    </div>

                </div>
    
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row my-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>Agregar stock</p>
                        <h3>Inventario</h3>
                        <p>Gestiona tu inventario de forma eficiente</p>

                        <a class="btn btn-success btn-lg">Agregar stock</a>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        
                        <p>Cerrar sesión</p>
                        <h3>Salir</h3>
                        <p>Crea una nueva venta de forma rápida y sencilla</p>

                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" 
                            class="btn btn-success btn-lg"
                        >Cerrar sesión</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
   


</div>
@endsection
