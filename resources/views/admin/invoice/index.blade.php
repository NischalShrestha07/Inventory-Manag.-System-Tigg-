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

                                            <label for="product"> Product name:</label>
                                            <div class="input-group">
                                                <select class="form-select form-control selectpicker" id="product"
                                                    name="product">
                                                    <option value="">Product Name</option>
                                                    @foreach ($product as $category)
                                                    <option value="{{ $category->name}}">
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="quantity">Quantity:</label>
                                                    <input type="number" class="form-control" id="quantity"
                                                        name="quantity" placeholder="Enter Quantity"
                                                        oninput="calculateTotals()">
                                                </div>

                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="discount">Discount (%):</label>
                                                    <input type="number" class="form-control" id="discount"
                                                        name="discount" placeholder="Enter Discount"
                                                        oninput="calculateTotals()">
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">

                                                        <label for="rate">Rate:</label>
                                                        <input type="number" class="form-control" id="rate" name="rate"
                                                            placeholder="Enter Rate" oninput="calculateTotals()">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-select" id="tax" name="tax">
                                                            <option value="No Vat">No VAT</option>
                                                            <option value="5%">5%</option>
                                                            <option value="10%">10%</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5>Sub Total: <span id="subTotal">0</span></h5>
                                                                <h5>Non-Taxable Total: <span
                                                                        id="nonTaxableTotal">0</span></h5>
                                                                <h5>Taxable Total: <span id="taxableTotal">0</span>
                                                                </h5>
                                                                <h5>VAT: <span id="vat">0</span></h5>
                                                                <h4><strong>Grand Total: <span
                                                                            id="grandTotal">0</span></strong></h4>
                                                                <input type="hidden" id="grandTotalInput"
                                                                    name="grandTotal" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
                                        <th>PRODUCT</th>
                                        <th>REFERENCE NO</th>
                                        <th>INVOICE DATE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->invoiceNo }}</td>
                                        <td>{{ $item->product }}</td>
                                        <td>{{ $item->referenceNo }}</td>
                                        <td>{{$item->invoiceDate }}</td>
                                        <td>Rs {{ $item->amount }}</td>

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
                                                                            <option value="{{ $category->name }}"
                                                                                {{$category->name==$item->name
                                                                                ?'selected' : ''}}>
                                                                                {{ $category->name }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>



                                                                <label for="invoiceDate">Invoice Date:</label>
                                                                <input type="date" id="invoiceDate" name="invoiceDate"
                                                                    placeholder="Enter Invoice Date"
                                                                    value="{{$item->invoiceDate}}"
                                                                    class="form-control mb-2">


                                                                <label for="dueDate">Due Date:</label>
                                                                <input type="date" id="dueDate" name="dueDate"
                                                                    placeholder="Enter Due Date"
                                                                    value="{{$item->dueDate}}"
                                                                    class="form-control mb-2">

                                                                <label for="referenceNo"> Reference No:</label>
                                                                <input type="text" id="referenceNo" name="referenceNo"
                                                                    placeholder="referenceNo"
                                                                    value="{{$item->referenceNo}}"
                                                                    class="form-control mb-2">



                                                                <div class="col-md-6">
                                                                    <label for="quantity">Quantity:</label>
                                                                    <input type="number" class="form-control"
                                                                        id="quantity" name="quantity"
                                                                        placeholder="Enter Quantity"
                                                                        value="{{$item->quantity}}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="discount">Discount:</label>
                                                                    <input type="number" class="form-control"
                                                                        id="discount" name="discount"
                                                                        placeholder="Enter discount"
                                                                        value="{{$item->discount}}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="rate">rate:</label>
                                                                    <input type="number" class="form-control" id="rate"
                                                                        name="rate" placeholder="Enter rate"
                                                                        value="{{$item->rate}}">
                                                                </div>

                                                                <label for="invoiceNo">Invoice No:</label>
                                                                <input type="text" id="invoiceNo"
                                                                    value="{{$item->invoiceNo}}" name="invoiceNo"
                                                                    placeholder="Enter Invoice No"
                                                                    class="form-control mb-2">

                                                                <label for="product"> Product name:</label>
                                                                <div class="input-group">
                                                                    <select
                                                                        class="form-select form-control selectpicker"
                                                                        id="product" name="product">
                                                                        <option value="">Product Name</option>
                                                                        @foreach ($product as $category)
                                                                        <option value="{{ $category->name}}"
                                                                            {{$category->name==$item->product ?
                                                                            'selected' : ''}}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>




                                                                <label for="amount">Amount:</label>
                                                                <input type="text" id="amount" name="amount"
                                                                    placeholder="Enter Amount" value="{{$item->amount}}"
                                                                    class="form-control mb-2">

                                                                {{-- yo database ma xaina hai ta tei vara chalena --}}
                                                                {{-- <div class="m-3">
                                                                    <label for="status"> Status:</label>
                                                                    <select class="form-control" name="status"
                                                                        id="status">
                                                                        <option value="{{$item->status}}">
                                                                            {{$item->status}} </option>
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="In Check">In Check </option>
                                                                        <option value="In Progress">In Progress
                                                                        <option value="Complete">Complete </option>
                                                                    </select>
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="stage"> Stage:</label>
                                                                    <select class="form-control" name="stage"
                                                                        id="stage">
                                                                        <option value="{{$item->stage}}">
                                                                            {{$item->stage}} </option>
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="In Check">In Check </option>
                                                                        <option value="In Progress">In Progress
                                                                        <option value="Complete">Complete </option>
                                                                    </select>
                                                                </div> --}}





                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Now" />
                                                        </div>

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


<script>
    function calculateTotals() {
    // Retrieve values from input fields
    var quantity = parseFloat(document.getElementById('quantity').value) || 0;
    var rate = parseFloat(document.getElementById('rate').value) || 0;
    var discount = parseFloat(document.getElementById('discount').value) || 0;
    var taxRate = parseFloat(document.getElementById('tax').value) || 0;

    // Calculate subtotal
    var subtotal = quantity * rate;

    // Apply discount to subtotal
    var discountedAmount = subtotal - (subtotal * (discount / 100));

    // Calculate VAT
    var vatAmount = discountedAmount * (taxRate / 100);

    // Calculate grand total
    var grandTotal = discountedAmount + vatAmount;

    // Update the HTML with calculated values
    document.getElementById('subTotal').innerText = subtotal.toFixed(2);
    document.getElementById('nonTaxableTotal').innerText = discountedAmount.toFixed(2);
    document.getElementById('taxableTotal').innerText = discountedAmount.toFixed(2);
    document.getElementById('vat').innerText = vatAmount.toFixed(2);
    document.getElementById('grandTotal').innerText = grandTotal.toFixed(2);
    document.getElementById('grandTotalInput').value = grandTotal.toFixed(2);
}

// Attach event listeners to inputs to recalculate totals on change
document.addEventListener('DOMContentLoaded', function() {
    var inputs = document.querySelectorAll('#quantity, #rate, #discount, #tax');
    inputs.forEach(function(input) {
        input.addEventListener('input', calculateTotals);
    });

    // Initialize totals on page load
    calculateTotals();
});
</script>
@endsection