@extends('plantilla')

@section('titulo', 'Categorías')

@section('contenido')
<div class="modal-dialog text-center">
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
                    <h4 class="my-2 text-white">Nueva Categoria</h4>
                </div>
            <form method="POST" action="{{route('addCategory')}}"class="col-12" enctype="multipart/form-data">
                    @csrf
                <br>
                    @error('name')
                        <div class="badge badge-danger float-right"> *El Nombre de la categoria es obligatoria </div>
                    @enderror
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                        </div>
                        
                        <input name='name' type="text" placeholder="Categoria" class="form-control">
                    </div>
                    <button class="btn btn-success mb-3 text-white" type="submit"><i class="fa fa-plus"></i> Añadir</button>
                </form>
            </div>
        </div> 
    </div>
    <div class="col-sm-12">
        <div class="modal-content my-2">
        <br>
        @if (session('mensaje2'))
            <div class="container my-3">
                <div class="alert alert-success">
                    {{session('mensaje2')}}
                </div>
            </div>           
        @endif
        @if (session('error'))
            <div class="container my-3">
                <div class="alert alert-success">
                    <span><i class="fa fa-exclamation-triangle text-danger"></i></span>&nbsp;{{session('error')}}
                </div>
            </div>           
        @endif
            <div>
                <h4 class="my-2 text-white">Eliminar Categoria</h4>
            </div>
            <form method="POST" action="{{route('deleteCategory')}}" class="col-12" enctype="multipart/form-data">
                @csrf
            <br>
            @error('category_id')
                <div class="badge badge-danger float-right">*Debe seleccionar un producto </div>
            @enderror
            <select name='category_id' class="custom-select">
                <option selected value="0">Seleccione una categoria:</option>
                @foreach($categories as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <br>
                <br>
                <button class="btn btn-danger mb-3 text-white" type="submit"><i class="fa fa-trash"></i> Eliminar</button>
            </form>
        </div>
    </div> 
</div>
@endsection