<!DOCTYPE html>
<html>
<head>
  <title>Berhasil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('template.nav')

<div class="container" style="max-width:600px">
  <div class="card card-body text-center">
    <h2 class="text-success">Reservation Berhasil!</h2>
    <table class="table text-start mt-3">
      <tr><td>Kamar</td><td>{{ $reservation->room->name }}</td></tr>
      <tr><td>Nama</td><td>{{ $reservation->user->name }}</td></tr>
      <tr><td>Tanggal</td><td>{{ $reservation->check_in }} s/d {{ $reservation->check_out }}</td></tr>
      <tr><td>Lama</td><td>{{ $reservation->nights }} malam</td></tr>
      <tr><td><b>Total</b></td><td><b>Rp {{ number_format($reservation->total, 0, ',', '.') }}</b></td></tr>
    </table>
    <a href="/history" class="btn btn-primary">Lihat Riwayat</a>
    <a href="/" class="btn btn-outline-secondary mt-2">Kembali ke Daftar Kamar</a>
  </div>
</div>
</body>
</html>