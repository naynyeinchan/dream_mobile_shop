{{-- @dd($brands[0]->name); --}}
@extends('layouts.app')

@section('content')

    @section('header')
        <x-page-header header="Products List"/>
    @endsection


    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover" id="PhoneDatatable" style="width: 100%">
                    <thead>
                        <th class="text-center">ID</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">Model</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Price (USD)</th>
                        <th class="text-center no-order">Actions</th>
                        <th class="text-center">Updated At</th>
                    </thead>
                    <tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Good Job',
            text: "{{session('success')}}",
        })
        @endif

        @if (session('deleted'))
        Swal.fire({
            icon: 'success',
            title: 'Deleted',
            text: "{{session('deleted')}}",
        })
        @endif

        @if (session('updated'))
        Swal.fire({
            icon: 'success',
            title: 'Updated',
            text: "{{session('updated')}}",
        })
        @endif

        @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{session('error')}}",
        })
        @endif

        $(function() {
            var table = $('#PhoneDatatable').DataTable({
                responsive: true,
                mark: true,
                processing: false,
                serverSide: true,
                pageLength : 5,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
                ajax: "{{route('phones.index')}}", //route
                columns: [
                    { data: 'id', name: 'id', class: 'text-center' },
                    { data: 'brand_name', name: 'brand_name', class: 'text-center' },
                    { data: 'model', name: 'model', class: 'text-center'},
                    { data: 'name', name: 'name', class: 'text-center' },
                    { data: 'stock', name: 'stock', class: 'text-center' },
                    { data: 'unit_price', name: 'unit_price', class: 'text-center' },
                    { data: 'action', name: 'action', class: 'text-center' },
                    { data: 'updated_at', name: 'updated_at', class: 'text-center' }
                ],
                "columnDefs": [
                    {
                        "targets": [ 7 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        'targets': 'no-order',
                        'orderable': false
                    },
                ],
                "order": [[ 7, "desc" ]],
                "language": {
                    "paginate": {
                    "previous": "<i class='fas fa-angle-left'></i>",
                    "next": "<i class='fas fa-angle-right'></i>"
                    },
                    "processing": "Loading ..."
                }
            });

            $(document).on('click', '.delete-btn', function(event){
                event.preventDefault();

                var id = $(this).data('id');

                swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: "DELETE",
                            url: `/phones/${id}`,
                            })
                            .done(function( response ) {
                                table.ajax.reload();
                        });
                    }
                    });
                })
        });
    </script>
@endsection
