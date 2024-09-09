@extends('admin.layout')

@section('customCss')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Your existing content -->

    <section class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="menu-title navbar">
                            <h2 class="ml-2 menu-title">INVOICE</h2>
                            <div>
                                @if (session('success'))
                                <div class="alert alert-success bg-success h3 text-white rounded fw-bolder fs-1">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div>
                                @if (session('error'))
                                <div class="alert alert-danger bg-danger h3 text-white rounded fw-bolder fs-1">
                                    {{ session('error') }}
                                </div>
                                @endif
                            </div>
                            <div class="navbar d-flex justify-content-end">
                                <button type="button" data-toggle="modal" class="btn btn-success mr-3"
                                    data-target="#addNewInvoice">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewInvoice">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Invoice</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewInvoice') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf


                                            <label for="name">Customer Name:</label>
                                            <div class="input-group">
                                                <select class="form-select form-control selectpicker" id="name"
                                                    name="name">
                                                    <option value="" selected>Customer Name</option>
                                                    @foreach ($products as $category)
                                                    <option value="{{ $category->name }}">
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <label for="invoiceNo"> Invoice No:</label>
                                            <input type="text" id="invoiceNo" name="invoiceNo" placeholder="Invoice No"
                                                class="form-control mb-2">

                                            <label for="referenceNo"> Reference No:</label>
                                            <input type="text" id="referenceNo" name="referenceNo"
                                                placeholder="Reference No" class="form-control mb-2">

                                            <label for="invoiceDate">Invoice Date:</label>
                                            <input type="date" id="invoiceDate" name="invoiceDate"
                                                placeholder="Enter Invoice Date" class="form-control mb-2">

                                            <label for="dueDate">Due Date:</label>
                                            <input type="date" id="dueDate" name="dueDate" placeholder="Enter Due Date"
                                                class="form-control mb-2">

                                            <label for="terms">Terms and Conditions:</label>
                                            <input type="text" id="terms" name="terms" placeholder="Conditions"
                                                class="form-control mb-2">

                                            {{-- <label for="product_name"> Product name:</label>
                                            <div class="input-group">
                                                <select class="form-select form-control selectpicker" id="product_name"
                                                    name="product_name">
                                                    <option value="">Product Name</option>
                                                    @foreach ($product as $category)
                                                    <option value="{{ $category->name}}">
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div> --}}


                                            <input type="submit" name="save" class="btn btn-success" value="Save Now" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>CUSTOMER NAME</th>
                                        <th>INVOICE NO</th>
                                        <th>REFERENCE NO</th>
                                        <th>INVOICE DATE</th>
                                        <th>DUE DATE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->invoiceNo }}</td>
                                        <td>{{ $item->referenceNo }}</td>
                                        <td>{{$item->invoiceDate }}</td>
                                        <td>{{ $item->dueDate }}</td>

                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Invoice</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateInvoice') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="mb-3">
                                                                    <label for="name">Customer Name:</label>
                                                                    <div class="input-group">
                                                                        <select
                                                                            class="form-select form-control selectpicker"
                                                                            id="name" name="name">
                                                                            <option value="" selected>Customer Name
                                                                            </option>
                                                                            @foreach ($products as $category)
                                                                            <option value="{{ $category->name }}">
                                                                                {{ $category->name }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <label for="code"> Quote No:</label>
                                                                <input type="text" id="code" name="code"
                                                                    placeholder="Code" value="{{$item->code}}"
                                                                    class="form-control mb-2">

                                                                <label for="expiry_date">Expiry Date:</label>
                                                                <input type="date" id="expiry_date" name="expiry_date"
                                                                    placeholder="Enter Expiry Date"
                                                                    value="{{$item->expiry_date}}"
                                                                    class="form-control mb-2">

                                                                <label for="date">Date:</label>
                                                                <input type="date" id="date" name="date"
                                                                    value="{{$item->date}}" placeholder="Enter Date"
                                                                    class="form-control mb-2">

                                                                <label for="currency">Currency:</label>
                                                                <input type="text" id="currency" name="currency"
                                                                    value="{{$item->currency}}"
                                                                    placeholder="Enter Currency"
                                                                    class="form-control mb-2">

                                                                <label for="credit_notes">Credit Notes:</label>
                                                                <input type="text" id="credit_notes"
                                                                    value="{{$item->credit_notes}}" name="credit_notes"
                                                                    placeholder="Enter credit_notes"
                                                                    class="form-control mb-2">

                                                                <label for="product_name"> Product name:</label>
                                                                <div class="input-group">
                                                                    <select
                                                                        class="form-select form-control selectpicker"
                                                                        id="product_name" name="product_name">
                                                                        <option value="">Product Name</option>
                                                                        @foreach ($product as $category)
                                                                        <option value="{{ $category->name}}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <label for="terms">Condition & Terms:</label>
                                                                <input type="text" id="terms" name="terms"
                                                                    value="{{$item->terms}}"
                                                                    placeholder="Enter Conditions & Terms"
                                                                    class="form-control mb-2">

                                                                <div class="m-3">
                                                                    <label for="status"> Status:</label>
                                                                    <select class="form-control" name="status"
                                                                        id="status">
                                                                        <option value="" selected>Select Status</option>
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="In Check">In Check </option>
                                                                        <option value="In Progress">In Progress
                                                                        <option value="Complete">Complete </option>
                                                                        </option>
                                                                    </select>
                                                                </div>





                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Now" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('quotation.destroy', $item->id) }}" method="POST"
                                                style="display:inline-block;">
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
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('customJs')
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

@endsection