@extends ('layout/layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('style/css/lapor_kerusakan.css')}}">
@section('content')
    <form action="{{route('ph.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="position-absolute top-55 start-50 translate-middle formulir form-inline row">
        <h2 class="text-center mt-3 mb-3">FORMULIR PENGAJUAN PROPOSAL <span>HARGA</span></h2>
        @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}">
            {{ session('message')['desc'] }}
        </div>
        @endif
        <hr>
        <div class="mb-3 col-sm-4">
            <label for="nama_procurement" class="form-label">Nama Procurement</label>
            <input type="text" name="nama_procurement" value="{{Auth::user()->name}}" class="form-control shadow" id="nama_procurement" placeholder="Enter your name" required>
        </div>
        <div class="mb-3 col-sm-4">
            <label for="nomor_aset" class="form-label ">Nomor Aset</label>
            <input type="text" name="nomor_aset" class="form-control shadow " id="nomor_aset" placeholder="Enter asset number" required>
        </div>
        <div class="mb-3 col-sm-4">
            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
            <input type="date" name="tanggal_pengajuan" value="{{date('Y-m-d')}}" class="form-control shadow" id="tanggal_pengajuan" placeholder="Another input placeholder" required>
        </div>
        <div class="mb-3 col-sm-4">
            <label for="doc" class="form-label">Unggah Dokumen (pdf)</label>
            <input type="file" name="doc" class="form-control shadow" id="doc" accept="application/pdf" placeholder="Another input placeholder" required>
        </div>
        <button type="submit" value="save" class="btn btn-primary col-md-12 mx-auto lapor-submit">Submit</button>
    </form>
</div>
@endsection
