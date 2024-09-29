@extends('plantilla')
@section('titulo', 'Detalles de la venta')
@section('contenido')
<br><br>
<div class="pdf1" style="width: 21cm;">

    <div class="text-center my-4">
        <a href=""><h1>  Descargar PDF</h1></a>
    </div>
    <hr class="bg-light">
    <div class="row">
        <div class="col-md-3">
             <img src="/comidapdf.png" style="height: 100px;" alt="">
        </div>
        <div class="col-md-9">
            <div class="float-right">
                <div>N° Venta: {{$sale->id}}</div>
                <div>Fecha: {{$sale->created_at}}</div>
                @if($sale->payment_type == 1)<div>Método de pago:  Efectivo</div>@endif
                @if($sale->metodopago == 2)<div>Método de pago:  Transferencia</div>@endif
            </div>
             <h2 class="titulo textcolor">Librería (nombre pendiente)</h2>
             <div>Av. Garibaldi 1227, Batuco</div>
             <div>(insertar numero)</div>
             <div>libreria@gmail.com</div>
             <div> <i class="fab fa-whatsapp"></i> &nbsp; +569 5221 0010 </div>
        </div>
    </div>
    <hr class="bg-light">
    <h3 class="text-center">Detalle de la venta</h3>

    <div>
        <div class="card card5 table-responsive">
            <div class="container tablita">
                <table class="table mt-3 table-sm table-hover">
                    <thead>
                        <tr class="boton text-white">
                        <th scope="col">Cod.</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Medida</th>
                        <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                            <td class="text-center">{{$item->product[0]->id}}</td>
                            <td>{{$item->product[0]->name}}</td>
                            <td>{{$item->product[0]->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>@foreach($unitTypes as $unitType) @if($unitType->id==$item->product[0]->unit_type_id) {{$unitType->name}} @endif @endforeach</td>
                            <td>{{$item->subtotal}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2 mx-3" style="border-top: 2px solid #ffffff;">
                <h4 class="float-right mr-3">Total: $ {{$sale->total}}</h4>
            </div>
        </div>
    </div>

    <div class="piepagina pt-4">
        <h6 class="text-center mt-3">
        
        </h6>
        <hr class="bg-light">
        <div class="text-center">
            Libreria (insertar nombre) /  +569 3096 5828
        </div>
    </div>
</div>
<br><br>
@endsection
