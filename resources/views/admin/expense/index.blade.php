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
                            <h2 class="ml-2 menu-title">EXPENSES</h2>
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
                                    data-target="#addNewExpense">Add New</button>
                            </div>
                        </div>
                        <form method="GET" action="{{ route('expense.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name" class="form-label">Supplier Name</label>
                                    <select class="form-select" id="name" name="name">
                                        <option value="">Select Option</option>
                                        @foreach ($supplier as $category)
                                        <option value="{{ $category->name }}" {{ request('name')==$category->id ?
                                            'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="account" class="form-label">Account</label>
                                    <select class="form-select" id="account" name="account">
                                        <option value="">Select Option</option>
                                        @foreach ($accounts as $category)
                                        <option value="{{ $category->account }}" {{ request('account')==$category->id ?
                                            'selected' : '' }}>
                                            {{ $category->account }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <button type="submit" class="btn btn-dark">Filter</button>
                                </div>
                            </div>
                        </form>

                        {{-- <div class="p-4">
                            <form method="GET" action="{{ route('expense.index') }}" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Supplier Name</label>
                                        <select class="form-select" id="name" name="name">
                                            <option value="">Select Option</option>
                                            @foreach ($supplier as $category)
                                            <option value="{{ $category->id }}" {{ request('name')==$category->id
                                                ?
                                                'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="account" class="form-label">Account</label>
                                        <select class="form-select" id="account" name="account">
                                            <option value="">Select Option</option>
                                            @foreach ($accounts as $category)
                                            <option value="{{ $category->id }}" {{ request('account')==$category->id
                                                ?
                                                'selected' : '' }}>
                                                {{ $category->account }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="submit" class="btn btn-dark">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div> --}}



                        <div class="modal" id="addNewExpense">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header btn-primary">
                                        <h4 class="modal-title"><b>Add New Expense</b></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewExpense') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <label for="name">Supplier Name:</label>
                                            <div class="input-group">
                                                <select class="form-select form-control " id="name" name="name">
                                                    <option value="" selected>Select Supplier </option>
                                                    @foreach ($supplier as $category)
                                                    {{-- <option value="{{ $category->name }}"> --}}
                                                    <option value="{{ $category->name }}">
                                                        {{-- replace name by id above --}}
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="invoiceNo">Invoice No:</label>
                                                <input type="text" id="invoiceNo" name="invoiceNo"
                                                    placeholder="Enter Invoice No:" class="form-control mb-2">
                                            </div>

                                            <label for="date">Date:</label>
                                            <input type="date" id="date" name="date" placeholder="Enter Date"
                                                class="form-control mb-2">

                                            <div class="mb-3">
                                                <label for="dueDate">Due Date:</label>
                                                <input type="date" id="dueDate" name="dueDate"
                                                    placeholder="Enter Due Date:" class="form-control mb-2">
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
                                                                {{-- same here --}}
                                                                {{ $category->account }}
                                                            </option>
                                                            @endforeach
                                                            <!-- Accounts will be dynamically populated here -->
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="amount" class="form-label">Amount</label>
                                                        <input type="text" class="form-control" id="amount"
                                                            placeholder="Amount" />
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

                                                {{-- I DONT KNOW 4O --}}
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
                                                <label for="note">Note:</label>
                                                <input type="text" id="note" name="note" placeholder="Enter Notes"
                                                    class="form-control mb-2">
                                            </div>

                                            <div class="d-grid">
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
                                        <th>SUPPLIER NAME</th>
                                        <th>DATE</th>
                                        <th>ACCOUNT</th>
                                        <th>REFERENCE NO</th>
                                        <th>DUE DATE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expense as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->account }}</td>
                                        <td>{{ $item->invoiceNo}}</td>
                                        <td>{{ $item->dueDate }}</td>
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
                                                                Expense Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Enhanced Product Details Card -->
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <h5 class="card-title mb-0">Expenses Information
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Name:</strong></h6>
                                                                            <p>{{ $item->name }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Invoice No:</strong></h6>
                                                                            <p>{{ $item->invoiceNo}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Date:</strong></h6>
                                                                            <p>{{ $item->date }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Due Date:</strong></h6>
                                                                            <p>{{ $item->dueDate }}</p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Account:</strong></h6>
                                                                            <p>{{ $item->account}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Amount:</strong></h6>
                                                                            <p>{{ $item->amount }}</p>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h6><strong>Note:</strong></h6>
                                                                            <p>{{ $item->note}}</p>
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
                                                            <h4 class="modal-title"><b>Update Expense</b></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateExpense') }}" method="POST"
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
                                                                                {{$category->name == $item->name ?
                                                                                'selected' : ''}}>
                                                                                {{$category->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="invoiceNo">Invoice No:</label>
                                                                    <input type="text" id="invoiceNo"
                                                                        value="{{$item->invoiceNo}}" name="invoiceNo"
                                                                        class="form-control mb-2">
                                                                </div>


                                                                <div class="m-3">
                                                                    <label for="date">Date:</label>
                                                                    <input type="date" id="date" name="date"
                                                                        placeholder="Enter Date" value="{{$item->date}}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="dueDate">Due Date:</label>
                                                                    <input type="date" id="dueDate" name="dueDate"
                                                                        placeholder="Enter dueDate"
                                                                        value="{{$item->dueDate}}"
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
                                                                    <label for="account">Account:</label>
                                                                    <select class="form-control" name="account"
                                                                        id="account">
                                                                        <option value="{{$item->account}}">
                                                                            {{$item->account}}</option>
                                                                        <option value="" selected>Select Account
                                                                        </option>
                                                                        @foreach ($accounts as $category)
                                                                        <option value="{{ $category->account }}"
                                                                            {{$category->account == $item->account ?
                                                                            'selected' : ''}}>
                                                                            {{ $category->account }}
                                                                        </option>
                                                                        @endforeach
                                                                        <!-- Accounts will be dynamically populated here -->
                                                                    </select>
                                                                    </select>
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="note">Note:</label>
                                                                    <input type="text" id="note" name="note"
                                                                        value="{{$item->note}}"
                                                                        placeholder="Enter Notes"
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

                                            <form action="{{ route('expense.destroy', $item->id) }}" method="POST"
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