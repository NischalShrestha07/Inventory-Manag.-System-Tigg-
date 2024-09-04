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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="menu-title navbar">
                            <h2 class="ml-2 menu-title">Goods</h2>
                            <div>
                                @if (session('success'))
                                <div class="alert alert-success bg-success h3 text-white rounded fw-bolder fs-1">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div class="navbar d-flex justify-content-end">
                                <button type="button" data-toggle="modal" class="btn btn-success"
                                    data-target="#addNewProduct">Add New</button>
                            </div>
                        </div>

                        <div class="modal" id="addNewProduct">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Product</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewProduct') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <label for="code">Code/Sku:</label>
                                            <input type="text" id="code" name="code" placeholder="Enter Code/Sku:"
                                                class="form-control mb-2">

                                            <label for="name">Product Name:</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Product Name:"
                                                class="form-control mb-2">



                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category</label>
                                                <div class="input-group">
                                                    <select class="form-select form-control selectpicker" id="category"
                                                        name="category">
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

                                            <label for="tax"> Tax:</label>
                                            <input type="text" id="tax" name="tax" placeholder="Enter Product Tax:"
                                                class="form-control mb-2">


                                            <div class="mb-3">
                                                <label for="primary_unit" class="form-label">Primary Unit</label>
                                                <div class="input-group">
                                                    <select class="form-select form-control selectpicker"
                                                        id="primary_unit" name="primary_unit">
                                                        @foreach ($primary_unit as $item)
                                                        <option value="{{ $item->name }}">
                                                            {{ $item->name }}
                                                        </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>




                                            {{--
                                            <!-- Purchase Price -->
                                            <div class="mb-3">
                                                <label for="purchasePrice" class="form-label">Purchase Price</label>
                                                <input type="number" class="form-control" id="purchasePrice"
                                                    placeholder="0">
                                            </div>

                                            <div class="mb-3">
                                                <label for="primaryUnit" class="form-label">Primary Unit</label>
                                                <select class="form-select" id="primaryUnit">
                                                    <option selected>Select Unit</option>
                                                    <option value="1">Kg</option>
                                                    <option value="2">Liter</option>
                                                </select>
                                            </div>

                                            <h4>Product Information</h4>
                                            <div id="dynamic-variants">
                                                <!-- Default Attribute and Options -->
                                                <div class="mb-3">
                                                    <label for="attributes" class="form-label">Attributes</label>
                                                    <select class="form-select" id="attributes" name="attributes[]">
                                                        <option value="" selected>Select Attributes</option>
                                                        <option value="color">Color</option>
                                                        <option value="size">Size</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="options" class="form-label">Options</label>
                                                    <select class="form-select" id="options" name="options[]">
                                                        <option value="" selected>Please select</option>
                                                        <option value="option1">Option 1</option>
                                                        <option value="option2">Option 2</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <button type="button" class="btn btn-success mb-2"
                                                    onclick="addVariant()">+ Add More Variants</button>
                                                <button type="button" class="btn btn-primary mb-2">Generate
                                                    Variants</button>
                                            </div> --}}

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
                                        <th>CODE/SKU</th>
                                        <th>NAME</th>
                                        <th>CATEGORY</th>
                                        <th>TAX</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->tax }}% VAT</td>


                                        <td class="font-weight-medium">
                                            <button type="button" class="btn" title="Edit" data-toggle="modal"
                                                data-target="#updateModel{{ $item->id }}">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </button>

                                            <div class="modal" id="updateModel{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Product</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateProduct') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')


                                                                <input type="hidden" name="id" value="{{ $item->id }}">

                                                                <div class="mb-3">
                                                                    <label for="productName" class="form-label">Product
                                                                        Name:</label>
                                                                    <input type="text" class="form-control" id="name"
                                                                        name="name" value="{{ $item->name }}"
                                                                        placeholder="Name">
                                                                </div>

                                                                <label for="code">Code/Sku:</label>
                                                                <input type="text" id="code" name="code"
                                                                    value="{{ $item->code }}"
                                                                    placeholder="Enter Code/Sku:"
                                                                    class="form-control mb-2">


                                                                <label for="category">Category:</label>
                                                                <select id="category" name="category"
                                                                    class="form-control mb-2">
                                                                    @foreach($categories as $category)
                                                                    <option value="{{ $category->name }}" {{ $category->
                                                                        id == $item->category ? 'selected' : '' }}>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>

                                                                </select>


                                                                <label for="tax">tax/Sku:</label>
                                                                <select class="form-control" name="tax" id="tax">
                                                                    <option value="{{$item->tax}}" selected>
                                                                        {{$item->tax}}</option>
                                                                    <option class="form-control" id="tax" name="tax"
                                                                        value="13" class="form-control mb-2">13</option>
                                                                    <option class="form-control" id="tax" name="tax"
                                                                        value="0" class="form-control mb-2">0</option>
                                                                </select>


                                                                <label for="primary_unit">Primary Unit:</label>
                                                                <select id="primary_unit" name="primary_unit"
                                                                    class="form-control mb-2">
                                                                    @foreach($primary_unit as $item)
                                                                    <option value="{{ $item->name }}" {{ $item->
                                                                        id == $item->item ? 'selected' : '' }}>
                                                                        {{ $item->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>

                                                                </select>


                                                                <div class="mb-3">
                                                                    <label for="primary_unit" class="form-label">Primary
                                                                        Unit</label>
                                                                    <input type="number" class="form-control"
                                                                        id="primary_unit"
                                                                        value="{{ $item->primary_unit }}"
                                                                        placeholder="0">
                                                                </div>


                                                                <div class="mb-3">
                                                                    <label for="htdocs"
                                                                        class="form-label">Htdocs</label>
                                                                    <input type="number" class="form-control"
                                                                        id="htdocs" value="{{ $item->htdocs }}"
                                                                        placeholder="0">
                                                                </div>


                                                                {{--
                                                                <div class="mb-3">
                                                                    <label for="purchasePrice"
                                                                        class="form-label">Purchase Price</label>
                                                                    <input type="number" class="form-control"
                                                                        id="purchasePrice"
                                                                        value="{{ $item->purchase_price }}"
                                                                        placeholder="0">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="primaryUnit" class="form-label">Primary
                                                                        Unit</label>
                                                                    <select class="form-select" id="primaryUnit">
                                                                        <option selected>Select Unit</option>
                                                                        <option value="1" {{ $item->primary_unit == 1 ?
                                                                            'selected' : '' }}>
                                                                            Kg</option>
                                                                        <option value="2" {{ $item->primary_unit == 2 ?
                                                                            'selected' : '' }}>
                                                                            Liter</option>
                                                                    </select>
                                                                </div>

                                                                <h4>Product Information</h4>
                                                                <div id="dynamic-variants">
                                                                    <div class="mb-3">
                                                                        <label for="attributes"
                                                                            class="form-label">Attributes</label>
                                                                        <select class="form-select" id="attributes"
                                                                            name="attributes[]">
                                                                            <option value="" selected>Select
                                                                                Attributes</option>
                                                                            <option value="color">Color</option>
                                                                            <option value="size">Size</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="options"
                                                                            class="form-label">Options</label>
                                                                        <select class="form-select" id="options"
                                                                            name="options[]">
                                                                            <option value="" selected>Please
                                                                                select</option>
                                                                            <option value="option1">Option 1
                                                                            </option>
                                                                            <option value="option2">Option 2
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <button type="button" class="btn btn-success mb-2"
                                                                        onclick="addVariant()">+ Add More
                                                                        Variants</button>
                                                                    <button type="button"
                                                                        class="btn btn-primary mb-2">Generate
                                                                        Variants</button>
                                                                </div> --}}

                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Now" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="#" class="text-danger"
                                                onclick="event.preventDefault();
                                                                document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                <i class="fas fa-trash fa-lg"></i>
                                            </a>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('product.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
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
<script>
    function addVariant() {
            var dynamicVariants = document.getElementById('dynamic-variants');
            var variantElement = document.createElement('div');
            variantElement.className = 'mb-3';
            variantElement.innerHTML = `
                <label for="attributes" class="form-label">Attributes</label>
                <select class="form-select" id="attributes" name="attributes[]">
                    <option value="" selected>Select Attributes</option>
                    <option value="color">Color</option>
                    <option value="size">Size</option>
                </select>
                <label for="options" class="form-label">Options</label>
                <select class="form-select" id="options" name="options[]">
                    <option value="" selected>Please select</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                </select>
            `;
            dynamicVariants.appendChild(variantElement);
        }
</script>
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
