@extends('plantilla')

@section('titulo', 'Proveedores')

@section('contenido')
<br><br><br><br><br><br>
<div class="container">
    <div class="modal-content my-2">
        <br>
        <div>
            <div class="text-right mr-5">
                <span><a href="{{route('editprov',$proveedor->id)}}" ><i class="fas fa-edit text-success btn btn-light"></a></i></span>
                <span><a href="{{route('deleteprov',$proveedor->id)}}" ><i class="fas fa-trash-alt text-danger btn btn-light"></a></i></span>
            </div>
            <h1 class="my-2 text-white text-center">{{$proveedor->nombre}}</h1>
        </div>
        <h3 class="text-white text-center col-md-6 mb-4">Datos del proveedor:</h3>
        <div class="row my-2 mb-3">
            <div class="col-md-2"></div>
                <div class="col-md-8 card card6">
                    <div class="row mt-4">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5 class="text-white">Empresa:</h5>
                        </div>
                        <div class="col-md-7">
                            <h5 class="card card1 text-center">&nbsp;{{$proveedor->empresa}}</h5>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5 class="text-white">Rut:</h5>
                        </div>
                        <div class="col-md-7">
                            <h5 class="card card1 text-center">&nbsp;{{$proveedor->rut}}</h5>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5 class="text-white">Fono: </h5>
                        </div>
                        <div class="col-md-7">
                            <h5 class="card card1 text-center">&nbsp;{{$proveedor->fono}}</h5>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5 class="text-white">Dirección: </h5>
                        </div>
                        <div class="col-md-7">
                            <h5 class="card card1 text-center">&nbsp;{{$proveedor->direccion}}</h5>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5 class="text-white">Descripción: </h5>
                        </div>
                        <div class="col-md-7">
                            <h5 class="card card1 text-justify">&nbsp;{{$proveedor->descripcion}}</h5>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            <div class="col-md-2"></div>
        </div>
        <div class="text-center mb-2">
            <a href="{{route('listaprov')}}"><button class="btn btn-success mb-3 text-white"><i class="fas fa-arrow-left text-white"></i> Volver al listado</button></a>
        </div>
    </div>
</div>
@endsection