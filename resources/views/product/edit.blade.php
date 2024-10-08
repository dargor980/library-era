@extends('plantilla')

@section('titulo', 'Editar')

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
                <h4 class="my-2 text-white">Editar Producto</h4>
            </div>
            <form method="POST" action="{{route('updateProd',$product->id)}}"  class="col-12" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <br>
                @error('name')
                    <div class="badge badge-danger float-right"> *El Nombre es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-edit"></i></span>
                    </div>
                     
                    <input name='name' type="text" placeholder="Nombre del producto" class="form-control" value="{{$product->name}}">
                </div>

                @error('price')
                    <div class="badge badge-danger float-right"> *El Precio de venta es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                    </div>
                    <input name='price' type="number" min="0" placeholder="Precio venta" class="form-control" value="{{$product->price}}"> 
                </div>

                @error('cost')
                    <div class="badge badge-danger float-right"> *El Precio costo es obligatorio </div>
                @enderror

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                    </div>
                    <input name='cost' type="number" min="0" placeholder="Precio costo" class="form-control" value="{{$product->cost}}"> 
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

                @error('unit_type_id')
                    <div class="badge badge-danger float-right"> *Debe seleccionar una medida </div>
                @enderror
                <div class="input-group form-group  my-3">
                    <select name='unit_type_id' class="custom-select " id="unit-type">
                        <option selected value="0">Seleccione Unidad de Medida:</option>
                        @foreach($unitTypes as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>  
                        @endforeach                
                    </select>
                </div>
                <br>
                <div class="row justify-content-center my-3">
                    <button class="btn btn-success mb-3 text-white" type="submit"><i class="fa fa-save"></i> Guardar</button>
                    <a class="btn btn-success mb-3 text-white mx-2" href="{{route('productList')}}"> <i class="fa fa-reply text-white"></i> Lista</a>
                    <a class="btn btn-success mb-3 text-white" href="{{route('detailProd',$product->id)}}"> <i class="fa fa-reply text-white"></i> Producto</a>
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