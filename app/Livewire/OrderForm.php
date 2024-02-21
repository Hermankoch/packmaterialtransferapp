<?php

namespace App\Livewire;

use App\Mail\OrderPdfMail;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrderForm extends Component
{

    public $date;
    protected $listeners = ['productSelected' => 'updateProductLine'];
    public $deliveryNote;
    public $collectedBy;
    public $fromWarehouse;
    public $toWarehouse;
    public $products;
    public $productLines;
    public $isEdit;

    public $order;
    public $productSearch = '';

    public function mount($orderId = null)
    {
        $this->isEdit = !is_null($orderId);
        $this->products = Product::all();

        $this->productLines = [
            [
                'product_id' => '',
                'quantity' => '',
                'total' => '',
                'batch' => ''
            ]
        ];

        if ($orderId)
        {
            $this->order = Order::with('fromWarehouse', 'toWarehouse', 'orderLines', 'orderLines.product')
                ->find($orderId);
            if($this->order)
            {
                $this->productLines = $this->order->orderLines->toArray();
                $this->fromWarehouse = $this->order->from_warehouse;
                $this->toWarehouse = $this->order->to_warehouse;
                $this->collectedBy = $this->order->collected_by;
                $this->deliveryNote = $this->order->delivery_note;
                $this->date = $this->order->date;
            }
        }
    }



    public function updateProductLine($index, $productId)
    {
        $this->productLines[$index]['product_id'] = $productId;
        $this->dispatch('productLineAdded', $this->productLines);
    }

    public function addProductLine()
    {
        $this->productLines[] = [
            'product_id' => '',
            'quantity' => '',
            'total' => '',
            'batch' => '',
        ];
        $this->dispatch('productLineAdded', $this->productLines);
    }

    public function removeProductLine($index)
    {
        unset($this->productLines[$index]);
        $this->productLines = array_values($this->productLines);
        $this->dispatch('productLineAdded', $this->productLines);
    }

    public function render()
    {
        $warehouses = Warehouse::all();
        return view('livewire.order-form',
            compact('warehouses'))
        ->extends('layouts.app')
        ->section('content');
    }

    public function submitOrder()
    {
        $this->validateForm();
        $warehouse = Warehouse::where('id', $this->toWarehouse)->first();

        if ($this->isEdit) {
            $this->editOrder();
            $this->createOrderLines($this->order);
        } else {
            $warehouse->increment('reference');
            $orderRef = $warehouse->abbr . sprintf('%03d', $warehouse->reference);
            $order = $this->createOrder($orderRef);
            $this->createOrderLines($order);
        }

        $logo = public_path('assets/images/site/logo_resized.png');

        //Mail::to(['test@test.co.za'])
        //    ->send(new OrderPdfMail($this->order ?? $order, $logo));

        session()->flash('success', 'Order created successfully. Please download the pdf from the dashboard if the email takes too long.');
        return redirect()->route('order.create');
    }

    public function validateForm()
    {
        $customMessages = [
            'productLines.*.product_id.required' => 'The product field is required.',
            'productLines.*.quantity.required' => 'The quantity field is required.',
            'productLines.*.total.required' => 'The total field is required.',
            'productLines.*.total.numeric' => 'The total field must be a number.',
        ];
        $this->validate([
            'date' => 'required',
            'fromWarehouse' => 'required|exists:warehouses,id',
            'toWarehouse' => 'required|exists:warehouses,id',
            'deliveryNote' => 'nullable|string',
            'collectedBy' => 'required|string',
            'productLines.*.product_id' => 'required|exists:products,id',
            'productLines.*.quantity' => 'required|string',
            'productLines.*.total' => 'required|numeric',
            'productLines.*.batch' => 'nullable|string',
        ], $customMessages);
    }

    public function createOrder($orderRef)
    {

        return Order::create([
            'user_id' => Auth::id(), // or any user id you want to associate
            'reference' => $orderRef,
            'from_warehouse' => $this->fromWarehouse,
            'to_warehouse' => $this->toWarehouse,
            'collected_by' => $this->collectedBy,
            'delivery_note' => $this->deliveryNote,
            'date' => $this->date,
        ]);

    }

    public function editOrder()
    {
        OrderLine::where('order_id', $this->order->id)->delete();
        $this->order->update([
            'from_warehouse' => $this->fromWarehouse,
            'to_warehouse' => $this->toWarehouse,
            'collected_by' => $this->collectedBy,
            'delivery_note' => $this->deliveryNote,
            'date' => $this->date,
        ]);
    }

    public function createOrderLines($order)
    {
        foreach ($this->productLines as $line) {
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $line['product_id'],
                'quantity' => $line['quantity'],
                'total' => $line['total'],
                'batch' => $line['batch'] ?? null,
            ]);
        }
    }
}
