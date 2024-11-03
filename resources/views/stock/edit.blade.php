@extends('plantilla')

@section('titulo', 'Editar Stock')

@section('contenido')
<br><br>
<div class="modal-dialog text-center">
    <div class="col-sm-12">
        <div class="modal-content my-2">
        <br>
        @if (session('mensaje'))
            <div class="container my-3">
                <div class="alert alert-success">
                    {{session('mensaje')}}
                </div>
            </div>           
        @endif
            <div>
                <h4 class="my-2 text-white">Editar Stock de Producto: <br> {{$stock->product[0]->name}}</h4>
            </div>
            <form method="POST" action="{{route('updatestock', $stock->id)}}"  class="col-12" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <br>

                @error('price')
                    <div class="badge badge-danger float-right"> *El Precio de venta es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-archive"></i></span>
                    </div>
                    <input name='quantity' type="number" min="0" placeholder="Cantidad" class="form-control" value="{{$stock->quantity}}"> 
                </div>

               

                
                <div class="row justify-content-center my-3">
                    <button class="btn btn-success mb-3 text-white" type="submit"><i class="fa fa-save"></i> Guardar</button>
                    <a class="btn btn-success mb-3 text-white mx-2" href="{{route('listStock')}}"> <i class="fa fa-reply text-white"></i> Lista</a>
                    <a class="btn btn-success mb-3 text-white" href="{{route('detailProd', $stock->product[0]->id)}}"> <i class="fa fa-reply text-white"></i> Producto</a>
                </div>
            </form>
        </div>
    </div> 
</div>
@endsection

@section('scripts')
<script>

    $(document).ready(function() {
        $('#unit-type').select2();
        $('#category').select2();
    });
</script>
@endsection