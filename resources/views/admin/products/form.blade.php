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
                                <div class="navbar d-flex justify-content-end">
                                    <a href="{{ route('products.create') }}" class="btn btn-success">Add New</a>
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
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->sku }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category }}</td>
                                                <td>{{ $product->tax }}% VAT</td>
                                                <td>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
