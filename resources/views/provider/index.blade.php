@extends('plantilla')

@section('titulo', 'Proveedores')

@section('contenido')
    <style>
        input{
            background-color: white !important;

        }

        label{
            color: white;
        }

        select{
            background-color: white !important;
        }

        .dataTables_info{
            color: white !important;
        }
    </style>
<br>
<div class="container">
  <div class="card card5">
      <h1 class="text-center text-white my-4">Lista de Proveedores</h1>
      <div class="container table-responsive my-3">
        @if (session('mensaje'))
          <div class="container my-3">
              <div class="alert alert-success">
                  <span><i class="fas fa-check"></i></span>{{session('mensaje')}}
              </div>
          </div>
      @endif
      <table class="table table-sm table-hover" id="proveedores">
          <thead>
            <tr class="boton text-white">
              <th scope="col">Nombre</th>
              <th scope="col">Empresa</th>
              <th scope="col">Email</th>
              <th scope="col">Dirección</th>
              <th scope="col">Teléfono</th>
              <th scope="col">Opción</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
  </div>
</div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function(){
            $("#proveedores").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
                },
                pagingType: "full_numbers",

                serverSide: true,
                ajax: '{!! route('getProviders') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'company', name: 'company'},
                    {data: 'email', name: 'email'},
                    {data: 'address', name: 'address' },
                    {data: 'phone', name: 'phone' },
                    {
                        data: 'id',
                        render: function(data){
                            return `<span><a href="/providers/edit/${data}"><i class="fas fa-edit text-success"></i>&nbsp;</a></span>
                                <span><a href="/providers/delete/${data}"><i class="fas fa-trash-alt text-danger"></i></a></span>
                            `
                        }
                    },

                ],
            })
        })



    </script>
@endsection
