@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mx-3 my-1">
            {{ session('success') }}
        </div>
    @endif
    <div class="card m-3 p-3">
        <table id="products" class="table table-responsive table-striped w-100 p-2">
            <thead>
            <tr>
                <th class="bg-primary-subtle">Inventory Id</th>
                <th class="bg-primary-subtle">Description</th>
                <th class="bg-primary-subtle">QR Image</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="reader" width="600px"></div>
    <script>
        "use strict"
        let products = @json($products);
        let html5QrcodeScanner;

        if (window.addEventListener) {
            window.addEventListener("load", setup, false);
        } else if (window.attachEvent) {
            window.attachEvent("onload", setup);
        }

        function setup() {
            dataTable();
            html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: {width: 250, height: 250} },
                /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        function dataTable() {
            let table = $('#products').DataTable({
                responsive: true,
                data: products,
                order: [[1, 'asc']],
                columnDefs: [
                    {
                        targets: [2], className: 'text-center',
                    }
                ],
                ordering: true,
                columns: [
                    {
                        data: 'inventoryId',
                    },
                    {
                        data: 'description',
                    },
                    {
                        defaultContent: 'Static content',
                        render: function (data, type, row) {
                            return '<a class="btn btn-outline-warning" href="/products/qr-image/'+ row.id +'"><i class="fa-solid fa-qrcode"></i></a>';
                        }
                    },
                ],
            });
        }

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            alert(`Code matched = ${decodedText}`, decodedResult);
            console.log(`Code matched = ${decodedText}`, decodedResult);

        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }



        {{--function dataTable() {--}}
        {{--    let table = $('#orders').DataTable({--}}
        {{--        responsive: true,--}}
        {{--        data: orders,--}}
        {{--        order: [[0, 'desc']],--}}
        {{--        columnDefs: [--}}
        {{--            {--}}
        {{--                targets: [3,4,5,6], className: 'text-center',--}}
        {{--            }--}}
        {{--        ],--}}
        {{--        ordering: true,--}}
        {{--        columns: [--}}
        {{--            {--}}
        {{--                data: 'id',--}}
        {{--            },--}}
        {{--            {--}}
        {{--                data: 'date',--}}
        {{--            },--}}
        {{--            {--}}
        {{--                data: 'reference',--}}
        {{--            },--}}
        {{--            {--}}
        {{--                defaultContent: 'Static content',--}}
        {{--                render: function (data, type, row) {--}}
        {{--                    return '<a class="btn btn-outline-warning" href="/edit-order/'+ row.id +'"><i class="fa-solid fa-pen-to-square"></i></a>';--}}
        {{--                }--}}
        {{--            },--}}
        {{--            {--}}
        {{--                defaultContent: 'Static content',--}}
        {{--                render: function (data, type, row) {--}}
        {{--                    return '<a class="btn btn-outline-danger" href="/view-pdf/'+ row.id +'" target="_blank"><i class="fa-solid fa-file-pdf"></i></a>';--}}
        {{--                }--}}
        {{--            },--}}
        {{--            {--}}
        {{--                defaultContent: 'Static content',--}}
        {{--                render: function (data, type, row) {--}}
        {{--                    return '<a class="btn btn-outline-primary" href="/email-pdf/'+ row.id +'" ><i class="fa-solid fa-envelope"></i></i></a>';--}}
        {{--                }--}}
        {{--            },--}}
        {{--            {--}}
        {{--                defaultContent: 'Static content',--}}
        {{--                render: function (data, type, row) {--}}
        {{--                    return '<a class="btn btn-outline-success" href="/export-acumatica/'+ row.id +'" > <i class="fa-solid fa-file-export"></i></a>';--}}
        {{--                }--}}
        {{--            },--}}
        {{--        ],--}}
        {{--    });--}}
        {{--}--}}

    </script>
@endsection
