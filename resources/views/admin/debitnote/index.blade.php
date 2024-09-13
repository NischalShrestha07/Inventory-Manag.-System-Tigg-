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
                            <h2 class="ml-2 menu-title">DEBIT NOTES</h2>
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
                                    data-target="#addNewDebitNote">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewDebitNote">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Debit Note</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewDebitNote') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <label for="name">Supplier Name:</label>
                                            <div class="input-group">
                                                <select class="form-select form-control selectpicker" id="name"
                                                    name="name">
                                                    <option value="" selected>Select Supplier </option>
                                                    @foreach ($supplier as $category)
                                                    <option value="{{ $category->name }}">
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="referenceNo">Reference No:</label>
                                                <input type="text" id="referenceNo" name="referenceNo"
                                                    placeholder="Enter Reference No:" class="form-control mb-2">
                                            </div>

                                            <label for="date">Date:</label>
                                            <input type="date" id="date" name="date" placeholder="Enter Date"
                                                class="form-control mb-2">


                                            <div class="container">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label for="product"
                                                            class="form-label"><strong>Products</strong></label>
                                                        <select class="form-select" id="product" name="product">
                                                            <option value="" selected>Select Product</option>
                                                            @foreach ($products as $category)
                                                            <option value="{{ $category->name }}">
                                                                {{ $category->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
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
                                                            {{-- <input type="text" class="form-control" id="amount"
                                                                placeholder="Rate" /> --}}
                                                            <label for="rate">Rate:</label>
                                                            <input type="number" class="form-control" id="rate"
                                                                name="rate" placeholder="Enter Rate"
                                                                oninput="calculateTotals()">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="form-select" id="tax" name="tax">
                                                                <option value="No Vat">No VAT</option>
                                                                <option value="5%">5%</option>
                                                                <option value="10%">10%</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="notes"
                                                                class="form-label"><strong>Notes</strong></label>
                                                            <textarea class="form-control" id="notes"
                                                                placeholder="This will appear on print"></textarea>
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
                                        <th>SUPPLIER NAME</th>
                                        <th>REFERENCE NO</th>
                                        <th>DATE</th>
                                        <th>PRODUCT</th>
                                        <th>RATE</th>
                                        <th>QUANTITY</th>
                                        <th>AMOUNT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($debitnote as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->referenceNo }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->product }}</td>
                                        <td>{{ $item->rate }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td> {{ $item->amount }}</td>
                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Debit Note</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateDebitNote') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="mb-3">
                                                                    <label for="name">Supplier Name:</label>
                                                                    <div class="input-group">
                                                                        <select
                                                                            class="form-select form-control selectpicker"
                                                                            id="name" name="name">
                                                                            <option value="">Supplier Name
                                                                            </option>
                                                                            @foreach ($supplier as $category)

                                                                            <option value="{{$category->name}}">
                                                                                {{$category->name}}</option>
                                                                            @endforeach


                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="referenceNo">Reference No:</label>
                                                                    <input type="text" id="referenceNo"
                                                                        name="referenceNo"
                                                                        placeholder="Enter Reference No:"
                                                                        value="{{$item->referenceNo}}"
                                                                        class="form-control mb-2">
                                                                </div>



                                                                <div class="m-3">
                                                                    <label for="date">Date:</label>
                                                                    <input type="date" id="date" name="date"
                                                                        placeholder="Enter Date" value="{{$item->date}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="discount">Discount:</label>
                                                                    <input type="discount" id="discount" name="discount"
                                                                        placeholder="Enter Discount"
                                                                        value="{{$item->discount}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="rate">Rate:</label>
                                                                    <input type="rate" id="rate" name="rate"
                                                                        placeholder="Enter rate" value="{{$item->rate}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="quantity">Quantity:</label>
                                                                    <input type="quantity" id="quantity" name="quantity"
                                                                        placeholder="Enter quantity"
                                                                        value="{{$item->quantity}}"
                                                                        class="form-control mb-2">
                                                                </div>


                                                                <div class="m-3">
                                                                    <label for="amount">Amount:</label>
                                                                    <input type="text" id="amount" name="amount"
                                                                        placeholder="Enter Amount"
                                                                        value="{{$item->amount}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="product">Product:</label>

                                                                    <select class="form-select" id="product"
                                                                        name="product">
                                                                        <option value="" selected>Select Product
                                                                        </option>
                                                                        @foreach ($products as $category)
                                                                        <option value="{{ $category->name }}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>




                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Now" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('debitnote.destroy', $item->id) }}" method="POST"
                                                style="display:inline-block;"> @csrf
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