<?php

namespace App\Http\Controllers;

use App\Mail\OrderPdfMail;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderPdfController extends Controller
{
    public function emailOrderPdf($orderId)
    {
        $order = $this->getOrder($orderId);
        $logo = $this->getLogo();
        $order->date = $this->getDate($order->date);

        //Mail::to(['test@test.co.za'])
        //     ->send(new OrderPdfMail($order, $logo));

        return redirect()->route('orders')->with('success', 'Transfer Pdf sent, if the delivery takes too long please download the Pdf.');
    }

    public function viewOrderPdf($orderId)
    {
        $order = $this->getOrder($orderId);
        $logo = $this->getLogo();
        return $this->generateOrderPdf($order, $logo)->stream();
    }

    public function downloadOrderPdf($orderId)
    {
        $order = $this->getOrder($orderId);
        $logo = $this->getLogo();
        return $this->generateOrderPdf($order, $logo)->download('order.pdf');
    }

    public function generateOrderPdf($order, $logo)
    {
        return PDF::loadView('pdf.order-pdf', ['order' => $order, 'logo' => $logo]);
    }

    public function getOrder($orderId)
    {
        return Order::with('fromWarehouse', 'toWarehouse', 'orderLines', 'orderLines.product')->find($orderId);
    }

    public function getDate($date)
    {
        $date = Carbon::parse($date);
        return $date->format('d-M-Y');
    }

    public function getLogo()
    {
        return public_path('assets/images/site/logo_resized.png');
    }

    public function exportAcumatica($orderId)
    {
        $order = $this->getOrder($orderId);
        $header = [
            'Inventory ID',
            'Project',
            'Project Task',
            'To Project',
            'To Project Task',
            'UOM',
            'Quantity',
            'Reason Code',
            'Description',
        ];

        // Define a temporary file path
        $filename = 'Acumatica-' . $order->reference . '.csv';
        $tempPath = storage_path('app/public/' . $filename); // Adjust the path as necessary

        // Open file for writing
        $file = fopen($tempPath, 'w');
        fputcsv($file, $header);

        foreach ($order->orderLines as $orderLine) {
            fputcsv($file, [
                $orderLine->product->inventoryId,
                '',
                '',
                '',
                '',
                'EA',
                $orderLine->total,
                '',
                $orderLine->product->description,
            ]);
        }

        // Close the file
        fclose($file);

        // Return the file as a response for download
        return response()->download($tempPath, $filename)->deleteFileAfterSend(true);
    }

}
