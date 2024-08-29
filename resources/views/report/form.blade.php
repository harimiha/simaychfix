@extends ('layout/layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('style/css/lapor_kerusakan.css')}}">
@section('content')
    <form action="{{route('report.store')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="position-absolute top-55 start-50 translate-middle formulir form-inline row">
        <h2 class="text-center mt-3 mb-3">FORMULIR KERUSAKAN <span>ASET</span></h2>
        @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}">
            {{ session('message')['desc'] }}
        </div>
        @endif

        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

        <hr>
        <div class="mb-3 col-sm-4">
            <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
            <input type="text" name="nama_pegawai" value="{{Auth::user()->name}}" class="form-control shadow" id="nama_pegawai" placeholder="Enter your name" required>
        </div>
        <div class="mb-3 col-sm-4">
            <label for="nomor_aset" class="form-label ">Nomor Aset</label>
            <input type="text" name="nomor_aset" class="form-control shadow " id="nomor_aset" placeholder="Enter asset number" required>
        </div>
        <div class="mb-3 col-sm-4">
            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
            <input type="date" name="tanggal_pengajuan" value="{{date('Y-m-d')}}" class="form-control shadow" id="tanggal_pengajuan" placeholder="Another input placeholder" required>
        </div>
        <div class="mb-0">
            <label for="deskripsi_kerusakan" class="form-label">Deskripsi Kerusakan</label>
            <textarea name="deskripsi_kerusakan" class="form-control shadow" id="deskripsi_kerusakan" rows="8" placeholder="Message" required></textarea>
        </div>
        <div class="mb-3 col-sm-4">
            <label for="foto" class="form-label">Dokumentasi (jpg, jpeg, png)</label>
            <input type="file" name="foto" class="form-control shadow" id="foto" placeholder="Another input placeholder" required>
        </div>
        <button type="submit" value="save" class="btn btn-primary col-md-12 mx-auto lapor-submit">Submit</button>
    </form>
</div>
@endsection
