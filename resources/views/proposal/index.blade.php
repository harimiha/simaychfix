@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Proposal's Report</h1>
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
                        <th>Dokumen</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($proposals as $proposal)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$proposal->nama_procurement}}
                    </td>
                    <td>{{$proposal->nomor_aset}}</td>
                    <td>{{$proposal->tanggal_pengajuan}}</td>
                    <td>
                        @if ($proposal->doc)
                            <a href="{{Storage::url($proposal->doc)}}" target="_blank" style="text-decoration:none;">
                                <p class="status success">Link</p>
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="circle-container">
                            <div class="circle approve">
                                1
                            </div>
                            <p>PRO</p>
                        </div>
                        <div class="circle-container">
                            <div class="circle {{$proposal->status==2?'reject tooltip' : ($proposal->status==1 || $proposal->status==3 || $proposal->status==4 ? 'approve':'waiting')}}">
                                2
                                @if($proposal->status==2)
                                <span class="tooltiptext">{{$proposal->reason_reject}}</span>
                                @endif
                            </div>
                            <p>HOD</p>
                        </div>
                        @if($proposal->status==1 || $proposal->status==3 || $proposal->status==4)
                        <div class="circle-container">
                            <div class="circle {{$proposal->status==4?'reject tooltip' : ($proposal->status==3? 'approve':'waiting')}}">
                                3
                                @if($proposal->status==4)
                                <span class="tooltiptext">{{$proposal->reason_reject}}</span>
                                @endif
                            </div>
                            <p>CGM</p>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
