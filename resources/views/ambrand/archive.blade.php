@extends('layout.main')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@section('content')
    @if (session()->has('create_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('create_message') }}</div>
    @endif
    @if (session()->has('edit_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('edit_message') }}</div>
    @endif
    @if (session()->has('import_message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('import_message') }}</div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif


    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="container"> -->
                                <div class="d-flex flex-row-reverse mb-3 mr-4">
                                    {{-- <a href="{{ route('suppliers.create') }}" class="btn btn-info mb-1"><i
                                            class="dripicons-plus"></i> {{ trans('file.Add Supplier') }}</a> --}}
                                    <div class="col pt-1">
                                        <h2>Archived Suppliers</h2>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success alert-dismissible text-center"><button
                                                type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>{{ session()->get('message') }}
                                        </div>
                                    @endif
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <table id="data-table" class="table" style="width: 100% !important">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Brand Id</th>
                                                <th>Brand Logo Id</th>
                                                <th>Brand Name</th>
                                                <th>Lang</th>
                                                <th>Article Country</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            console.log('here');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#data-table').DataTable({
                "ordering": false,
                "processing": true,
                "serverside": true,
                ajax: "{{ route('suppliers.archive') }}",
                columns: [{
                        data: 'index',
                        name: 'index'
                    },
                    {
                        "data": "brandId",
                        name: 'brandId'
                    },
                    {
                        "data": "brandLogoID",
                        name: 'brandLogoID'
                    },
                    {
                        "data": "brandName",
                        name: 'brandName'
                    },
                    {
                        "data": "lang",
                        name: 'lang'
                    },
                    {
                        "data": "articleCountry",
                        name: 'articleCountry'
                    },
                    {
                        "data": 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });
        });


        function restoreSupplier(id) {
            Swal.fire({
                title: 'Are you sure?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: "post",
                        url: "{{ url('/restoreSupplier') }}",
                        data: {
                            id: id,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            location.reload();
                        }

                    });


                }
            });
        }

    </script>
@endsection
