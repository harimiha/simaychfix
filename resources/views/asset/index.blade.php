@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Asset's Report</h1>
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
                        <th>Asset Name</th>
                        <th>Asset Number</th>
                        <th>Asset Description</th>
                        <th>Invoice Number</th>
                        <th>Vendor Name</th>
                        <th>Resp Center</th>
                        <th>Date in Service</th>
                        <th>Depreciation Method</th>
                        <th>Life (M)</th>
                        <th>Cost</th>
                        <th>Residual</th>
                        <th>Depresiasi Tahunan</th>
                        <th>NBV</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($assets as $asset)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$asset->asset_name}}</td>
                    <td>{{$asset->asset_number}}</td>
                    <td>{{$asset->asset_description}}</td>
                    <td>{{$asset->invoice_number}}</td>
                    <td>{{$asset->vendor_name}}</td>
                    <td>{{$asset->resp_center}}</td>
                    <td>{{$asset->date_in_service}}</td>
                    <td>{{$asset->depreciation_method}}</td>
                    <td>{{$asset->life}}</td>
                    <td>{{number_format($asset->cost,0,',','.')}}</td>
                    <td>{{$asset->residual}}</td>
                    <td>{{$asset->depreciation_year}}</td>
                    <td>
                        <ol>
                            @foreach($asset->details as $detail)
                            <li>{{$detail->value}}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
