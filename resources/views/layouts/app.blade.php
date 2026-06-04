<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Arial, Helvetica, sans-serif;
            --ink: #172026;
            --muted: #66727d;
            --line: #d8dee4;
            --panel: #ffffff;
            --page: #f5f7f8;
            --accent: #176b87;
            --ok: #147d4f;
            --warn: #b45309;
        }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: var(--page); }
        header { background: #ffffff; border-bottom: 1px solid var(--line); }
        .wrap { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; min-height: 64px; }
        .brand { font-size: 18px; font-weight: 700; }
        nav, .account { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
        nav a { color: var(--ink); text-decoration: none; padding: 8px 10px; border: 1px solid var(--line); border-radius: 6px; background: #fff; }
        .account { justify-content: flex-end; }
        .account form { display: inline; }
        .account-name { color: var(--muted); font-size: 13px; }
        main { padding: 24px 0 40px; }
        h1 { font-size: 26px; margin: 0 0 18px; }
        h2 { font-size: 18px; margin: 0 0 12px; }
        .grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 16px; }
        .span-4 { grid-column: span 4; }
        .span-5 { grid-column: span 5; }
        .span-7 { grid-column: span 7; }
        .span-8 { grid-column: span 8; }
        .span-12 { grid-column: span 12; }
        section, .card { background: var(--panel); border: 1px solid var(--line); border-radius: 8px; padding: 16px; }
        label { display: block; font-size: 13px; color: var(--muted); margin-bottom: 6px; }
        input, select, textarea { width: 100%; border: 1px solid var(--line); border-radius: 6px; padding: 10px; font: inherit; background: #fff; }
        textarea { min-height: 96px; resize: vertical; }
        form { display: grid; gap: 12px; }
        button, .button { border: 0; border-radius: 6px; background: var(--accent); color: #fff; padding: 10px 14px; font-weight: 700; cursor: pointer; text-decoration: none; display: inline-block; }
        .button.secondary { background: #3d4f5c; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th, td { border-bottom: 1px solid var(--line); padding: 10px; text-align: left; vertical-align: top; }
        th { color: var(--muted); font-weight: 700; }
        .status { margin-bottom: 16px; padding: 10px 12px; border: 1px solid #9bd4b6; color: var(--ok); background: #eefaf3; border-radius: 6px; }
        .pill { display: inline-block; border-radius: 999px; padding: 3px 8px; font-size: 12px; background: #edf2f7; }
        .danger { color: var(--warn); font-weight: 700; }
        .muted { color: var(--muted); }
        @media (max-width: 860px) {
            .span-4, .span-5, .span-7, .span-8 { grid-column: span 12; }
            .topbar { align-items: flex-start; flex-direction: column; padding: 14px 0; }
        }
        @media print {
            header, .no-print { display: none; }
            body { background: #fff; }
            main { padding: 0; }
            .wrap { width: 100%; }
            section { border: 0; padding: 0; }
        }
    </style>
</head>
<body>
<header>
    <div class="wrap topbar">
        <div class="brand">{{ config('app.name') }} / {{ strtoupper(config('app.service_role')) }}</div>
        <nav>
            <a href="{{ route('inventory.index') }}">Pencatatan</a>
            <a href="{{ route('reports.index') }}">Cetak Laporan</a>
            <a href="{{ route('notifications.index') }}">Notif & Komunikasi</a>
        </nav>
        <div class="account">
            @auth
                <span class="account-name">{{ auth()->user()->name }}</span>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="secondary">Logout</button>
                </form>
            @else
                <a class="button" href="{{ route('login') }}">Login Google</a>
            @endauth
        </div>
    </div>
</header>
<main>
    <div class="wrap">
        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif
        @yield('content')
    </div>
</main>
</body>
</html>
