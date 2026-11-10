<!DOCTYPE html>
<html>
<head>
  <title>Admin - Kelola Kamar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <div class="d-flex justify-content-between">
    <h2>Admin - Kelola Kamar</h2>
    <a href="/" class="btn btn-outline-primary">Lihat sebagai Customer</a>
  </div>

  <div class="card card-body mt-3">
    <h5>Tambah Kamar</h5>
    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">@csrf
      <div class="row">
        <div class="col-md-4"><input type="text" name="name" placeholder="Nama: Deluxe / Superior / Standard" class="form-control" required></div>
        <div class="col-md-3"><input type="number" name="price" placeholder="Harga / malam" class="form-control" required></div>
        <div class="col-md-3"><input type="file" name="img" class="form-control"></div>
        <div class="col-md-2"><button class="btn btn-primary w-100">Tambah</button></div>
      </div>
    </form>
  </div>

  <table class="table table-bordered mt-4">
    <thead class="table-dark"><tr><th>Foto</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($rooms as $r)
        <tr>
          <td>@if($r->img) <img src="{{ asset('storage/'.$r->img) }}" width="80"> @else - @endif</td>
          <td>{{ $r->name }}</td>
          <td>Rp {{ number_format($r->price, 0, ',', '.') }}</td>
          <td>
            <form action="{{ route('admin.rooms.delete', $r->id) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</body>
</html>