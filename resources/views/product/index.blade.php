@extends('plantilla')

@section('titulo', 'Productos')

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
      <h1 class="text-center text-white mt-4">Lista de Productos</h1>

    <div class="container table-responsive my-3">
      @if (session('mensaje'))
            <div class="container my-3">
                <div class="alert alert-success">
                    <span><i class="fas fa-check"></i></span>{{session('mensaje')}}
                </div>
            </div>
      @endif
      @if (session('error'))
        <div class="container my-3">
            <div class="alert alert-success">
                <span><i class="fas fa-exclamation-triangle text-danger"></i></span>&nbsp;{{session('error')}}
            </div>
        </div>
      @endif
      <table class="table table-sm table-hover" id="productos">
        <thead>
          <tr class="boton text-white">
            <th scope="col">Cod.</th>
            <th scope="col">Nombre</th>
            <th scope="col">Código de barras</th>
            <th scope="col">Precio</th>
            <th scope="col">Medida</th>
            <th scope="col">Categoria</th>
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
            $("#productos").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
                },
                pagingType: "full_numbers",

                serverSide: true,
                ajax: '{!! route('getProducts') !!}',
                columnDefs: [
                    {
                        searchable: false,
                        targets: [3,4,5],
                    }
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `<a href="/product/details/${row.id}">${row.name}</a>`;
                        },
                        name: 'name'
                    },
                    {data: 'bar_code', name: 'bar_code'},
                    {data: 'price', name: 'price'},
                    {data: 'unit_type[0].name', name: 'unit_tyype[0].name'},
                    {data: 'category[0].name', name: 'category[0].name'},
                    {
                        data: 'id',
                        render: function(data){
                            return `<span><a href="/product/details/edit/${data}"><i class="fa fa-pencil text-success">&nbsp;</i></a></span>
                                    <span><a href="/product/delete/${data}"><i class="fa fa-trash text-danger"></i></a></span>
                                     `
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
