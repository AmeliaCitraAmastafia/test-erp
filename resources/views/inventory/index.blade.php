@extends('layouts.app')

@section('content')
<h1>Pencatatan Inventory</h1>

<div class="grid">
    <section class="span-5">
        <h2>Tambah Barang</h2>
        <form method="post" action="{{ route('inventory.items.store') }}">
            @csrf
            <div><label>SKU</label><input name="sku" required></div>
            <div><label>Nama Barang</label><input name="name" required></div>
            <div><label>Kategori</label><input name="category"></div>
            <div><label>Satuan</label><input name="unit" value="pcs" required></div>
            <div><label>Stok Minimum</label><input type="number" name="minimum_stock" min="0" value="0" required></div>
            <div><label>Stok Awal</label><input type="number" name="current_stock" min="0" value="0" required></div>
            <button type="submit">Simpan Barang</button>
        </form>
    </section>

    <section class="span-7">
        <h2>Catat Mutasi</h2>
        <form method="post" action="{{ route('inventory.movements.store') }}">
            @csrf
            <div><label>Barang</label>
                <select name="item_id" required>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->sku }} - {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div><label>Tipe</label><select name="type" required><option value="masuk">Masuk</option><option value="keluar">Keluar</option></select></div>
            <div><label>Jumlah</label><input type="number" name="quantity" min="1" required></div>
            <div><label>Referensi</label><input name="reference"></div>
            <div><label>Tanggal</label><input type="date" name="movement_date" value="{{ now()->toDateString() }}" required></div>
            <div><label>Catatan</label><textarea name="notes"></textarea></div>
            <button type="submit">Simpan Mutasi</button>
        </form>
    </section>

    <section class="span-12">
        <h2>Daftar Barang</h2>
        <table>
            <thead><tr><th>SKU</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Minimum</th><th>Status</th></tr></thead>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->sku }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category ?: '-' }}</td>
                    <td>{{ $item->current_stock }} {{ $item->unit }}</td>
                    <td>{{ $item->minimum_stock }} {{ $item->unit }}</td>
                    <td>{!! $item->current_stock <= $item->minimum_stock ? '<span class="danger">Perlu restock</span>' : '<span class="pill">Aman</span>' !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
