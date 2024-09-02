@extends('admin.layout')
@section('customCss')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- problem --}}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Your existing content -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="menu-title navbar">
                                <h2 class="ml-2 menu-title">Goods</h2>
                                <div>
                                    @if (@session('success'))
                                        <div class="alert alert-success bg-success h3 text-white rounded fw-bolder fs-1">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#addNewProduct">Add New</button>
                                </div>
                            </div>


                            <div class="modal" id="addNewProduct">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Product</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ url('AddNewProduct') }}" method="POST"
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

                            <div class="card-body ">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>CODE/SKU</th>
                                            <th>NAME</th>
                                            <th>CATEGORY</th>
                                            <th>TAX</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($products as $item)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->tax }}% VAT</td>

                                                {{-- <a href="" class="btn" title="Edit">
                                                        <i class="fas fa-edit fa-lg"></i>
                                                    </a> --}}
                                                {{-- Update Model  --}}
                                                <td class="font-weight-medium">
                                                    <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                        data-target="#updateModel{{ $i }}">
                                                        <i class="fas fa-edit fa-lg"></i>
                                                    </button>
                                                    <div class="modal" id="updateModel{{ $i }}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Update Product</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ url('UpdateProduct') }}" method="POST"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <label for="code">Code/Sku:</label>
                                                                        <input type="text" id="code" name="code"
                                                                            value="{{ $item->code }}"
                                                                            placeholder="Enter Code/Sku:"
                                                                            class="form-control mb-2">


                                                                        <label for="name">Product Name:</label>
                                                                        <input type="text" id="name" name="name"
                                                                            value="{{ $item->name }}"
                                                                            placeholder="Enter Product Name:"
                                                                            class="form-control mb-2">


                                                                        <label for="category">Category Name:</label>
                                                                        <input type="text" id="category"
                                                                            name="category" value="{{ $item->category }}"
                                                                            placeholder="Enter Category Name:"
                                                                            class="form-control mb-2">


                                                                        <label for="tax">Tax:</label>
                                                                        <input type="text" id="tax"
                                                                            name="tax" value="{{ $item->tax }}"
                                                                            placeholder="Tax" class="form-control mb-2">




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




                                                    <form action="{{ route('product.destroy', $item->id) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section(' customJs')
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    @endsection
