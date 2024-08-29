@extends ('layout/layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('style/css/form_po.css')}}">
@section('content')
    <form action="{{route('account.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="position-absolute top-55 start-50 translate-middle formulir form-inline row">
        <h2 class="text-center mt-3 mb-3">FORMULIR DAFTAR <span>ACCOUNT</span></h2>
        @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}">
            {{ session('message')['desc'] }}
        </div>
        @endif
        <hr>
        <div class="mb-4 col-sm-4">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" value="" class="form-control shadow" id="name" placeholder="Enter your name" required>
        </div>
        <div class="mb-4 col-sm-4">
            <label for="email" class="form-label ">Email</label>
            <input type="email" name="email" class="form-control shadow " id="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-4 col-sm-4">
            <label for="username" class="form-label ">Username</label>
            <input type="text" name="username" class="form-control shadow " id="username" placeholder="Enter your username" required>
        </div>
        <div class="mb-4 col-sm-4">
            <label for="password" class="form-label ">Password</label>
            <input type="password" name="password" class="form-control shadow " id="password" placeholder="Enter your password" required>
            <i class="fa fa-eye-slash" id="tooglePassword"></i>
        </div>
        <div class="mb-3 col-sm-4">
            <label for="role_id" class="form-label ">Jabatan</label>
            <select class="form-control shadow" id="role_id" name="role_id" required>
                <option value="">Pilih Salah Satu</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" value="save" class="btn btn-primary col-md-12 mx-auto lapor-submit">Submit</button>
    </form>
</div>

<script>
    const tooglePassword = document.querySelector('#tooglePassword');
    const password = document.querySelector('#password');
    tooglePassword.addEventListener('click', (e) => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Mengganti ikon
        e.target.classList.toggle('fa-eye'); // Perbaikan penulisan di sini
        e.target.classList.toggle('fa-eye-slash'); // Mengganti ikon sesuai dengan kondisi
    });
</script>
@endsection
