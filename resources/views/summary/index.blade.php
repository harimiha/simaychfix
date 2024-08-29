@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Summary's Report</h1>
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
                        <th>Date</th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($summaries as $summary)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$summary->nama_adminAset}}
                    </td>
                    <td>{{$summary->tanggal_summary}}</td>
                    <td>
                        @if ($summary->file)
                            <a href="{{Storage::url($summary->file)}}" target="_blank" style="text-decoration:none">
                                <p class="status success">Link</p>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
