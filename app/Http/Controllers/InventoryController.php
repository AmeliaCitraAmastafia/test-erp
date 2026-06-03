<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function index(): View
    {
        return view('inventory.index', [
            'items' => Item::query()->latest()->get(),
            'movements' => StockMovement::query()->with('item')->latest()->limit(15)->get(),
        ]);
    }

    public function storeItem(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:50', 'unique:items,sku'],
            'name' => ['required', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'unit' => ['required', 'string', 'max:30'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
            'current_stock' => ['required', 'integer', 'min:0'],
        ]);

        Item::create($data);

        return back()->with('status', 'Barang berhasil ditambahkan.');
    }

    public function storeMovement(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'item_id' => ['required', 'exists:items,id'],
            'type' => ['required', 'in:masuk,keluar'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reference' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:500'],
            'movement_date' => ['required', 'date'],
        ]);

        DB::transaction(function () use ($data): void {
            $item = Item::query()->lockForUpdate()->findOrFail($data['item_id']);
            $delta = $data['type'] === 'masuk' ? $data['quantity'] : -$data['quantity'];

            $item->update([
                'current_stock' => max(0, $item->current_stock + $delta),
            ]);

            StockMovement::create($data);
        });

        return back()->with('status', 'Mutasi stok berhasil dicatat.');
    }
}
