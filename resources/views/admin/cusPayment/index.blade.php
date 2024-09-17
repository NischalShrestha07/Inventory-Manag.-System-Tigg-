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
                            <h2 class="ml-2 menu-title">CUSTOMER PAYMENT</h2>
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
                                    data-target="#addNewCustomerPayment">Add New</button>

                            </div>
                        </div>


                        <div class="modal" id="addNewCustomerPayment">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header btn-primary">
                                        <h4 class="modal-title"><b>Add New Customer Payment</b></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewCustomerPayment') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf


                                            <label for="name">Customer Name:</label>
                                            <div class="input-group">
                                                <select class="form-select form-control selectpicker" id="name"
                                                    name="name">
                                                    <option value="" selected>Select Customer </option>
                                                    @foreach ($customer as $category)
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




                                                <label for="mode">Payment Mode:</label>
                                                <select class="form-control" name="mode" id="mode">
                                                    <option value="" selected>Select Payment Mode</option>
                                                    <option value="Online Transfer">Online Transfer</option>
                                                    <option value="Cash">Cash </option>
                                                    <option value="Cheque">Cheque
                                                    </option>
                                                </select>


                                                <label for="payreference">Payment Reference:</label>
                                                <input type="text" id="payreference" name="payreference"
                                                    placeholder="Enter Reference No" class="form-control mb-2">

                                                <label for="note">Note:</label>
                                                <input type="text" id="note" name="note" placeholder="Enter Note:"
                                                    class="form-control mb-2">

                                                <div class="d-grid">
                                                    <button type="submit" name="save" class="btn btn-success"
                                                        value="Save "><i class="fas fa-save"></i>
                                                        Save </button>

                                                </div>
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
                                        <th>RECEIVED FROM</th>
                                        <th>ENTRY NO</th>
                                        <th>REFERENCE </th>
                                        <th>DATE</th>
                                        <th>AMOUNT</th>
                                        <th>DEPOSITED TO</th>
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

                                            <!-- View Button -->
                                            <button type="button" class="btn" title="View" data-toggle="modal"
                                                data-target="#viewModel{{ $item->id }}">
                                                <i class="fas fa-eye fa-lg"></i>
                                            </button>
                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewModel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="viewModelLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="viewModelLabel{{ $item->id }}">
                                                                Customer Payment Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Enhanced Product Details Card -->
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Customer Payment
                                                                        Information</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Customer Name:</strong></h6>
                                                                            <p>{{ $item->name }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Account
                                                                                    :</strong></h6>
                                                                            <p>{{ $item->account }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Entry No:</strong>
                                                                            </h6>
                                                                            <p>{{ $item->entryno }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Date:</strong></h6>
                                                                            <p>{{ $item->date }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Pay Reference:</strong></h6>
                                                                            <p>{{ $item->payreference }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Amount:</strong></h6>
                                                                            <p>{{ $item->amount }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Payment Mode:</strong></h6>
                                                                            <p>{{ $item->mode }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Note:</strong></h6>
                                                                            <p>{{ $item->note }}</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header btn-primary">
                                                            <h4 class="modal-title"><b>Update Customer Payment</b></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateCustomerPayment') }}"
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
                                                                            <option value="">Customer Name
                                                                            </option>
                                                                            @foreach ($customer as $category)

                                                                            <option value="{{$category->name}}"
                                                                                {{$category->name==$item->name
                                                                                ? 'selected' : ''}}>
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

                                                                        @foreach ($accounts as $category)
                                                                        <option value="{{ $category->account }}"
                                                                            {{$category->account==$item->account ?
                                                                            'selected' : ''}}>
                                                                            {{ $category->account }}
                                                                        </option>
                                                                        @endforeach
                                                                        <!-- Accounts will be dynamically populated here -->
                                                                    </select>
                                                                    </select>
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="mode"> Payment Mode:</label>
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

                                                                <div class="d-grid">
                                                                    <button type="submit" name="save"
                                                                        class="btn btn-success" value="Save Changes"><i
                                                                            class="fas fa-save"></i>
                                                                        Save Changes </button>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('cusPayment.destroy', $item->id) }}" method="POST"
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