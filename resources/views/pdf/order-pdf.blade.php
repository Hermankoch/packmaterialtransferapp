<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-header, .table-header td, .table-header th {
            border: none;
        }
        .right {
            text-align: right;
        }
        .footer {
            position: fixed;
            bottom: -10px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
    </style>
</head>
<body>

<table class="table-header">
    <tr>
        <td>
            <p>Revision No: 01 <br> Revision Date: 17 November 2023</p>
            <img src="{{ $logo }}" alt="" width="200px">
        </td>
        <td class="right">
            <p>INTERNE AANVRAAG DOKUMENT <br>INTERNAL REQUEST DOCUMENT</p>
            <p style="border: 1px solid black; display: inline-block;
            padding: 10px; color: red;">{{ $order->reference }}</p>
        </td>
    </tr>
</table>
<br>
<strong>Date:</strong> {{ $order->date }}<br><br>

<table class="table-header">
    <tr>
        <td><strong>Vanaf / From:</strong></td>
        <td><strong>Waarheen / To:</strong></td>
    </tr>
    <tr>
        <td>{{ $order->fromWarehouse->name }}</td>
        <td>{{ $order->toWarehouse->name }}</td>
    </tr>
</table>

<p><strong>DN / CA Ref:</strong><br>{{ $order->delivery_note }}</p>

<table>
    <thead>
    <tr>
        <th><strong>Item Beskrywing / Description</strong></th>
        <th>Batch Nr/No:</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($order->orderLines as $line)
        <tr>
            <td>{{ $line->product->description }}</td>
            <td>{{ $line->batch }}</td>
            <td>{{ $line->quantity }}</td>
            <td>{{ $line->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<footer class="footer">
    <hr>
    <table class="table-header">
        <tr>
            <td><strong>Collected By:</strong> {{ $order->collected_by }}<br></td>
            <td><strong>Signature</strong></td>
        </tr>
    </table>
</footer>
</body>
</html>
