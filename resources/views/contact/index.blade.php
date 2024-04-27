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

        .map-container {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        /* Style for form */
        form {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        form textarea {
            resize: vertical;
            height: 120px;
        }

        form button {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="content">
            <h1>Contact Us</h1>
            <p>Alamat Lengkap:</p>
            <p>Jl. Contoh No. 123, Kota Anda, Provinsi Anda</p>
            <img src="{{ asset('storage') }}/menu-image/knator.jpeg">
        </div>

        <div class="map-container">
            <iframe width="100%" height="100%" frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31692.540964439082!2d107.13768544999999!3d-6.82232285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6852f4f71b004b%3A0x401e8f1fc28dad0!2sCianjur%2C%20Kec.%20Cianjur%2C%20Kabupaten%20Cianjur%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1713856068503!5m2!1sid!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
            </iframe>
        </div>

        <div class="content">
            <h2>Form Pertanyaan</h2>
            <form method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pertanyaan:</label>
                    <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
@endpush
