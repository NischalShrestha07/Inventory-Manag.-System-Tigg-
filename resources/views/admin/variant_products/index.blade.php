@extends('admin.layout')
@section('customCss')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Variant Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Varient Product</li>
                    </ol>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="menu-title navbar">
                                <h2 class="ml-2 menu-title"> Products</h2>
                                <div>
                                    @if (@session('success'))
                                    <div class="alert alert-success bg-success h3 text-white rounded">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    @if (@session('error'))
                                    <div class="alert alert-danger bg-danger h3 text-white rounded">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="navbar d-flex justify-content-end">
                                    <button type="button" data-toggle="modal" class="btn btn-success"
                                        data-target="#addNewVarProduct">Add New</button>
                                </div>
                            </div>
                            <div class="modal" id="addNewVarProduct">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">New Product Variant</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>


                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ url('AddNewVarProduct') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <label for="code">Code/Sku:</label>
                                                <input type="text" id="code" name="code" placeholder="Enter Code/Sku:"
                                                    class="form-control mb-2">


                                                <label for="name">Product Name:</label>
                                                <input type="text" id="name" name="name"
                                                    placeholder="Enter Product Name:" class="form-control mb-2">


                                                <div class="mb-3">
                                                    <label for="category" class="form-label">Category</label>
                                                    <div class="input-group">
                                                        <select class=" form-control " id="category" name="category">
                                                            <option value="">Select Options</option>
                                                            @foreach ($categories as $category)
                                                            <option value="{{ $category->name }}">
                                                                {{ $category->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="btn btn-primary ml-2"
                                                            data-toggle="modal" data-target="#addCategoryModal">Add
                                                            Category</button>

                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tax">Tax:</label>
                                                    <select class="form-control" name="tax" id="tax">
                                                        <option value="" selected>Select Option</option>
                                                        <option value="13">13 %VAT</option>
                                                        <option value="0">0 %VAT</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="primary_unit" class="form-label">Primary Unit</label>
                                                    <div class="input-group">
                                                        <select class="form-control" id="primary_unit"
                                                            name="primary_unit" required>
                                                            <option value="" selected>Select Option</option>
                                                            @foreach ($primary_unit as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <label for="selling_price">Selling Price:</label>
                                                <input type="text" id="selling_price" name="selling_price"
                                                    placeholder="Enter Selling Price:" class="form-control mb-2">


                                                <label for="purchase_price">Purchase Price:</label>
                                                <input type="text" id="purchase_price" name="purchase_price"
                                                    placeholder="Enter Purchase Price:" class="form-control mb-2">


                                                {{-- Dependent Dropdown --}}
                                                <div class="mb-3">
                                                    <h4>Product Information</h4>
                                                    <div id="dynamic-variants">
                                                        <!-- Default Attribute and Options -->

                                                        <div class="variant-group mb-3">
                                                            <label for="attributes"
                                                                class="form-label">Attributes</label>
                                                            <select class="form-select form-control" name="attributes[]"
                                                                onchange="fetchOptions(this)">
                                                                <option value="" selected>Select Attributes</option>
                                                                <!-- Attributes will be loaded dynamically from the database -->
                                                                @foreach ($attributes as $attribute)
                                                                <option value="{{ $attribute->name }}">{{
                                                                    ucfirst($attribute->name) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="variant-group mb-3">
                                                            <label for="options" class="form-label">Options</label>
                                                            <select class="form-select form-control" name="options[]">
                                                                <option value="" selected>Please select</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-success mb-2"
                                                        onclick="addVariant()">+ Add More Variants</button>
                                                    <button type="button" class="btn btn-primary mb-2"
                                                        onclick="generateVariants()">Generate Variants</button>
                                                </div>
                                                {{--
                                        </div> --}}
                                        <input type="submit" name="save" class="btn btn-success" value="Save Changes"
                                            m-5 />
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
                                        <th>TAX</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($varProducts as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>

                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->tax }}% VAT</td>




                                        {{-- Update Model --}}
                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $i }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>
                                            <div class="modal" id="updateModel{{ $i }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Varient Product</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateVarProduct') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')


                                                                <label for="code">Code/Sku:</label>
                                                                <input type="text" id="code" name="code" disabled
                                                                    value="{{ $item->code }}"
                                                                    placeholder="Enter Code/Sku:"
                                                                    class="form-control mb-2">


                                                                <label for="name">Product Name:</label>
                                                                <input type="text" id="name" name="name"
                                                                    value="{{ $item->name }}"
                                                                    placeholder="Enter Product Name:"
                                                                    class="form-control mb-2">




                                                                <label for="category">Category Name:</label>
                                                                <divclass="input-group">
                                                                    <select class=" form-control " id="category"
                                                                        name="category">
                                                                        <option value="">Select Options</option>
                                                                        @foreach ($categories as $category)
                                                                        <option value="{{ $category->name }}" {{
                                                                            $category->name == $item->product ?
                                                                            'selected' : '' }}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    {{-- <button type="button"
                                                                        class="btn btn-primary ml-2" data-toggle="modal"
                                                                        data-target="#addCategoryModal">Add
                                                                        Category</button> --}}

                                                                    </divclass=>


                                                                    <label for="tax">Tax:</label>
                                                                    <input type="text" id="tax" name="tax"
                                                                        value="{{ $item->tax }}" placeholder="Tax"
                                                                        class="form-control mb-2">




                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">
                                                                    <input type="submit" name="save"
                                                                        class="btn btn-success" value="Save Changes" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('varProduct.destroy', $item->id) }}" method="POST"
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

                    </div>

                </div>

            </div>

</div>
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
</section>

</div>
@endsection
@section('customJs')
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
{{-- <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> --}}
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
{{-- <script src="plugins/pdfmake/pdfmake.min.js"></script> --}}
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Bootstrap CSS -->
<script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>
<!-- Include Bootstrap Selectpicker CSS -->

<!-- Include Bootstrap Selectpicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="dist/js/demo.js"></script>

<script>
    function fetchOptions(element) {
        const attribute = element.value;
        const optionsSelect = document.querySelector('select[name="options[]"]'); // Get the options dropdown

        if (attribute) {
        fetch(`/fetch-options/${attribute}`)
        .then(response => response.json())
        .then(data => {
        optionsSelect.innerHTML = '<option value="" selected>Please select</option>'; // Clear current options
        data.options.forEach(option => {
        optionsSelect.innerHTML += `<option value="${option.value}">${option.label}</option>`;
        });
        })
        .catch(error => console.error('Error fetching options:', error));
        } else {
        optionsSelect.innerHTML = '<option value="" selected>Please select</option>'; // Reset if no attribute selected
        }
        }

    $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });


    $(function() {
        bsCustomFileInput.init();
    });
    function addVariant() {
    const variantGroup = document.createElement('div');
    variantGroup.className = 'variant-group mb-3';

    variantGroup.innerHTML = `

    <div id="dynamic-variants">
        <!-- Default Attribute and Options -->
        <div class="variant-group mb-3">
            <label for="attributes" class="form-label">Attributes</label>
            <select class="form-select form-control" name="attributes[]">
                <option value="" selected>Select Attributes</option>
                <option value="color">Color</option>
                <option value="size">Size</option>
            </select>
        </div>

        <div class="variant-group mb-3">
            <label for="options" class="form-label ">Options</label>
            <select class="form-select form-control" name="options[]">
                <option value="" selected>Please select</option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
            </select>
        </div>
    </div>
    <button type="button" class="btn btn-danger mt-2" onclick="removeVariant(this)">Remove</button>
    `;

    document.getElementById('dynamic-variants').appendChild(variantGroup);
    }

    function removeVariant(button) {
    const variantGroup = button.parentElement;
    variantGroup.remove();
    }

    function generateVariants() {
    // Add your logic to generate variants based on selected attributes and options
    alert('Generating variants...');

    }
</script>
@endsection