@extends('plantilla')

@section('titulo', 'Añadir Stock')

@section('contenido')
<br>

<div class="container text-center">
    <div class="modal-content my-1">
        @if (session('mensaje'))
            <div class="container my-3">
                <div class="alert alert-success">
                    {{session('mensaje')}}
                </div>
            </div>           
        @endif
        <div>
            <h2 class="my-2 mt-3 text-white">Stock de Producto</h2>
        </div>
        
        
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form method="POST" action="{{route('updatestock')}}" class="col-12" enctype="multipart/form-data">
                    @csrf
                    @error('stock_id')
                        <div class="badge badge-danger float-right">*Debe seleccionar un producto </div>
                    @enderror
                    <select name='stock_id' class="custom-select my-2" id="stock">
                        <option selected value="0">Seleccione producto:</option>
                        @foreach($products as $item)
                        <option value="{{$item->stock_id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('quantiy')
                        <div class="badge badge-danger float-right">*El Stock es obligatorio </div>
                    @enderror
                    <div class="input-group form-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                        </div>
                       
                        <input name='quantity' type="number" min="0" placeholder="Cantidad de Stock" class="form-control"> 
                    </div>
                    <button class="btn btn-success text-white mt-2" type="submit"><i class="fas fa-cash-register"></i> Enviar</button>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <div class="modal-content my-2 table-responsive">
        <h2 class="text-white my-2">Stock Actual</h2>
        <div class="container mt-2">
            <table class="table table-sm table-hover">
                <thead>
                <tr class="boton text-white">
                    <th scope="col">Cod.</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Medida</th>
                    <th scope="col">Categoria</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $item)
                <tr>
                    <td class="pl-3">{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>@foreach($stocks as $quantity)@if($quantity->id==$item->stock_id){{$quantity->quantity}}@endif @endforeach</td>
                    <td>@foreach($unitTypes as $unitType) @if($unitType->id==$item->unit_type_id) {{$unitType->name}}@endif @endforeach</td>
                    <td>@foreach($categories as $category)@if($category->id==$item->category_id) {{$category->name}} @endif  @endforeach</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div>  
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

    $(document).ready(function() {
        $('#stock').select2();
    });
</script>
@endsection