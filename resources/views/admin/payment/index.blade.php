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
                            <h2 class="ml-2 menu-title">SUPPLIER PAYMENT</h2>
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
                                    data-target="#addNewSupplierPayment">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewSupplierPayment">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Supplier Payment</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewSupplierPayment') }}" method="POST"
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
                                            <div class="container">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label for="account"
                                                            class="form-label"><strong>Accounts</strong></label>
                                                        <select class="form-select" id="account" name="account">
                                                            <option value="" selected>Select Account</option>
                                                            @foreach ($accounts as $category)
                                                            <option value="{{ $category->account }}">
                                                                {{ $category->account }}
                                                            </option>
                                                            @endforeach
                                                            <!-- Accounts will be dynamically populated here -->
                                                        </select>
                                                    </div>
                                                </div>

                                                <label for="date">Date:</label>
                                                <input type="date" id="date" name="date" placeholder="Enter Date"
                                                    class="form-control mb-2">

                                                <label for="entryno">Entry No:</label>
                                                <input type="text" id="entryno" name="entryno"
                                                    placeholder="Enter Entry No:" class="form-control mb-2">

                                                <label for="amount">Amount:</label>
                                                <input type="text" id="amount" name="amount" placeholder="Enter Amount"
                                                    class="form-control mb-2">


                                                {{-- <label for="hello">Amount</label>
                                                <input type="text" name="hello"> --}}



                                                <div class="m-3">
                                                    <label for="mode"> Payment Mode:</label>
                                                    <select class="form-control" name="mode" id="mode">
                                                        <option value="" selected>Select Payment Mode</option>
                                                        <option value="Online Transfer">Online Transfer</option>
                                                        <option value="Cash">Cash </option>
                                                        <option value="Cheque">Cheque
                                                        </option>
                                                    </select>
                                                </div>
                                                <label for="payreference">Payment Reference:</label>
                                                <input type="text" id="payreference" name="payreference"
                                                    placeholder="Enter Reference No" class="form-control mb-2">


                                                <label for="note">Note:</label>
                                                <input type="text" id="note" name="note" placeholder="Enter Note:"
                                                    class="form-control mb-2">

                                                <input type="submit" name="save" class="btn btn-success"
                                                    value="Save Now" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>PAID TO</th>
                                        <th>ENTRY NO</th>
                                        <th>REFERENCE </th>
                                        <th>DATE</th>
                                        <th>AMOUNT</th>
                                        <th>PAID FROM</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($payment as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->entryno }}</td>
                                        <td>{{ $item->payreference }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>Rs {{ $item->amount }}</td>
                                        <td>{{ $item->account }}</td>


                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Supplier Payment</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateSupplierPayment') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="mb-3">
                                                                    <label for="name">Paid To:</label>
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
                                                                <div class="m-3">

                                                                    <label for="entryno"> Entry No:</label>
                                                                    <input type="text" id="entryno" name="entryno"
                                                                        placeholder="Entry No"
                                                                        value="{{$item->entryno}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="payreference">Payment Reference:</label>
                                                                    <input type="text" id="payreference"
                                                                        value="{{$item->payreference}}"
                                                                        name="payreference"
                                                                        placeholder="Enter Payment Reference No"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="date">Date:</label>
                                                                    <input type="date" id="date" name="date"
                                                                        placeholder="Enter Date" value="{{$item->date}}"
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
                                                                    <label for="account">Paid From:</label>
                                                                    <select class="form-control" name="account"
                                                                        id="account">
                                                                        <option value="{{$item->account}}">
                                                                            {{$item->account}}</option>
                                                                        <option value="" selected>Select Account
                                                                        </option>
                                                                        @foreach ($accounts as $category)
                                                                        <option value="{{ $category->account }}">
                                                                            {{ $category->account }}
                                                                        </option>
                                                                        @endforeach
                                                                        <!-- Accounts will be dynamically populated here -->
                                                                    </select>
                                                                    </select>


                                                                </div>



                                                                <div class="m-3">
                                                                    <label for="mode"> Payment Mofr:</label>
                                                                    <select class="form-control" name="mode" id="mode">
                                                                        <option value="{{$item->mode}}">
                                                                            {{$item->mode}} </option>
                                                                        <option value="Online Transfer">Online Transfer
                                                                        </option>
                                                                        <option value="Cash">Cash </option>
                                                                        <option value="Cheque">Cheque
                                                                    </select>
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="note">Note:</label>
                                                                    <input type="text" id="note" name="note"
                                                                        placeholder="Enter Note:"
                                                                        value="{{$item->note}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Now" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('payment.destroy', $item->id) }}" method="POST"
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