@extends('templates.layout')

@push('style')
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f7f7f7;
            border-radius: 16px;
            width: 800px;
            margin: 20px auto;
            padding: 40px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .container .content {
            margin-bottom: 20px;
            text-align: center;
        }

        .container h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }

        .container p {
            font-size: 18px;
            /* Increased font size */
            line-height: 1.6;
            color: #666;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="content">
            <h1>Tentang</h1>
            <p>Selamat Datang di Cafe Smakzie</p>
            <p>Aplikasi ini memfasilitasi operasi kasir di sebuah restoran</p>
        </div>

        <div class="content">
            <h1>Layanan</h1>
            <p>Dengan fitur-fitur yang ada di aplikasi kami, kami bertujuan untuk memberikan kenyamanan dan mempermudah
                proses pembelian bagi pelanggan.</p>
        </div>

        <div class="content">
            <h1>Sejarah Pembuatan</h1>
            <p>Pembuatan aplikasi Cafe ini didasari oleh perkembangan teknologi yang semakin canggih dan era digital yang
                mengemuka. Kami menciptakan aplikasi ini untuk memfasilitasi proses pembelian dan meningkatkan pengalaman
                pelanggan.</p>
        </div>
    </div>
@endsection

@push('script')
@endpush
