<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.riceItem')->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::with('riceItem')
            ->whereDoesntHave('payment')
            ->where('status', '!=', 'cancelled')
            ->get();
        return view('payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id'       => 'required|exists:orders,id',
            'amount'         => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,gcash,bank',
        ]);

        Payment::create($request->all());

        // Mark order as completed
        Order::findOrFail($request->order_id)
            ->update(['status' => 'completed']);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully!');
    }
}