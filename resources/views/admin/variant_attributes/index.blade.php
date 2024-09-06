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
                    <h1>Varient Attributes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Varient Attributes</li>
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
                            <h2 class="ml-2 menu-title">Varient Attributes</h2>
                            <div>
                                @if (@session('success'))
                                <div class="alert alert-success bg-success h3 text-white rounded">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div>
                                @if (@session('error'))
                                <div class="alert alert-danger bg-danger h3 text-white rounded">
                                    {{ session('error') }}
                                </div>
                                @endif
                            </div>
                            <div class="navbar d-flex justify-content-end">
                                <button type="button" data-toggle="modal" class="btn btn-success"
                                    data-target="#addNewVarAttributes">Add New</button>
                            </div>
                        </div>


                        <div class="modal" id="addNewVarAttributes">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Varient Attributes</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>


                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewVarAttribute') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <label for="name">Name:</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Attribute Name:"
                                                class="form-control mb-2">

                                            <div id="option-fields">
                                                <label for="option[]">Options:</label>
                                                <input type="text" name="options[]" placeholder="Enter Option:"
                                                    class="form-control mb-2">

                                            </div>
                                            <button type="button" id="add-option" class="btn btn-secondary">+
                                                NEW</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped"> --}}


                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>NAME</th>
                                                <th>OPTIONS </th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i = 0;
                                            @endphp
                                            @foreach ($varients as $item)
                                            @php
                                            $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @foreach($item->options as $option)
                                                    <span>{{ $option->option_name }}</span><br>
                                                    @endforeach
                                                </td>

                                                {{-- Update Model --}}
                                                <td class="font-weight-medium">
                                                    <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                        data-target="#updateModel{{ $i }}">
                                                        <i class="fas fa-edit fa-lg"></i>
                                                    </button>
                                                    <div class="modal" id="updateModel{{ $i }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Update Varient Attribute
                                                                    </h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ url('UpdateVarAttribute') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')


                                                                        <label for="name">Name:</label>
                                                                        <input type="text" id="name" name="name"
                                                                            value="{{ $item->name }}"
                                                                            placeholder="Enter Attribute Name:"
                                                                            class="form-control mb-2">


                                                                        <label for="option[]">Options:</label>
                                                                        @foreach($item->options as $index => $option)
                                                                        <input type="text" name="options[]"
                                                                            value="{{ $option->option_name }}"
                                                                            class="form-control mb-2">
                                                                        @endforeach


                                                                        <input type="hidden" name="id"
                                                                            value="{{ $item->id }}">
                                                                        <input type="submit" name="save"
                                                                            class="btn btn-success"
                                                                            value="Save Changes" />
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <form action="{{ route('varAttribute.destroy', $item->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm w-10" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this item?')">
                                                            <i class="fas fa-lg fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>



                                {{-- CHATgpt codes helps --}}
                                {{-- <tbody>
                                    @foreach($varients as $variant)
                                    <tr>
                                        <td>{{ $variant->name }}</td>
                                        <td>
                                            @foreach($variant->options as $option)
                                            <span>{{ $option->option_name }}</span><br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody> --}}
                                {{--
                            </table>
                        </div> --}}

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


            document.getElementById('add-option').addEventListener('click', function() {
                var optionField = `<div class="form-group">
                                       <label for="options[]">Option:</label>
                                       <input type="text" name="options[]" class="form-control" placeholder="Enter Option">
                                   </div>`;
                document.getElementById('option-fields').insertAdjacentHTML('beforeend', optionField);
            });

</script>
@endsection