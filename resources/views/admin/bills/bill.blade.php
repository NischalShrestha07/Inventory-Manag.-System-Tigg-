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
                                <h2 class="ml-2 menu-title">Bills</h2>
                                <div>
                                    @if (@session('success'))
                                        <div class="alert alert-success bg-success h3 text-white rounded fw-bolder fs-1">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#addNewBill">Add New</button>
                                </div>
                            </div>


                            <div class="modal" id="addNewBill">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Bill</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ url('AddNewBill') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <label for="name">PRODUCT NAME:</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter Product Name:" class="form-control mb-2">


                                                <label for="finishgoods">Finished Goods:</label>
                                                <input type="text" id="finishgoods" name="finishgoods"
                                                    placeholder="Enter Finished Goods with UOM:" class="form-control mb-2">


                                                <label for="rawmaterials">Raw Materials:</label>
                                                <input type="text" id="rawmaterials" name="rawmaterials"
                                                    placeholder="No of Items Needed:" class="form-control mb-2">


                                                <label for="byproducts">By Products:</label>
                                                <input type="text" id="byproducts" name="byproducts"
                                                    placeholder="No of By Products" class="form-control mb-2">

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
                                            <th>PRODUCT NAME</th>
                                            <th>FINISHED GOODS</th>
                                            <th>RAW MATERIALS</th>
                                            <th>BY PRODUCTS</th>
                                            <th>ACTIONS</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($bills as $item)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->finishgoods }}</td>
                                                <td>{{ $item->rawmaterials }} items</td>
                                                <td>{{ $item->byproducts }} items</td>
                                                <td>
                                                    <a href="" class="btn" title="Edit">
                                                        <i class="fas fa-edit fa-lg"></i>
                                                    </a>

                                                    <form action="{{ route('bill.destroy', $item->id) }}" method="POST"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm w-10" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this item?')">
                                                            <i class="fas fa-lg fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                {{-- <td> --}}
                                                {{-- <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form> --}}
                                                {{-- </td> --}}
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
