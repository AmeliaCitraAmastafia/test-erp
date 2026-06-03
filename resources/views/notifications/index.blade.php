@extends('layouts.app')

@section('content')
<h1>Notif dan Komunikasi</h1>

<div class="grid">
    <section class="span-5">
        <h2>Kirim Pesan</h2>
        <form method="post" action="{{ route('notifications.store') }}">
            @csrf
            <div><label>Channel</label><select name="channel" required><option value="internal">Internal</option><option value="email">Email</option><option value="whatsapp">WhatsApp</option></select></div>
            <div><label>Penerima</label><input name="recipient" required></div>
            <div><label>Subjek</label><input name="subject" required></div>
            <div><label>Pesan</label><textarea name="message" required></textarea></div>
            <button type="submit">Antrekan Pesan</button>
        </form>
    </section>

    <section class="span-7">
        <h2>Stok Perlu Notifikasi</h2>
        <table>
            <thead><tr><th>SKU</th><th>Barang</th><th>Stok</th><th>Minimum</th></tr></thead>
            <tbody>
            @foreach ($lowStockItems as $item)
                <tr>
                    <td>{{ $item->sku }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="danger">{{ $item->current_stock }} {{ $item->unit }}</td>
                    <td>{{ $item->minimum_stock }} {{ $item->unit }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

    <section class="span-12">
        <h2>Riwayat Komunikasi</h2>
        <table>
            <thead><tr><th>Waktu</th><th>Channel</th><th>Penerima</th><th>Subjek</th><th>Status</th></tr></thead>
            <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td><span class="pill">{{ $message->channel }}</span></td>
                    <td>{{ $message->recipient }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>{{ $message->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection
