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
                            <h2 class="ml-2 menu-title">CUSTOMERS</h2>
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
                                    data-target="#addNewCustomer">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewCustomer">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Customer</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewCustomer') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <label for="name">Customer Name:</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Customer Name:"
                                                class="form-control mb-2">

                                            <label for="address">Address:</label>
                                            <input type="text" id="address" name="address" placeholder="Enter Address:"
                                                class="form-control mb-2">

                                            <label for="code">Code/Sku:</label>
                                            <input type="text" id="code" name="code" placeholder="Enter Code/Sku:"
                                                class="form-control mb-2">

                                            <label for="pan">PAN:</label>
                                            <input type="text" id="pan" name="pan" placeholder="Enter PAN Number:"
                                                class="form-control mb-2">

                                            <label for="phoneno"> Phone Number:</label>
                                            <input type="text" id="phoneno" name="phoneno"
                                                placeholder="Enter Customer Phone Number:" class="form-control mb-2">

                                            <label for="email"> Email:</label>
                                            <input type="email" id="email" name="email"
                                                placeholder="Enter Customer Email Address:" class="form-control mb-2">

                                            <label for="group"> Group:</label>
                                            <select class="form-control" name="group" id="group">
                                                <option value="" selected>Select Group</option>
                                                <option value="abc enterprise">abc enterprise
                                                </option>
                                                <option value="Ramesh Trader">Ramesh Trader
                                                </option>
                                                <option value="Prakash Store">Prakash Store
                                                </option>
                                                <option value="Om Trader">Om Trader</option>
                                            </select>


                                            <label for="cterms"> Credit Terms:</label>
                                            <select class="form-control" name="cterms" id="cterms">
                                                <option value="" selected>Credit Terms</option>
                                                <option value="NET 30">NET 30
                                                </option>
                                                <option value="NET 45">NET 45
                                                </option>
                                                <option value="NET 60">NET 60
                                                </option>
                                                <option value="NET 90">NET 90
                                                </option>
                                            </select>

                                            <div class="mb-3">
                                                <label for="climit">Credit Limit:</label>
                                                <input type="text" id="climit" name="climit"
                                                    placeholder="Enter Credit Limit:" class="form-control mb-2">
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
                                        <th>FULL NAME</th>
                                        <th>GROUP</th>
                                        <th>PHONE NO</th>
                                        <th>EMAIL</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->group }}</td>
                                        <td>{{ $item->phoneno}}</td>
                                        <td>{{ $item->email }}</td>
                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Customer</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateCustomer') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Customer
                                                                        Name:</label>
                                                                    <input type="text" class="form-control" id="name"
                                                                        name="name" value="{{ $item->name }}"
                                                                        placeholder="Customer Name">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="address">Address:</label>
                                                                    <input type="text" id="address" name="address"
                                                                        value="{{ $item->address }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="code">Code/Sku:</label>
                                                                    <input type="text" id="code" name="code"
                                                                        value="{{ $item->code }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="pan">PAN:</label>
                                                                    <input type="text" id="pan" name="pan"
                                                                        value="{{ $item->pan }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="phoneno">Phone Number:</label>
                                                                    <input type="text" id="phoneno" name="phoneno"
                                                                        value="{{ $item->phoneno }}"
                                                                        class="form-control mb-2">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email">Email Address:</label>
                                                                    <input type="email" id="email" name="email"
                                                                        value="{{ $item->email }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="group">Group:</label>
                                                                    <select class="form-control" name="group"
                                                                        id="group">
                                                                        <option value="{{$item->group}}" selected>
                                                                            {{$item->group}}</option>
                                                                        <option value="abc enterprise">abc enterprise
                                                                        </option>
                                                                        <option value="Ramesh Trader">Ramesh Trader
                                                                        </option>
                                                                        <option value="Prakash Store">Prakash Store
                                                                        </option>
                                                                        <option value="Om Trader">Om Trader</option>
                                                                    </select>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="cterms">Credit Terms:</label>
                                                                    <select class="form-control" name="cterms"
                                                                        id="cterms">
                                                                        <option value="{{$item->cterms}}" selected>
                                                                            {{$item->cterms}}</option>
                                                                        <option value="NET 30">NET 30
                                                                        </option>
                                                                        <option value="NET 45">NET 45
                                                                        </option>
                                                                        <option value="NET 60">NET 60
                                                                        </option>
                                                                        <option value="NET 90">NET 90
                                                                        </option>

                                                                    </select>


                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="climit">Credit Limit:</label>
                                                                    <input type="text" id="climit" name="climit"
                                                                        value="{{ $item->climit }}"
                                                                        class="form-control mb-2">
                                                                </div>

                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Now" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('customer.destroy', $item->id) }}" method="POST"
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