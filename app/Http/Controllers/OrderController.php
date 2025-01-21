<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        // Ambil semua order dengan relasi client dan item
        $orders = Order::with(['client', 'item'])->latest()->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Fetch all clients and items for the dropdowns
        $clients = Client::all();
        $items = Item::all();

        return view('orders.create', compact('clients', 'items'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        try {
            // $validated = $request->validate([
            //     'clients_id' => 'required|exists:clients,id',
            //     'items_id' => 'required|exists:items,id',
            //     'quantity' => 'required|integer|min:1',
            //     'total_price' => 'required|numeric|min:0',
            //     'status' => 'required|string|in:pending,completed,canceled',
            // ]);

            $validatedData = $request->validate([
                'clients_id' => 'required|exists:clients,id',
                'items_id' => 'required|exists:items,id',
                'quantity' => 'required|numeric|min:1',
                'status' => 'required|string|in:pending,completed,canceled',
            ]);

            // Ambil item untuk pengecekan harga
            $item = Item::findOrFail($request->items_id);
            $totalPrice = $item->price * $request->quantity;

            // Buat order baru
            Order::create([
                'clients_id' => $request->clients_id,
                'items_id' => $request->items_id,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
                'status' => $request->status,
            ]);

            return redirect()->route('orders.index')
                ->with('success', 'Order successfully created!');

            // Order::create($validated);
            // return redirect()->route('orders.index')->with('success', 'Order successfully created!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal membuat order: ' . $e->getMessage())
                ->withInput();
            // return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $clients = Client::all();
        $items = Item::all();

        return view('orders.edit', compact('order', 'clients', 'items'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'clients_id' => 'required|exists:clients,id',
            'items_id' => 'required|exists:items,id',
            'quantity' => 'required|numeric',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order successfully updated!');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->route('orders.index')->with('success', 'Order successfully deleted!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete the order: ' . $e->getMessage());
        }
    }
}
