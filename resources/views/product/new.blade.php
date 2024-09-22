@extends('plantilla')

@section('titulo', 'Nuevo Producto')

@section('contenido')
<div class="modal-dialog text-center">
    <div class="col-sm-12">
        <div class="modal-content my-2">
        <br>
        @if (session('mensaje'))
            <div class="container my-3">
                <div class="alert alert-success">
                    <span><i class="fa fa-check"></i></span>&nbsp;{{session('mensaje')}}
                </div>
            </div>           
        @endif
            <div>
                <h4 class="my-2 text-white">Nuevo Producto</h4>
            </div>
            <form method="POST" action="{{route('addproduct')}}" class="col-12" enctype="multipart/form-data">
                @csrf
            <br>
                @error('name')
                    <div class="badge badge-danger float-right"> *El Nombre es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-edit"></i></span>
                    </div>
                     
                    <input name='name' type="text" placeholder="Nombre del producto" class="form-control">
                </div>

                @error('bar_code')
                    <div class="badge badge-danger float-right"> *El Código de barras es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-edit"></i></span>
                    </div>
                     
                    <input name='bar_code' type="text" placeholder="Código de barra" class="form-control">
                </div>

                @error('price')
                    <div class="badge badge-danger float-right"> *El Precio es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                    </div>
                    <input name='price' type="number" min="0" placeholder="Precio venta" class="form-control"> 
                </div>

                @error('cost')
                    <div class="badge badge-danger float-right"> *El Precio costo es obligatorio </div>
                @enderror

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                    </div>
                    <input name='cost' type="number" min="0" placeholder="Precio costo" class="form-control"> 
                </div>

                @error('category_id')
                    <div class="badge badge-danger float-right"> *Debe seleccionar una categoría </div>
                @enderror
                <select name='category_id' class="custom-select  mb-3" id="category">
                    <option selected value="0">Seleccione una categoria:</option>
                    @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>

                @error('quantity')
                    <div class="badge badge-danger float-right"> *El Stock es obligatorio </div>
                @enderror
                <div class="input-group form-group my-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-archive"></i></span>
                    </div>
                    
                    <input name='quantity' type="number" min="0" placeholder="Cantidad de Stock" class="form-control"> 
                </div>
                @error('unit_type_id')
                    <div class="badge badge-danger float-right"> *Debe seleccionar una unidad de medida</div>
                @enderror
                <select name='unit_type_id' class="custom-select  mb-4" id="unit-type">
                    <option selected value="0">Seleccione Unidad de Medida:</option>
                    @foreach($unitTypes as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>  
                    @endforeach                
                </select>

                <br>
                <button class="btn btn-success my-3 text-white" type="submit"><i class="fa fa-plus"></i> Agregar</button>
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