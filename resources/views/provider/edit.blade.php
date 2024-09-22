@extends('plantilla')

@section('titulo', 'Editar Proveedor')

@section('contenido')

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
                <h4 class="my-2 text-white">Editar Proveedor</h4>
            </div>
            <form method="POST" action="{{route('updateProvider',$provider->id)}}" class="col-12" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <br>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    @error('name')
                         <div class="alert alert-danger"> El Nombre es obligatorio </div>
                     @enderror
                    <input name='name' type="text" placeholder="Nombre del proveedor" class="form-control" value="{{$provider->name}}">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='company' type="text" placeholder="Empresa" class="form-control" value="{{$provider->company}}">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='email' type="email" placeholder="Email del proveedor" class="form-control" value="{{$provider->email}}">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    @error('phone')
                         <div class="alert alert-danger"> El Teléfono es obligatorio </div>
                     @enderror
                    <input name='phone' type="number" min="0" placeholder="Teléfono" class="form-control" value="{{$provider->phone}}"> 
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='address' type="text" placeholder="Direccion" class="form-control" value="{{$provider->address}}"> 
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                        
                    </div>
                <textarea name='description' id="" placeholder="Descripcion" class="form-control" >{{$provider->description}}</textarea>
                </div>
                <br>
                <div class="row justify-content-center">
                    <button class="btn btn-success mb-3 text-white" type="submit"><i class="fas fa-save"></i> Guardar</button>
                    <a class="btn btn-success mb-3 text-white mx-2" href="{{route('providerlist')}}"> <i class="fas fa-reply text-white"></i> Lista</a>
                    <a class="btn btn-success mb-3 text-white" href="{{route('detailProvider',$provider->id)}}"> <i class="fas fa-reply text-white"></i> Proveedor</a>
                </div>
            </form>
        </div>
    </div> 
</div>
@endsection