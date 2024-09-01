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
                                        <div class="alert alert-success bg-success h1 text-white rounded fw-bolder fs-1">
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


                                                <label for="product">Product Name:</label>
                                                <input type="text" id="product" name="product"
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
                                        @foreach ($products as $product)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category }}</td>
                                                <td>{{ $product->tax }}% VAT</td>
                                                <td>
                                                    {{-- <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form> --}}
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
