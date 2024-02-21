<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;

class ProductQrController extends Controller
{
    public function QrCodeImage($productId)
    {
        $product = Product::find($productId);

        $qrCode = QrCode::create($product->inventoryId)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(500)
            ->setMargin(100)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin);

        // Create generic label
        $label = Label::create($product->description)
            ->setTextColor(new Color(0, 0, 0));
        $writer = new PngWriter();
        $result = $writer->write($qrCode, null, $label);

        // Directly output the QR code
        $tempPath = storage_path('app/public/'.$product->inventoryId.'.png' ); // Adjust the path as necessary
        $result->saveToFile($tempPath);
        return response()->download($tempPath, $product->inventoryId.'.png')->deleteFileAfterSend(true);
    }
}
