@extends('plantilla')

@section('titulo', 'Ventas')

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
    <h1 class="text-center text-white my-4">Listado de Ventas</h1>
    <div class="container table-responsive my-3">
      @if (session('mensaje'))
        <div class="container my-3">
            <div class="alert alert-success">
                {{session('mensaje')}}
            </div>
        </div>
      @endif
    <table class="table table-sm table-hover" id="pedidos">
        <thead>
          <tr class="boton text-white">
            <th scope="col">N°</th>
            <th scope="col">Estado</th>
            <th scope="col">Medio de pago</th>
            <th scope="col">Cliente</th>
            <th scope="col">Fecha</th>
            <th scope="col">Total</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>

    </div>
</div>
@endsection

@section('scripts')
        <script>

            $(document).ready(function(){
                $("#pedidos").DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
                    },
                    pagingType: "full_numbers",
                    processing: true,
                    serverSide: true,
                    columnDefs: [
                        {
                            searchable: false,
                            targets: [1,2,3,6],
                        }
                    ],

                    ajax: '{!! route('getPedidos') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {
                            data: 'estado',
                            render: function(data){
                                if(data == '0'){
                                    return 'Pendiente'
                                }else{
                                    return 'Pagado'
                                }
                            }

                        },
                        {
                            data: 'metodopago',
                            render: function(data){
                                if(data == '1'){
                                    return 'Efectivo';
                                }
                                if(data == '2'){
                                    return 'Transferencia';
                                }
                                if(data == '3'){
                                    return 'Tarjeta';
                                }
                            }
                        },
                        {data: 'link', name: 'link'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'total', name: 'total'},
                        {
                            data: 'id',
                            render: function(data){
                                return `<span><a href="/pedido/lista/delete/${data}"><i class="fas fa-trash-alt text-danger"></i></a></span>`
                            }

                        }

                    ],
                    responsive:{
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal( {
                                header: function ( row ) {
                                    var data = row.data();
                                    return 'Details for '+data[0]+' '+data[1];
                                }
                            } ),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll()
                        }
                    }
                })
            })



        </script>
@endsection
