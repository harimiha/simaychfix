@extends('layout/layout')
<link rel="stylesheet" href="{{asset('style/css/melihat_progress.css')}}">
<script src="{{asset('style/js/melihat_progress.js')}}"></script>
@section('content')
    <main class="table">
        <section class="table_header">
            <h1>Account's Report</h1>
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
                        <th>Email</th>
                        <th>Username</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($accounts as $account)
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td class="col-nama">
                        <img src="{{asset('style/assets/user.png')}}"/> {{$account->name}}
                    </td>
                    <td>{{$account->email}}</td>
                    <td>{{$account->username}}</td>
                    <td>{{$account->getRole?$account->getRole->name:'-'}}</td>
                    <td>
                        <a href="{{route('account.edit',$account->id)}}" class="icon">
                                <i class="fa-solid fa-pen-to-square" style="color:#27528b; padding: 0.3rem;"></i>
                        </a>
                        <a href="{{route('account.delete',$account->id)}}" class="icon">
                                <i class="fa fa-times " style="color:red; padding: 0.5rem;"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
