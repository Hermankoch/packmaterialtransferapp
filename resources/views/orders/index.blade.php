@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mx-3 my-1">
            {{ session('success') }}
        </div>
    @endif


    <div aria-live="polite" aria-atomic="true" class="position-relative" >
        <div class="toast-container" style="position: fixed; top: 80px; right: 35%; z-index: 2000;">
            <div id="actionToast"
                 class="toast alert-primary alert p-1"
                 role="alert"
                 aria-live="assertive"
                 aria-atomic="true"
                 style="color: white; background-color: rgba(0, 70, 125, 0.5);">
                <div class="d-flex justify-content-between">
                    <div class="success toast-body">
                       Transfer Updated
                    </div>
                    <button type="button" class="ml-2 mb-1 btn-close btn-close-white" style="opacity: 1;"
                            data-dismiss="toast" aria-label="Close"
                            onclick="dismissToast();"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card m-3 p-3">
        <table id="orders" class="table table-responsive table-striped w-100 p-2">
            <thead>
            <tr>
                <th class="bg-primary-subtle">Completed</th>
                <th class="bg-primary-subtle">Transfer Id</th>
                <th class="bg-primary-subtle">Date</th>
                <th class="bg-primary-subtle">Reference Nr</th>
                <th class="bg-primary-subtle">Created By</th>
                <th class="bg-primary-subtle">Edit Transfer</th>
                <th class="bg-primary-subtle">View PDF</th>
                <th class="bg-primary-subtle">Email PDF</th>
                <th class="bg-primary-subtle">Export Acu</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script>
        "use strict"
        let orders = @json($orders);
        let toast;

        if (window.addEventListener) {
            window.addEventListener("load", setup, false);
        } else if (window.attachEvent) {
            window.attachEvent("onload", setup);
        }

        function setup() {
            dataTable();
            toast = new bootstrap.Toast($('#actionToast'));
        }

        function dataTable() {
            let table = $('#orders').DataTable({
                responsive: true,
                data: orders,
                order: [[1, 'desc']],
                columnDefs: [
                    {
                        targets: [0,3,4,5,6,7], className: 'text-center',
                    }
                ],
                ordering: true,
                columns: [
                    {
                        defaultContent: 'Static content',
                        render: function (data, type, row) {
                            if(row.actioned === 1) {

                                return '<input class="form-check-input border-black actioned" type="checkbox" checked onclick="updateOrder('+row.id+',this)">';
                            }
                            return '<input class="form-check-input border-black actioned" type="checkbox" onclick="updateOrder('+row.id+',this)">';
                        }
                    },
                    {
                        data: 'id',
                    },
                    {
                        data: 'date',
                    },
                    {
                        data: 'reference',
                    },
                    {
                        data: 'user.email'
                    },
                    {
                        defaultContent: 'Static content',
                        render: function (data, type, row) {
                            return '<a class="btn btn-outline-warning" href="/edit-order/'+ row.id +'"><i class="fa-solid fa-pen-to-square"></i></a>';
                        }
                    },
                    {
                        defaultContent: 'Static content',
                        render: function (data, type, row) {
                            return '<a class="btn btn-outline-danger" href="/view-pdf/'+ row.id +'" target="_blank"><i class="fa-solid fa-file-pdf"></i></a>';
                        }
                    },
                    {
                        defaultContent: 'Static content',
                        render: function (data, type, row) {
                            return '<a class="btn btn-outline-primary" href="/email-pdf/'+ row.id +'" ><i class="fa-solid fa-envelope"></i></i></a>';
                        }
                    },
                    {
                        defaultContent: 'Static content',
                        render: function (data, type, row) {
                            return '<a class="btn btn-outline-success" href="/export-acumatica/'+ row.id +'" > <i class="fa-solid fa-file-export"></i></a>';
                        }
                    },
                ],
            });
        }
        function updateOrder(id, checkbox) {
            let actioned = 0;

            if(checkbox.checked) {
               actioned = 1;
               actioned = 1;
            }
            //send get request to update order
            $.ajax({
                url: '/orders/completed/'+id+'/'+actioned,
                type: 'GET',
                success: function (response) {
                    toast.show();
                }
            });

        }

        function dismissToast() {
            toast.hide();
        }

    </script>
@endsection
