@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Employee's Report</h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data ... ">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </section>

        <section class="table_body">
            @if (session('message'))
            <div class="alert alert-{{ session('message')['status'] }}">
                {{ session('message')['desc'] }}
            </div>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Item Tag</th>
                        <th>Report Date</th>
                        <th>Description</th>
                        <th>Dokumentasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$report->nama_pegawai}}
                    </td>
                    <td>{{$report->nomor_aset}}</td>
                    <td>{{$report->tanggal_pengajuan}}</td>
                    <td class="col-nama">
                        {{$report->deskripsi_kerusakan}}
                    </td>
                    <td>
                        @if ($report->foto)
                            <a href="{{Storage::url($report->foto)}}" target="_blank">
                                <img src="{{Storage::url($report->foto)}}" width="100" >
                            </a>
                        @endif
                    </td>
                    <td>
                        @if ($report->status == 0)
                            <p class="status pending">Laporan sedang ditinjau</p>
                        @elseif($report->status == 1)
                            <p class="status success">Laporan disetujui</p>
                        @else
                            <p class="status cancelled tooltip">Laporan ditolak
                                <span class="tooltiptext">{{$report->reason_reject}}</span>
                            </p>
                        @endif

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
