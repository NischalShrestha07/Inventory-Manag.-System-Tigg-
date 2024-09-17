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
                            <h2 class="ml-2 menu-title">PRODUCTS</h2>
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
                                    data-target="#addNewProduct">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewProduct">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header  btn-primary">
                                        <h4 class="modal-title"><b>Add New Product</b></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>


                                    <div class="modal-body">
                                        <form action="{{ url('AddNewProduct') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Product Code -->
                                            <div class="mb-3">
                                                <label for="code" class="form-label">Code/Sku:</label>
                                                <input type="text" id="code" name="code" placeholder="Enter Code/Sku:"
                                                    class="form-control">
                                            </div>

                                            <!-- Product Name -->
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Product Name:</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter Product Name:" class="form-control">
                                            </div>

                                            <!-- Category -->
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="category_id" name="category_id">
                                                        <option value="">Select Option</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Primary Unit -->
                                            <div class="mb-3">
                                                <label for="primary_unit" class="form-label">Primary Unit</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="primary_unit" name="primary_unit">
                                                        <option value="" selected>Select Option</option>
                                                        @foreach ($primary_unit as $item)
                                                        <option value="{{ $item->id }}">{{ $item->shortname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- HS Code -->
                                            <div class="mb-3">
                                                <label for="hscode" class="form-label">HS Code:</label>
                                                <input type="text" id="hscode" name="hscode" placeholder="HS Code"
                                                    class="form-control">
                                            </div>

                                            <!-- Quantity and Discount -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="quantity" class="form-label">Quantity:</label>
                                                    <input type="number" class="form-control" id="quantity"
                                                        name="quantity" placeholder="Enter Quantity"
                                                        oninput="calculateTotals()">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="discount" class="form-label">Discount (%):</label>
                                                    <input type="number" class="form-control" id="discount"
                                                        name="discount" placeholder="Enter Discount"
                                                        oninput="calculateTotals()">
                                                </div>
                                            </div>

                                            <!-- Rate and Tax -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="rate" class="form-label">Rate:</label>
                                                    <input type="number" class="form-control" id="rate" name="rate"
                                                        placeholder="Enter Rate" oninput="calculateTotals()">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tax" class="form-label">Tax:</label>
                                                    <select class="form-select" id="tax" name="tax">
                                                        <option value="No Vat">No VAT</option>
                                                        <option value="5%">5%</option>
                                                        <option value="10%">10%</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Notes -->
                                            <div class="mb-3">
                                                <label for="notes" class="form-label"><strong>Notes</strong></label>
                                                <textarea class="form-control" id="notes" name="notes"
                                                    placeholder="This will appear on print"></textarea>
                                            </div>

                                            <!-- Totals -->
                                            <div class="mb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5>Sub Total: <span id="subTotal">0</span></h5>
                                                        <h5>Non-Taxable Total: <span id="nonTaxableTotal">0</span></h5>
                                                        <h5>Taxable Total: <span id="taxableTotal">0</span></h5>
                                                        <h5>VAT: <span id="vat">0</span></h5>
                                                        <h4><strong>Grand Total: <span id="grandTotal">0</span></strong>
                                                        </h4>
                                                        <input type="hidden" id="grandTotalInput" name="grandTotal"
                                                            value="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            {{-- <div class="d-grid">
                                                <input type="submit" name="save" class="btn btn-success"
                                                    value="Save Now">
                                            </div> --}}
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-save"></i> Save
                                                </button>
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
                                        <th>CODE/SKU</th>
                                        <th>NAME</th>
                                        <th>CATEGORY</th>
                                        <th>QUANTITY</th>
                                        <th>TAX</th>
                                        <th>AMOUNT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category ? $item->category->name : 'No Category' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->tax }} VAT</td>
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
                                                                Product Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Enhanced Product Details Card -->
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Product Information</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Code/SKU:</strong></h6>
                                                                            <p>{{ $item->code }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Product Name:</strong></h6>
                                                                            <p>{{ $item->name }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Category:</strong></h6>
                                                                            <p>{{ $item->category ?
                                                                                $item->category->name : 'No Category' }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Primary Unit:</strong></h6>
                                                                            @foreach ($primary_unit as $unit)
                                                                            @if ($unit->id == $item->primary_unit)
                                                                            <p>{{ $unit->name }}</p>
                                                                            @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>HS Code:</strong></h6>
                                                                            <p>{{ $item->hscode }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Quantity:</strong></h6>
                                                                            <p>{{ $item->quantity }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Rate:</strong></h6>
                                                                            <p>Rs {{ $item->rate }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Tax:</strong></h6>
                                                                            <p>{{ $item->tax }} VAT</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Discount:</strong></h6>
                                                                            <p>{{ $item->discount }}%</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Amount:</strong></h6>
                                                                            <p>Rs {{ $item->amount }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h6><strong>Notes:</strong></h6>
                                                                            <p>{{ $item->notes ?? 'No Notes' }}</p>
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


                                            {{-- Update Model --}}
                                            <div class="modal fade" id="updateModel{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="updateModelLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="updateModelLabel">Update Product
                                                            </h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateProduct') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="form-row">
                                                                    <!-- Product Name -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="name">Product Name:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="name" name="name"
                                                                            value="{{ $item->name }}"
                                                                            placeholder="Enter product name">
                                                                    </div>

                                                                    <!-- Code/SKU -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="code">Code/SKU:</label>
                                                                        <input type="text" class="form-control"
                                                                            id="code" name="code"
                                                                            value="{{ $item->code }}"
                                                                            placeholder="Enter code/SKU">
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <!-- Category -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="category_id">Category:</label>
                                                                        <select id="category_id" name="category_id"
                                                                            class="form-control">
                                                                            @foreach($categories as $category)
                                                                            <option value="{{ $category->id }}" {{
                                                                                $category->id == $item->category_id ?
                                                                                'selected'
                                                                                : '' }}>{{ $category->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <!-- Primary Unit -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="primary_unit">Primary Unit:</label>
                                                                        <select id="primary_unit" name="primary_unit"
                                                                            class="form-control">
                                                                            @foreach($primary_unit as $unit)
                                                                            <option value="{{ $unit->id }}" {{ $unit->id
                                                                                == $item->primary_unit ? 'selected' : ''
                                                                                }}>{{ $unit->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <!-- Hscode -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="hscode">HS Code:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="hscode" name="hscode"
                                                                            value="{{ $item->hscode }}"
                                                                            placeholder="Enter HS code">
                                                                    </div>

                                                                    <!-- Rate -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="rate">Rate:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="rate" name="rate"
                                                                            value="{{ $item->rate }}"
                                                                            placeholder="Enter rate">
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <!-- Tax -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="tax">Tax:</label>
                                                                        <input type="text" class="form-control" id="tax"
                                                                            name="tax" value="{{ $item->tax }}"
                                                                            placeholder="Enter tax">
                                                                    </div>

                                                                    <!-- Quantity -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="quantity">Quantity:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="quantity" name="quantity"
                                                                            value="{{ $item->quantity }}"
                                                                            placeholder="Enter quantity">
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <!-- Discount -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="discount">Discount:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="discount" name="discount"
                                                                            value="{{ $item->discount }}"
                                                                            placeholder="Enter discount">
                                                                    </div>

                                                                    <!-- Amount -->
                                                                    <div class="form-group col-md-6">
                                                                        <label for="amount">Amount:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="amount" name="amount"
                                                                            value="{{ $item->amount }}"
                                                                            placeholder="Enter amount">
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fas fa-save"></i> Save
                                                                        Changes</button>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('product.destroy', $item->id) }}" method="POST"
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
    var quantity = parseFloat(document.getElementById('quantity').value) || 0;
    var discount = parseFloat(document.getElementById('discount').value) || 0;
    var rate = parseFloat(document.getElementById('rate').value) || 0;
    var subTotal = quantity * rate;
    var discountedTotal = subTotal - (subTotal * (discount / 100));
    var vat = parseFloat(document.getElementById('tax').value) || 0;
    var vatAmount = (vat / 100) * discountedTotal;

    document.getElementById('subTotal').textContent = subTotal.toFixed(2);
    document.getElementById('vat').textContent = vatAmount.toFixed(2);
    document.getElementById('grandTotal').textContent = (discountedTotal + vatAmount).toFixed(2);
    document.getElementById('grandTotalInput').value = (discountedTotal + vatAmount).toFixed(2);
}
</script>
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