@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Invoice's Report</h1>
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
                        <th>Nomor Inv</th>
                        <th>Report Date</th>
                        <th>Keterangan</th>
                        <th>Dokumen Invoice</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($invoices as $invoice)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$invoice->nama_procurement}}
                    </td>
                    <td>{{$invoice->nomor_invoice}}</td>
                    <td>{{$invoice->tanggal_invoice}}</td>
                    <td>{{$invoice->keterangan}}</td>
                    <td>
                        @if ($invoice->file)
                            <a href="{{Storage::url($invoice->file)}}" target="_blank" style="text-decoration:none">
                                <p class="status success">Link</p>
                            </a>
                        @endif
                    </td>
                    <td>
                        @if ($invoice->proof)
                            <a href="{{Storage::url($invoice->proof)}}" target="_blank" style="text-decoration:none">
                                <p class="status success">Link</p>
                            </a>
                        @endif
                    </td>
                    <td>
                        @if ($invoice->status == 0)
                            <p class="status pending">Menunggu Pembayaran</p>
                        @elseif($invoice->status == 1)
                            <p class="status success">Invoice telah dibayar</p>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
