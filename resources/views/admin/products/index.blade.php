@extends('admin.layout')
@section('customCss')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                <h2 class="ml-2 menu-title">Goods</h2>
                                <div class=" navbar d-flex justify-content-end">
                                    <a href="" class="btn btn-success ">Add New</a>
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
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>67667</td>
                                            <td>Mackbookk</td>
                                            <td>book</td>
                                            <td>13% VAT </td>
                                            <td class="d-flex gap-3">
                                                <a href="">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>

                                        </tr>



                                    </tbody>
                                    <tfoot>

                                    </tfoot>
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
