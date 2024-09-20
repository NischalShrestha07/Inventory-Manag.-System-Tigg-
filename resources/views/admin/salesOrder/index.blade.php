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
                            <h2 class="ml-2 menu-title">SALES ORDER</h2>
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
                                    data-target="#addNewSalesOrder">Add New</button>
                            </div>
                        </div>

                        <div class="p-4">
                            <form method="GET" action="{{ route('salesOrder.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Customer Name:</label>
                                        <select class="form-select" id="name" name="name">
                                            <option value="">Select Option</option>
                                            @foreach ($hello as $category)
                                            <option value="{{ $category->name }}" {{ request('name')==$category->id ?
                                                'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="submit" class="btn btn-dark">Filter</button>
                                    </div>


                                </div>
                            </form>
                        </div>

                        <div class="modal" id="addNewSalesOrder">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header btn-primary">
                                        <h4 class="modal-title"><b>Add New Sales Order</b></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewSalesOrder') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <label for="name">Customer Name:</label>
                                            <select id="name" name="name" class="form-control mb-2">
                                                <option value="" selected>Select Option</option>
                                                @foreach($hello as $unit)
                                                <option value="{{ $unit->name }}">
                                                    {{ $unit->name }}
                                                </option>
                                                @endforeach
                                            </select>

                                            <label for="orderno">Order No:</label>
                                            <input type="text" id="orderno" name="orderno" placeholder="Order No:"
                                                class="form-control mb-2">

                                            <label for="referenceno">Reference No:</label>
                                            <input type="text" id="referenceno" name="referenceno"
                                                placeholder="Enter Reference No:" class="form-control mb-2">

                                            <label for="date">Date:</label>
                                            <input type="date" id="date" name="date" placeholder="Enter Date:"
                                                class="form-control mb-2">

                                            <label for="deliverydate">Delivery Date:</label>
                                            <input type="date" id="deliverydate" name="deliverydate"
                                                placeholder="Enter Date:" class="form-control mb-2">

                                            <div class="row mb-3">
                                                <div class="col-md-12">
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
                                                        <label for="vat" class="form-label">VAT:</label>
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

                                            <label for="stage"> Stage:</label>
                                            <select class="form-control" name="stage" id="stage">
                                                <option value="" selected>Select Stage</option>
                                                <option value="Pending">Pending
                                                </option>
                                                <option value="Cancelled">Cancelled
                                                </option>
                                                <option value="On Check">On Check
                                                </option>
                                                <option value="Completed">Completed</option>
                                            </select>



                                            <div class="d-grid mt-3">
                                                <button type="submit" name="save" class="btn btn-success"
                                                    value="Save "><i class="fas fa-save"></i>
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
                                        <th>CUSTOMER</th>
                                        <th>ORDER NO</th>
                                        <th>REFERENCE NO</th>
                                        <th>DATE</th>
                                        <th>DELIVERY DATE</th>
                                        <th>AMOUNT</th>
                                        <th>STAGE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salesOrder as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->orderno }}</td>
                                        <td>{{ $item->referenceno}}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->deliverydate }}</td>
                                        <td>Rs {{ $item->amount }}</td>
                                        <td>{{ $item->stage }}</td>
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
                                                                Sales Order Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Enhanced Product Details Card -->
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Sales Order
                                                                        Information</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Customer Name:</strong></h6>
                                                                            <p>{{ $item->name }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Amount:</strong></h6>
                                                                            <p>{{ $item->amount }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Order No:</strong>
                                                                            </h6>
                                                                            <p>{{ $item->orderno }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Date:</strong></h6>
                                                                            <p>{{ $item->date }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Stage:</strong></h6>
                                                                            <p>{{ $item->stage }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Quantity:</strong></h6>
                                                                            <p>{{ $item->quantity }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Rate:</strong></h6>
                                                                            <p>{{ $item->rate }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Discount:</strong></h6>
                                                                            <p>{{ $item->discount }}</p>
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
                                                            <h4 class="modal-title"><b>Update Sales Order</b></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateSalesOrder') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Customer
                                                                        Name:</label>
                                                                    <select id="name" name="name"
                                                                        class="form-control mb-2">
                                                                        @foreach($hello as $category)
                                                                        <option value="{{ $category->name }}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="orderno">Order No:</label>
                                                                    <input type="text" id="orderno" name="orderno"
                                                                        value="{{ $item->orderno }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="referenceno">Reference No:</label>
                                                                    <input type="text" id="referenceno"
                                                                        name="referenceno"
                                                                        value="{{ $item->referenceno }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="date">Date:</label>
                                                                    <input type="date" id="date" name="date"
                                                                        value="{{ $item->date }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="deliverydate">Delivery Date:</label>
                                                                    <input type="date" id="deliverydate"
                                                                        name="deliverydate"
                                                                        value="{{ $item->deliverydate }}"
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
                                                                        placeholder="Enter Quantity"
                                                                        value="{{$item->quantity}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="discount">Discount:</label>
                                                                    <input type="discount" id="discount" name="discount"
                                                                        placeholder="Enter discount"
                                                                        value="{{$item->discount}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="amount">Amount:</label>
                                                                    <input type="text" id="amount" name="amount"
                                                                        placeholder="Enter Amount"
                                                                        value="{{$item->amount}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="stage">Stage:</label>
                                                                    <select class="form-control" name="stage"
                                                                        id="stage">
                                                                        <option value="{{$item->stage}}" selected>
                                                                            {{$item->stage}}</option>
                                                                        <option value="Pending">Pending
                                                                        </option>
                                                                        <option value="Cancelled">Cancelled
                                                                        </option>
                                                                        <option value="On Check">On Check
                                                                        </option>
                                                                        <option value="Completed">Completed</option>

                                                                    </select>
                                                                </div>

                                                                <div class="d-grid">
                                                                    <button type="submit" name="save"
                                                                        class="btn btn-success" value="Save "><i
                                                                            class="fas fa-save"></i>
                                                                        Save Changes </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('salesOrder.destroy', $item->id) }}" method="POST"
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

<!-- Add Category Modal -->
<div class="modal" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ url('AddCategory') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category" name="category"
                            placeholder="Enter Category Name">
                    </div>
                    <input type="submit" name="save" class="btn btn-success" value="Add Category" />
                </form>
            </div>
        </div>
    </div>
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
<script>
    let variantCount = 1;

    function addVariant() {
        variantCount++;
        const container = document.createElement('div');
        container.className = 'mb-3';
        container.innerHTML = `
            <div class="mb-3">
                <label for="attributes-${variantCount}" class="form-label">Attribute ${variantCount}</label>
                <input type="text" class="form-control" id="attributes-${variantCount}" name="attributes[]" placeholder="Enter attribute name">
            </div>
            <div class="mb-3">
                <label for="options-${variantCount}" class="form-label">Options for Attribute ${variantCount}</label>
                <select class="form-select" id="options-${variantCount}" name="options[]">
                    <option value="">Select an option</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
            </div>
        `;
        document.getElementById('dynamic-variants').appendChild(container);
    }

    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection