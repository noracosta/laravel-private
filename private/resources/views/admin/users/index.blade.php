@extends("admin.theme.$theme.layout")
@section('titulo')
    Usuarios 
@endsection
@section('seccion-title')
Usuarios    
@endsection
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>                
    <li class="breadcrumb-item active">Usuarios</li>
    </ol>
@endsection    
@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section('content')

<div class="card card-primary card-outline">
    <div class="card-header">
        <div class="row">
            <a class="btn btn-app" href="{{ route('users.create') }}">
                <i class="fa fa-plus"></i> Agregar
            </a>         
        </div>
        <!--/.row -->    
    </div>
    <!-- /.card-header -->    
    <div class="card-body table-responsive">
        @include('flash::message')
        <div class="row">  
            <table id="users-table" class="table table-bordered table-hover dataTable display responsive no-wrap" width="100%">
                <thead>
                    <th class="all">Nombre</th>
                    <th class="not-tablet-p">Email</th>
                    <th class="not-tablet-p">Rol</th>
                    <th class="all" data-priority="1">Acciones</th>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--/.row -->    
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
@section('scripts')
    <!-- DataTables -->
    <script src="{{asset("assets/$theme/plugins/datatables/jquery.dataTables.js")}}"></script>
    <script src="{{asset("assets/$theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>
    <script src="{{asset("assets/$theme/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script>
        $(document).ready(function () {
            let users_table = $('#users-table').DataTable({
                scrollCollapse: true,              
                processing: true,
                serverSide: true,
                searching: true,
                select: true,
                orderable:true,
                info:true,
                fixedHeader: {
                    header: true,
                    headerOffset: $('#header').height()
                },
                oLanguage: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                ajax: {
                    url: '{!! route('users.index_data') !!}',
                    method: 'GET',
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'roles[, ].name', name: 'rol1'},                
                    {data: 'action', name: 'action', orderable: true, searchable: true, width: 100}
                ],
            });

            
        });
    </script>
@endsection
