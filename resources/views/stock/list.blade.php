@extends('plantilla')

@section('titulo', 'Stock')

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

    </style>
<br>
<div class="container">
  <div class="card card5">
    <h1 class="text-center text-white my-4">Stock de Productos</h1>
    <div class="container table-responsive my-3">
      <table class="table table-sm table-hover" id="productos">
        <thead>
            <tr class="boton text-white">
              <th scope="col">Cod.</th>
              <th scope="col">Nombre</th>
              <th scope="col">Código de barras</th>
              <th scope="col">Precio</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Medida</th>
              <th scope="col">Categoria</th>
              <th scope="col">Opciones</th>
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
            processing: true,
            responsive: true,
            serverSide: true,
            columnDefs: [
                {
                    searchable: false,
                    targets: [4,5,6,7],
                }
            ],
            ajax: '{!! route('getStocks') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'bar_code', name: 'bar_code'},
                {data: 'price', name: 'price'},
                {data: 'stock[0].quantity', name: 'stock[0].quantity'},
                {data: 'unit_type[0].name', name: 'unit_type[0].name'},
                {data: 'category[0].name', name: 'category[0].name'},
                {
                    data: 'stock[0].id',
                    render: function(data) {
                        return `<span><a href="/stock/edit/${data}"><i class="fa fa-pencil text-success">&nbsp;</i></a></span>`
                    }
                }

            ],
            drawCallback: function( settings ) {
                $('a').addClass("pagination");
                $('a').removeClass('paginate_button');
                $('a').addClass('paginate_button');


            }
        })

    })
</script>
@endsection