@extends('admin.layout')
@section('customCss')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
{{-- problem --}}
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
                            <h2 class="ml-2 menu-title">Inventory Adjustment</h2>
                            <div>
                                @if (@session('success'))
                                <div class="alert alert-success bg-success h3 text-white rounded fw-bolder fs-1">
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                            <div>
                                @if (@session('error'))
                                <div class="alert alert-danger bg-danger h3 text-white rounded fw-bolder fs-1">
                                    {{ session('error') }}
                                </div>
                                @endif
                            </div>
                            <div class="navbar d-flex justify-content-end">
                                <button type="button" data-toggle="modal" class="btn btn-success"
                                    data-target="#AddNewAdjustment">Add New</button>
                            </div>
                        </div>


                        <div class="modal" id="AddNewAdjustment">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Inventory Adjustment</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="{{ url('AddNewInvenAdjustment') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <label for="date">Date:</label>
                                            <input type="date" id="date" name="date" placeholder="Enter Date:"
                                                class="form-control mb-2">


                                            <label for="entryNum">Entry Number:</label>
                                            <input type="text" id="entryNum" name="entryNum"
                                                placeholder="Enter Entry Number:" class="form-control mb-2">


                                            <label for="reference">Reference:</label>
                                            <input type="text" id="reference" name="reference" placeholder="Reference"
                                                class="form-control mb-2">


                                            <label for="amount">Amount:</label>
                                            <input type="text" id="amount" name="amount" placeholder="Amount"
                                                class="form-control mb-2">

                                            <label for="note">Note:</label>
                                            <input type="text" id="note" name="note" placeholder="Note"
                                                class="form-control mb-2">

                                            <input type="submit" name="save" class="btn btn-success" value="Save Now" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body ">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>ENTRY NO</th>
                                        <th>REFERENCE</th>
                                        <th>AMOUNT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($adjustments as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->entryNum }}</td>
                                        <td>{{ $item->reference }}</td>
                                        <td>Rs {{ $item->amount }}</td>
                                        {{-- <td>
                                            <a href="" class="btn" title="Edit">
                                                <i class="fas fa-edit fa-lg"></i>
                                            </a> --}}

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
                                                            <h4 class="modal-title">Update Inventory Adjustment</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('UpdateAdjustment') }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <label for="date">Date:</label>
                                                                <input type="date" id="date" name="date"
                                                                    value="{{ $item->date }}" placeholder="Enter Date:"
                                                                    class="form-control mb-2">


                                                                <label for="entryNum">Entry Number:</label>
                                                                <input type="text" id="entryNum" name="entryNum"
                                                                    value="{{ $item->entryNum }}"
                                                                    placeholder="Enter Entry Number:"
                                                                    class="form-control mb-2">


                                                                <label for="reference">Reference:</label>
                                                                <input type="text" id="reference" name="reference"
                                                                    value="{{ $item->reference }}"
                                                                    placeholder="Reference" class="form-control mb-2">


                                                                <label for="amount">Amount:</label>
                                                                <input type="text" id="amount" name="amount"
                                                                    value="{{ $item->amount }}" placeholder="Amount"
                                                                    class="form-control mb-2">

                                                                <label for="note">Note:</label>
                                                                <input type="text" id="note" name="note"
                                                                    value="{{ $item->note }}" placeholder="Note"
                                                                    class="form-control mb-2">




                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <input type="submit" name="save" class="btn btn-success"
                                                                    value="Save Changes" />
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <form action="{{ route('adjustment.destroy', $item->id) }}" method="POST"
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
    </section>
</div>
@endsection
@section(' customJs')
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


<script>
    $(function() {
            bsCustomFileInput.init();
        });
    @endsection