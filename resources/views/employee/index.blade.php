@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Employee') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="example1">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>Avatar</th>
										<th>Name</th>
										<th>Email</th>
										<th>Company</th>
										<th>Actions</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <link rel="stylesheet" href="{{ asset('') }}/datatables.min.css" />
    <script src="{{ asset('') }}/datatables.min.js"></script>
    <script>
        @php 
            $route = request()->has('company') ? route('employees.index', ['company' => request('company')]) : route('employees.index');
        @endphp
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 30,
                "processing": true,
                "stateSave": true,
                "serverSide": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis", 'pageLength'], 
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                ajax: "{{ $route }}",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'avatar', name: 'avatar'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'company', name: 'company'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    
                ],
                "autoWidth": false,
                "columnDefs": [ { orderable: false, targets: [1] } ],
                "language": {
                    "paginate": {
                        "previous": '<',
                        "next": '>',
                    },
                },
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    @endpush
@endsection
