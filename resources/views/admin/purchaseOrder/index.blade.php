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
                            <h2 class="ml-2 menu-title">PURCHASE ORDER</h2>
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
                                    data-target="#addNewPurchaseOrder">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewPurchaseOrder">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Purchase Order</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewPurchaseOrder') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf


                                            <label for="name">Supplier Name:</label>
                                            <div class="input-group">
                                                <select class="form-select form-control selectpicker" id="name"
                                                    name="name">
                                                    <option value="" selected>Supplier Name</option>
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
                                                            <option value="">Select Account</option>
                                                            <!-- Accounts will be dynamically populated here -->
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
                                                                <h5>Taxable Total: <span id="taxableTotal">0</span></h5>
                                                                <h5>VAT: <span id="vat">0</span></h5>
                                                                <h4><strong>Grand Total: <span
                                                                            id="grandTotal">0</span></strong></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <label for="orderNo"> Order No:</label>
                                            <input type="text" id="orderNo" name="orderNo" placeholder="Order No"
                                                class="form-control mb-2">

                                            <label for="referenceNo">Reference No:</label>
                                            <input type="text" id="referenceNo" name="referenceNo"
                                                placeholder="Enter Reference No" class="form-control mb-2">

                                            <label for="date">Date:</label>
                                            <input type="date" id="date" name="date" placeholder="Enter Date"
                                                class="form-control mb-2">


                                            <label for="cterms">Condition & Terms:</label>
                                            <input type="text" id="cterms" name="cterms"
                                                placeholder="Enter Conditions & Terms" class="form-control mb-2">

                                            <div class="m-3">
                                                <label for="stage"> Stage:</label>
                                                <select class="form-control" name="stage" id="stage">
                                                    <option value="" selected>Select Status</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="In Check">In Check </option>
                                                    <option value="In Progress">In Progress
                                                    <option value="Complete">Complete </option>
                                                    </option>
                                                </select>
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
                                        <th>ORDER NO</th>
                                        <th>REFERENCE NO</th>
                                        <th>DATE</th>
                                        <th>STAGE</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchase as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->orderNo }}</td>
                                        <td>{{ $item->referenceNo }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->stage }}</td>


                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Purchase Order</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdatePurchaseOrder') }}"
                                                                method="POST" enctype="multipart/form-data">
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
                                                                            {{-- <option value="{{ $category->name }}"
                                                                                {{ $category->id
                                                                                == $item->category_id ? 'selected' : ''
                                                                                }}>
                                                                                {{ $category->name }} --}}
                                                                            <option value="{{$category->name}}">
                                                                                {{$category->name}}</option>
                                                                            {{-- </option> --}}
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="m-3">

                                                                    <label for="orderNo"> Order No:</label>
                                                                    <input type="text" id="orderNo" name="orderNo"
                                                                        placeholder="Order No"
                                                                        value="{{$item->orderNo}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="referenceNo">Reference No:</label>
                                                                    <input type="text" id="referenceNo"
                                                                        value="{{$item->referenceNo}}"
                                                                        name="referenceNo"
                                                                        placeholder="Enter Reference No"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="m-3">
                                                                    <label for="date">Date:</label>
                                                                    <input type="date" id="date" name="date"
                                                                        placeholder="Enter Date" value="{{$item->date}}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="m-3">
                                                                    <label for="cterms">Condition &
                                                                        Terms:</label>
                                                                    <input type="text" id="cterms" name="cterms"
                                                                        value="{{$item->cterms}}"
                                                                        placeholder="Enter Conditions & Terms"
                                                                        class="form-control mb-2">
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
                                                                </div>



                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Now" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('purchaseOrder.destroy', $item->id) }}" method="POST"
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
    document.addEventListener('DOMContentLoaded', function() {
    const accountSelect = document.getElementById('account');
    const amountInput = document.getElementById('amount');
    const taxSelect = document.getElementById('tax');

    const subTotalElem = document.getElementById('subTotal');
    const nonTaxableTotalElem = document.getElementById('nonTaxableTotal');
    const taxableTotalElem = document.getElementById('taxableTotal');
    const vatElem = document.getElementById('vat');
    const grandTotalElem = document.getElementById('grandTotal');

    // Example accounts (this should be dynamically populated from the server)
    const accounts = [
    { id: 1, name: 'Biswanath Crusher Udhyog Pvt Ltd (CA0026)' },
    { id: 2, name: 'Another Company Pvt Ltd (CA0027)' }
    ];

    // Populate accounts dynamically
    accounts.forEach(account => {
    const option = document.createElement('option');
    option.value = account.id;
    option.textContent = account.name;
    accountSelect.appendChild(option);
    });

    // Event listener to handle changes in amount and tax
    amountInput.addEventListener('input', updateTotals);
    taxSelect.addEventListener('change', updateTotals);

    function updateTotals() {
    const amount = parseFloat(amountInput.value) || 0;
    const taxRate = parseFloat(taxSelect.value) || 0;

    const subTotal = amount;
    const taxableTotal = subTotal;
    const vat = (taxRate / 100) * taxableTotal;
    const grandTotal = taxableTotal + vat;

    subTotalElem.textContent = subTotal.toFixed(2);
    nonTaxableTotalElem.textContent = (0).toFixed(2); // You can modify this if needed
    taxableTotalElem.textContent = taxableTotal.toFixed(2);
    vatElem.textContent = vat.toFixed(2);
    grandTotalElem.textContent = grandTotal.toFixed(2);
    }
    });
</script>
@endsection