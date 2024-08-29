@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Purchase Order's Report</h1>
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
                        <th>No PO</th>
                        <th>PO Date</th>
                        <th>Total Amount</th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($purchaseOrders as $purchaseOrder)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$purchaseOrder->nama_procurement}}
                    </td>
                    <td>{{$purchaseOrder->nomor_po}}</td>
                    <td>{{$purchaseOrder->tanggal_po}}</td>
                    <td>{{number_format($purchaseOrder->total,0,',','.')}}</td>
                    <td>
                        <a href="{{route('po.pdf',$purchaseOrder->id)}}" target="_blank" style="text-decoration: none;">
                            <p class="status success">PDF</p>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
