@extends('admin.layout')
@section('customCss')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Variant Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Varient Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="menu-title navbar">
                                <h2 class="ml-2 menu-title">Variant Products</h2>
                                <div>
                                    @if (@session('success'))
                                        <div class="alert alert-success bg-success h3 text-white rounded">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#addNewUom">Add New</button>
                                </div>
                            </div>
                            <div class="modal" id="addNewUom">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New UOM</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>


                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ url('AddNewVarProduct') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <label for="code">Code/Sku:</label>
                                                <input type="text" id="code" name="code"
                                                    placeholder="Enter Code/Sku:" class="form-control mb-2">


                                                <label for="name">Product Name:</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter Product Name:" class="form-control mb-2">


                                                <label for="category">Category Name:</label>
                                                <input type="text" id="category" name="category"
                                                    placeholder="Enter Category Name:" class="form-control mb-2">


                                                <label for="tax">Tax:</label>
                                                <input type="text" id="tax" name="tax" placeholder="Tax"
                                                    class="form-control mb-2">


                                                <input type="submit" name="save" class="btn btn-success"
                                                    value="Save Now" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code/SKU</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>TAX</th>
                                            <th>Actions</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($varProducts as $item)
                                            @php
                                                $i = 1;
                                            @endphp
                                            <tr>

                                                <th>{{ $item->code }}</th>
                                                <th>{{ $item->name }}</th>
                                                <th>{{ $item->category }}</th>
                                                <th>{{ $item->tax }}</th>


                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
@section('customJs')
    {{-- Remove the search bar --}}
    {{-- <script src="plugins/datatables/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    {{-- <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> --}}
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    {{-- <script src="plugins/pdfmake/pdfmake.min.js"></script> --}}
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
