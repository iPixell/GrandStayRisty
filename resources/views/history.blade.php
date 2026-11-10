<!DOCTYPE html>
<html>
<head>
  <title>Riwayat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('template.nav')

<div class="container">
  <h2>Riwayat Reservation</h2>
  <table class="table table-bordered mt-3">
    <thead class="table-dark">
      <tr><th>Nama</th><th>Kamar</th><th>Tanggal</th><th>Lama</th><th>Total</th></tr>
    </thead>
    <tbody>
      @forelse($reservations as $r)
        <tr>
          <td>{{ $r->user->name }}</td>
          <td>{{ $r->room->name }}</td>
          <td>{{ $r->check_in }} s/d {{ $r->check_out }}</td>
          <td>{{ $r->nights }} malam</td>
          <td>Rp {{ number_format($r->total, 0, ',', '.') }}</td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center">Belum ada reservation</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
</body>
</html>