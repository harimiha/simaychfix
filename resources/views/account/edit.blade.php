@extends ('layout/layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('style/css/form_po.css')}}">
@section('content')
    <form action="{{route('account.update', $account->id)}}" method="POST">
        {{ csrf_field() }}
        <div class="position-absolute top-55 start-50 translate-middle formulir form-inline row">
        <h2 class="text-center mt-3 mb-3">EDIT DATA <span>ACCOUNT</span></h2>
        @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}">
            {{ session('message')['desc'] }}
        </div>
        @endif
        <hr>
        <div class="mb-4 col-sm-4">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" value="{{$account->name}}" class="form-control shadow" id="name" placeholder="Enter your name" required>
        </div>
        <div class="mb-4 col-sm-4">
            <label for="email" class="form-label ">Email</label>
            <input type="email" name="email" value="{{$account->email}}" class="form-control shadow " id="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-4 col-sm-4">
            <label for="username" class="form-label ">Username</label>
            <input type="text" name="username" value="{{$account->username}}" class="form-control shadow " id="username" placeholder="Enter your username" required>
        </div>
        <div class="mb-4 col-sm-4">
            <label for="password" class="form-label ">Password</label>
            <input type="text" name="password" class="form-control shadow " id="password" placeholder="Enter your password">
        </div>
        <div class="mb-3 col-sm-4">
            <label for="role_id" class="form-label ">Jabatan</label>
            <select class="form-control shadow" id="role_id" name="role_id" required>
                <option value="">Pilih Salah Satu</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{$account->role_id==$role->id? 'selected':''}}>{{$role->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" value="save" class="btn btn-primary col-md-12 mx-auto lapor-submit">Submit</button>
    </form>
</div>
@endsection
