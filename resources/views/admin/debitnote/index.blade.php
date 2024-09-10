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
                                                        <input type="text" class="form-control" id="amount"
                                                            placeholder="Amount" />
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
                                                        <textarea class="form-control" id="notes" name="notes"
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
                                                                <h5>Taxable Total: <span id="taxableTotal">0</span></h5>
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

                                            <div class="m-3">
                                                <label for="noteno">NoteNo:</label>
                                                <input type="text" id="noteno" name="noteno" placeholder="Enter Notes"
                                                    class="form-control mb-2">
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
                                        <th>NOTE NO</th>
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
                                        <td> {{ $item->noteno }}</td>
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

                                                                <div class="m-3">
                                                                    <label for="noteno">Note No:</label>
                                                                    <input type="text" id="noteno" name="noteno"
                                                                        value="{{$item->noteno}}"
                                                                        placeholder="Enter Note No:"
                                                                        class="form-control mb-2">
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


    document.addEventListener('DOMContentLoaded', function() {
    const accountSelect = document.getElementById('account');
    const amountInput = document.getElementById('amount');
    const taxSelect = document.getElementById('tax');

    const subTotalElem = document.getElementById('subTotal');
    const nonTaxableTotalElem = document.getElementById('nonTaxableTotal');
    const taxableTotalElem = document.getElementById('taxableTotal');
    const vatElem = document.getElementById('vat');
    const grandTotalElem = document.getElementById('grandTotal');
    const grandTotalInput = document.getElementById('grandTotalInput');

    // Fetch accounts from the server
    fetch('/api/accounts') // Adjust the URL to your API endpoint
    .then(response => response.json())
    .then(data => {
    // Populate accounts dynamically
    data.forEach(account => {
    const option = document.createElement('option');
    option.value = account.id;
    option.textContent = account.name;
    accountSelect.appendChild(option);
    });
    })
    .catch(error => console.error('Error fetching accounts:', error));

    // Event listener to handle changes in amount and tax
    amountInput.addEventListener('input', updateTotals);
    taxSelect.addEventListener('change', updateTotals);

    function updateTotals() {
    const amount = parseFloat(amountInput.value) || 0;
    const taxRate = parseFloat(taxSelect.value.replace('%', '')) || 0; // Remove '%' and convert to number

    const subTotal = amount;
    const taxableTotal = subTotal;
    const vat = (taxRate / 100) * taxableTotal;
    const grandTotal = taxableTotal + vat;

    subTotalElem.textContent = subTotal.toFixed(2);
    nonTaxableTotalElem.textContent = (0).toFixed(2); // Adjust if you have non-taxable totals
    taxableTotalElem.textContent = taxableTotal.toFixed(2);
    vatElem.textContent = vat.toFixed(2);
    grandTotalElem.textContent = grandTotal.toFixed(2);
    grandTotalInput.value = grandTotal.toFixed(2); // Update hidden input
    }

    // Optionally trigger updateTotals on page load if needed
    updateTotals();
    });
</script>
@endsection