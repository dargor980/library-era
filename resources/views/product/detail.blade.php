@extends('plantilla')

@section('titulo', 'Productos')

@section('contenido')
<br><br><br>
<div class="container">
    <div class="modal-content my-2">
        <br>
        <div>
            <div class="text-right mr-5">
                <span><a href="{{route('editProd',$product->id)}}" ><i class="fas fa-edit text-success btn btn-light"></a></i></span>
                <span><a href="{{route('deleteProd', $product->id)}}" ><i class="fas fa-trash-alt text-danger btn btn-light"></a></i></span>
            </div>
            <h1 class="my-2 text-white text-center">{{$product->name}}</h1>
        </div>
        @if (session('error'))
            <div class="container my-3">
                <div class="alert alert-success">
                    <span><i class="fas fa-exclamation-triangle text-danger"></i></span>&nbsp;{{session('error')}}
                </div>
            </div>
        @endif
        <h3 class="text-white text-center col-md-6 mb-4">Datos del producto:</h3>
        <div class="row mb-3">
            <div class="col-md-3"></div>
                <div class="col-md-6 card card6">
                    <div class="my-2">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-5 text-white"><h5>Precio:</h5></div>
                            <div class="card card1 col-md-3 pl-0 text-center"><h5>${{$product->price}}</h5></div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="my-2">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-5 text-white"><h5>Costo:</h5></div>
                            <div class="card card1 col-md-3 pl-0 text-center"><h5>${{$product->cost}}</h5></div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="my-2">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-5 text-white"><h5>Ganancia:</h5></div>
                            <div class="card card1 col-md-3 pl-0 text-center"><h5>${{$product->profit}}</h5></div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="my-2">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-5 text-white"><h5>Unidad de medida:</h5></div>
                            <div class="card card1 col-md-3 pl-0 text-center"><h5>@foreach($product->unitType as $unitType) {{$unitType->name}} @endforeach</h5></div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="my-2">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-5 text-white"><h5>Codigo de barras:</h5></div>
                            <div class="card card1 col-md-3 pl-0 text-center"><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->bar_code, 'EAN13') }}" alt="Código de barras" /></div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            <div class="col-md-3"></div>
        </div>
        <div class="text-center m-3">
            <a href="{{route('productList')}}"><button class="btn btn-success mb-3 text-white"><i class="fas fa-arrow-left text-white"></i> Volver</button></a>
        </div>
    </div>
</div>
@endsection
