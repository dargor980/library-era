@extends('plantilla')

@section('titulo', 'Nuevo Proveedor')

@section('contenido')

<div class="modal-dialog text-center">
    <div class="col-sm-12">
        <div class="modal-content my-2">
        <br>
        @if (session('mensaje'))
            <div class="container my-3">
                <div class="alert alert-success">
                    <span><i class="fas fa-check"></i></span>&nbsp;{{session('mensaje')}}
                </div>
            </div>           
        @endif
            <div>
                <h4 class="my-2 text-white">Nuevo Proveedor</h4>
            </div>
            <form method="POST" action="{{route('addProvider')}}"class="col-12" enctype="multipart/form-data">
                @csrf
            <br>
                @error('name')
                    <div class="badge badge-danger float-right"> *El Nombre es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='name' type="text" placeholder="Nombre del proveedor" class="form-control">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='company' type="text" placeholder="Empresa" class="form-control">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='email' type="email" placeholder="Email del proveedor" class="form-control">
                </div>

                @error('phone')
                    <div class="badge badge-danger float-right"> *El Teléfono es obligatorio </div>
                @enderror
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='phone' type="number" min="0" placeholder="Teléfono" class="form-control"> 
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                    </div>
                    <input name='address' type="text" placeholder="Direccion" class="form-control"> 
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                        
                    </div>
                    <textarea name='description' id=""  placeholder="Descripcion" class="form-control"></textarea>
                </div>
                <br>
                <button class="btn mb-3 text-white" type="submit" style="background: #bd0003;"><i class="fas fa-paper-plane text-white"></i> Enviar</button>
            </form>
        </div>
    </div> 
</div>
@endsection