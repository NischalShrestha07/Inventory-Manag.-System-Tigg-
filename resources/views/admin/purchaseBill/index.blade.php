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
                            <h2 class="ml-2 menu-title">PURCHASE BILL</h2>
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
                                    data-target="#addNewPurchaseBill">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewPurchaseBill">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header btn-primary">
                                        <h4 class="modal-title"><b>Add New Purchase Bill</b></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewPurchaseBill') }}" method="POST"
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

                                            <label for="billDate">Bill Date:</label>
                                            <input type="date" id="billDate" name="billDate"
                                                placeholder="Enter Bill Date" class="form-control mb-2">


                                            <label for="dueDate">Due Date:</label>
                                            <input type="date" id="dueDate" name="dueDate" placeholder="Enter Due Date"
                                                class="form-control mb-2">

                                            <label for="invoReferenceNo"> Invoice Reference No:</label>
                                            <input type="invoReferenceNo" id="invoReferenceNo" name="invoReferenceNo"
                                                placeholder="Enter Invoice Reference No" class="form-control mb-2">

                                            <label for="billNo">Bill No:</label>
                                            <input type="billNo" id="billNo" name="billNo" placeholder="Enter Bill No"
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
                                                            <label for="rate">Rate:</label>
                                                            <input type="number" class="form-control" id="rate"
                                                                name="rate" placeholder="Enter Rate"
                                                                oninput="calculateTotals()">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="tax">Tax:</label>
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
                                            </div>



                                            <div class="d-grid">
                                                <button type="submit" name="save" class="btn btn-success"
                                                    value="Save Changes"><i class="fas fa-save"></i>
                                                    Save </button>

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
                                        <th>SUPPLIER NAME</th>
                                        <th>REFERENCE NO</th>
                                        <th>BILL DATE</th>
                                        <th>BILL NO</th>
                                        <th>DUE DATE</th>
                                        <th>PRODUCT</th>
                                        <th>INVOICE REFERENCE NO</th>
                                        <th>AMOUNT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseBill as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->referenceNo }}</td>
                                        <td>{{ $item->billDate }}</td>
                                        <td>{{ $item->billNo }}</td>
                                        <td>{{ $item->dueDate }}</td>
                                        <td>{{ $item->product }}</td>
                                        <td> {{ $item->invoReferenceNo }}</td>
                                        <td>Rs {{ $item->amount }}</td>
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
                                                                Purchase Bill Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Enhanced Product Details Card -->
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Purchase Bill
                                                                        Information
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Name:</strong></h6>
                                                                            <p>{{ $item->name }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Reference No:</strong></h6>
                                                                            <p>{{ $item->referenceNo}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Bill Date:</strong></h6>
                                                                            <p>{{ $item->billDate }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Bill No:</strong></h6>
                                                                            <p>{{ $item->billNo}}</p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Due Date:</strong></h6>
                                                                            <p>{{ $item->dueDate}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Invoice Reference No:</strong>
                                                                            </h6>
                                                                            <p>{{ $item->invoReferenceNo }}</p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Product Name:</strong></h6>
                                                                            <p>{{ $item->product}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Discount:</strong></h6>
                                                                            <p>{{ $item->discount}}</p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Quantity:</strong></h6>
                                                                            <p>{{ $item->quantity}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Rate:</strong></h6>
                                                                            <p>{{ $item->rate }}</p>
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
                                                            <h4 class="modal-title"><b>Update Purchase Bill</b></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdatePurchaseBill') }}" method="POST"
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

                                                                            <option value="{{$category->name}}"
                                                                                {{$category->name==$item->name ?
                                                                                'selected' : ''}}>
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
                                                                <div class="mb-3">
                                                                    <label for="quantity">Quantity:</label>
                                                                    <input type="text" id="quantity" name="quantity"
                                                                        placeholder="Enter Quantity:"
                                                                        value="{{$item->quantity}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="rate">Rate:</label>
                                                                    <input type="text" id="rate" name="rate"
                                                                        placeholder="Enter rate:"
                                                                        value="{{$item->rate}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="discount">Discount:</label>
                                                                    <input type="text" id="discount" name="discount"
                                                                        placeholder="Enter discount:"
                                                                        value="{{$item->discount}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="billDate">Bill Date:</label>
                                                                    <input type="date" id="billDate" name="billDate"
                                                                        placeholder="Enter Bill Date"
                                                                        value="{{$item->billDate}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="dueDate">Due Date:</label>
                                                                    <input type="date" id="dueDate" name="dueDate"
                                                                        placeholder="Enter Due Date"
                                                                        value="{{$item->dueDate}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="invoReferenceNo"> Invoice Reference
                                                                        No:</label>
                                                                    <input type="text" id="invoReferenceNo"
                                                                        name="invoReferenceNo"
                                                                        placeholder="Enter Invoice Reference No:"
                                                                        value="{{$item->invoReferenceNo}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="billNo"> Bill
                                                                        No:</label>
                                                                    <input type="text" id="billNo" name="billNo"
                                                                        placeholder="Enter Bill No:"
                                                                        value="{{$item->billNo}}"
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
                                                                        <option value="{{ $category->name }}"
                                                                            {{$category->name == $item->product ?
                                                                            'selected' : ''}}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
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

                                            <form action="{{ route('purchaseBill.destroy', $item->id) }}" method="POST"
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