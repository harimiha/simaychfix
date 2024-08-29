<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMA YCH Indonesia</title>
    <link rel="icon" href="{{asset('style/assets/YCH No BG.png')}}">
    <link rel="stylesheet" href="{{asset('style/css/navbar.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:wght@100;300;400;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <a href="{{route('dashboard')}}"><img class="logo" src="{{asset('style/assets/YCH No BG.png')}}" alt="ych-icon"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark" onclick="hideMenu()"></i>
                <ul class="navbar">
                    <li><a href="#home" class="active">HOME</a></li>
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                    @can('recording.menu')
                    <li class="dropdown" id="controllingDropdown">
                        <a href="#" class="dropbtn" id="dropbtnControlling">PENCATATAN</a>
                        <i class="fa-solid fa-caret-down"></i>
                        <div class="dropdown-content" id="dropdownContent">
                            @can('asset.index')
                                <a href="{{route('asset.index')}}" id="laporanDropdown">Melihat Database Aset</a>
                            @endcan
                            @can('asset.add')
                            <a href="{{route('asset.add')}}">Mengisi Asset Register</a>
                            @endcan
                        </div>
                    </li>
                    @endcan
                    @can('controlling.menu')
                    <li class="dropdown" id="controllingDropdown">
                        <a href="#" class="dropbtn" id="dropbtnControlling">CONTROLLING</a>
                        <i class="fa-solid fa-caret-down"></i>
                        <div class="dropdown-content" id="dropdownContent">
                            @can('reportasset.add')
                                <a href="{{route('reportasset.add')}}" id="laporanDropdown">Melaporkan Kerusakan Aset</a>
                            @endcan
                            @can('reportasset.check')
                                <a href="{{route('reportasset.check')}}" id="laporanDropdown">Menilai Kelayakan Aset</a>
                            @endcan
                            @can('reportasset.progress')
                                <a href="{{route('reportasset.progress')}}">Melihat Progress</a>
                            @endcan
                        </div>
                    </li>
                    @endcan
                    @can('procurement.menu')
                    <li class="dropdown" id="controllingDropdown">
                        <a href="#" class="dropbtn" id="dropbtnControlling">PENGADAAN</a>
                        <i class="fa-solid fa-caret-down"></i>
                        <div class="dropdown-content" id="dropdownContent">
                            @can('ph.submit')
                                <a href="{{route('ph.submit')}}" id="laporanDropdown">Mengajukan Proposal Harga</a>
                            @endcan
                            @can('review.index')
                                <a href="{{route('review.index')}}" id="laporanDropdown">Meninjau Proposal Harga</a>
                            @endcan
                            @can('ph.progress')
                                <a href="{{route('ph.progress')}}" id="laporanDropdown">Melihat Progress Pengajuan PH</a>
                            @endcan
                            @can('po.add')
                                <a href="{{route('po.add')}}">Membuat Purchase Order</a>
                            @endcan
                            @can('po.index')
                                <a href="{{route('po.index')}}">Melihat Purchase Order</a>
                            @endcan
                            @can('invoice.add')
                                <a href="{{route('invoice.add')}}">Mengunggah Invoice</a>
                            @endcan
                            @can('payment.index')
                                <a href="{{route('payment.index')}}">Pembayaran</a>
                            @endcan
                            @can('invoice.index')
                                <a href="{{route('invoice.index')}}">Melihat Progress Invoice</a>
                            @endcan
                            @can('summary.add')
                                <a href="{{route('summary.add')}}">Mengunggah Summary Quotation</a>
                            @endcan
                            @can('summary.index')
                                <a href="{{route('summary.index')}}">Melihat Summary Quotation</a>
                            @endcan
                        </div>
                    </li>
                    @endcan
                    <li class="dropdown" id="controllingDropdown">
                        <a href="#" class="dropbtn" id="dropbtnControlling">{{Auth::user()->name}}</a>
                        <i class="fa-solid fa-caret-down"></i>
                        <div class="dropdown-content" id="dropdownContent">
                            @can('account.add')
                            <a href="{{route('account.add')}}" id="laporanDropdown">Daftar Akun</a>
                            @endcan
                            @can('account.index')
                            <a href="{{route('account.index')}}" id="laporanDropdown">Database Akun</a>
                            @endcan
                            <a href="{{route('logout')}}" id="laporanDropdown">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
            <i class="fa-solid fa-bars" onclick="showMenu()"></i>
        </nav>

    </header>

    <section>
        @include('flash::message')
        @yield ('content')
    </section>

    <script src="https://kit.fontawesome.com/9d2abd8931.js" crossorigin="anonymous"></script>
    <script src="{{asset('style/js/navbar.js')}}"></script>
    <!-- <p>&copy; 2024 YCH Group. All Rights Reserved.</p> -->
</body>

</html>
