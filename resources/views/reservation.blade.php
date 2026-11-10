<!DOCTYPE html>
<html>
<head>
  <title>Reservation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('template.nav')

<div class="container" style="max-width:600px">
  <a href="/">&larr; Kembali</a>
  <div class="card card-body mt-3">
    <h3>Reservation: {{ $room->name }}</h3>
    <p>Harga: Rp {{ number_format($room->price, 0, ',', '.') }}/malam</p>
    <p>Atas nama: <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->email }})</p>

    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if($errors->any())
      @foreach($errors->all() as $e) <div class="alert alert-danger">{{ $e }}</div> @endforeach
    @endif

    <form action="{{ route('reservation.store', $room->id) }}" method="POST">@csrf
      <div class="mb-3">
        <label>Check In</label>
        <input type="date" name="check_in" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Check Out</label>
        <input type="date" name="check_out" class="form-control" required>
      </div>
      <button class="btn btn-success w-100">Reservation</button>
    </form>
  </div>
</div>
</body>
</html>