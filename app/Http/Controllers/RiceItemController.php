<?php

namespace App\Http\Controllers;

use App\Models\RiceItem;
use Illuminate\Http\Request;

class RiceItemController extends Controller
{
    public function index()
    {
        $riceItems = RiceItem::latest()->paginate(10);
        return view('rice-items.index', compact('riceItems'));
    }

    public function create()
    {
        return view('rice-items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        RiceItem::create($request->all());

        return redirect()->route('rice-items.index')
            ->with('success', 'Rice item added successfully!');
    }

    public function edit(RiceItem $riceItem)
    {
        return view('rice-items.edit', compact('riceItem'));
    }

    public function update(Request $request, RiceItem $riceItem)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $riceItem->update($request->all());

        return redirect()->route('rice-items.index')
            ->with('success', 'Rice item updated successfully!');
    }

    public function destroy(RiceItem $riceItem)
    {
        $riceItem->delete();

        return redirect()->route('rice-items.index')
            ->with('success', 'Rice item deleted successfully!');
    }
}