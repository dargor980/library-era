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
            <th scope="col">Medio de pago</th>
            <th scope="col">Fecha</th>
            <th scope="col">Total</th>
            <th scope="col">Acciones</th>
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
                            targets: [1,2,3, 4],
                        }
                    ],

                    ajax: '{!! route('getSales') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {
                            data: 'payment_type_id',
                            name: 'payment_type_id',
                            render: function(data){
                                if(data == 1){
                                    return 'Efectivo'
                                }else{
                                    return 'Transferencia'
                                }
                            }

                        },
                        {data: 'created_at', name: 'created_at'},
                        {data: 'total', name: 'total'},
                        {
                        data: 'id',
                        render: function(data){
                            return `<span><a href="/sales/${data}/show"><i class="fas fa-eye text-success"></i>&nbsp;</a></span>
                            `
                        }
                    },

                    ],
                    responsive:{
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal( {
                                header: function ( row ) {
                                    var data = row.data();
                                    return 'Detalles para '+data[0]+' '+data[1];
                                }
                            } ),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll()
                        }
                    }
                })
            })



        </script>
@endsection
