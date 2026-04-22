<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\RiceItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('riceItem')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $riceItems = RiceItem::where('stock', '>', 0)->get();
        return view('orders.create', compact('riceItems'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'rice_item_id'  => 'required|exists:rice_items,id',
            'customer_name' => 'required|string|max:255',
            'quantity'      => 'required|numeric|min:0.01',
            'status'        => 'required|in:pending,completed,cancelled',
        ]);

        // Get rice item
        $riceItem = RiceItem::findOrFail($request->rice_item_id);

        // Check stock
        if ($request->quantity > $riceItem->stock) {
            return back()
                ->withErrors(['quantity' => 'Not enough stock available.'])
                ->withInput();
        }

        //  Calculate total
        $totalAmount = $riceItem->price * $request->quantity;

        //  Save order (FIXED: total_amount)
        Order::create([
            'rice_item_id'  => $request->rice_item_id,
            'customer_name' => $request->customer_name,
            'quantity'      => $request->quantity,
            'total_amount'  => $totalAmount, //  FIX
            'status'        => $request->status,
        ]);

        //  Deduct stock
        $riceItem->decrement('stock', $request->quantity);

        //  Redirect
        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        $order->load('riceItem');
        return view('orders.show', compact('order'));
    }   

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}