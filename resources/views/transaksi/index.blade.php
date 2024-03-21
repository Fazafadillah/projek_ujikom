@extends('templates.layout')

@push('style')
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-column-gap: 20px;
        }

        .menu-container,
        .order-container {
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 10px;
        }

        .menu-container {
            grid-column: 1;
        }

        .order-container {
            grid-column: 2;
            height: 500px;
            overflow-y: auto;
        }



        .menu-container ul,
        .order-container ul {
            list-style-type: none;
            padding: 0;
        }

        .menu-container li,
        .order-container li {
            margin-bottom: 20px;
        }

        .menu-container li h3,
        .order-container h2 {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            background-color: #e91e63;
            color: black;
            border-radius: 5px;
            padding: 5px 15px;
        }

        .bayar {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            color: black;
            border-radius: 5px;
            padding: 5px 15px;
            position: absolute;
            top: 76%;
            /* Menempel pada bagian bawah order-container */
            right: 38%;
            /* Menempatkan di sepanjang kanan container */
            margin-top: 20px;
            /* Menyesuaikan jarak dari order-container */
        }

        .bayar button {
            margin: 10px
        }

        .menu-item,
        .ordered-list {
            list-style-type: none;
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
            margin: 10px 0;
        }

        .menu-item li,
        .ordered-list li {
            background-color: transparent;
            /* border-radius: 5px;color: #ced4da;  padding: 10px 20px; */
        }

        .ordered-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .ordered-list li button {
            padding: 5px 10px;
            border: none;
            background-color: #e91e63;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .ordered-list li input {
            width: 50px;
            text-align: center;
        }

        /* Tambahkan gaya untuk item baru yang ditambahkan ke daftar pesanan */
        .ordered-list-item.new-item {
            background-color: #fff;
            /* Ganti latar belakang dengan warna putih */
            border: 1px solid #ced4da;
            /* Tambahkan border */
            border-radius: 5px;
            /* Tambahkan border-radius */
            color: black;
            /* Gunakan warna teks default */
            padding: 10px;
            /* Tambahkan padding */
            margin-bottom: 10px;
            /* Tambahkan margin bottom */
            display: flex;
            /* Gunakan display flex */
            align-items: center;
            /* Pusatkan item secara vertikal */
        }

        .ordered-list-item.new-item h3 {
            margin: 0;
            /* Hapus margin */
            flex: 1;
            /* Menyesuaikan ukuran agar fleksibel */
        }

        .ordered-list-item.new-item button {
            padding: 5px 10px;
            margin-left: 10px;
            /* Tambahkan margin kiri */
        }

        .ordered-list-item.new-item .qty-item {
            width: 50px;
            text-align: center;
            margin: 0 10px;
            /* Tambahkan margin di sekitar input */
        }

        .ordered-list-item.new-item .subtotal {
            margin-left: auto;
            /* Posisikan subtotal ke ujung kanan */
        }

        .remove-item {
            margin: 10px;
        }

        .qty-item {
            margin: 10px;
        }

        .btn-inc {
            margin: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container ">
        <div class="menu-container">
            <ul>
                @foreach ($jenis as $p)
                    <li>
                        <h3>{{ $p->jenis }}</h3>
                        <ul class="menu-item">
                            @foreach ($p->menu as $menu)
                                <div class="card text-center" style="width: 150px;">
                                    <div class="card-body d-flex justify-content-center align-items-center"
                                        style="height: 120px;">
                                        <img src="{{ asset('storage/menu-image/' . $menu->image) }}"
                                            class="card-img-top rounded-circle" style="width: 100px; height: 100px;">
                                    </div>
                                    <div class="card-body">
                                        <li class="margin: 5px;" data-harga="{{ $menu->harga }}"
                                            data-id="{{ $menu->id }}">
                                            <h6>{{ $menu->name }}</h6>
                                        </li>
                                    </div>
                                </div>
                    </li>
                @endforeach
            </ul>
            </li>
            @endforeach
            </ul>
        </div>

        <div class="order-container position-relative">
            <h2>Order Menu</h2>
            <ul class="ordered-list">
                <!-- Isi Order Menu -->
            </ul>
            Total : <h3 id="total">0</h3>
        </div>

        <div class="bayar">
            <div class="card-footer">
                <button class="btn btn-primary btn-sm" id="bayarBtn">Bayar</button>
                {{-- <span id="totalBayar"></span> --}}
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(function() {
            // Inisialisasi
            const orderedList = [];
            let total = 0;

            const sum = () => {
                return orderedList.reduce((accumulator, object) => {
                    return accumulator + (object.harga * object.qty);
                }, 0);
            };

            const changeQty = (el, inc) => {
                // Ubah di array
                const id = $(el).closest('li')[0].dataset.id;
                const index = orderedList.findIndex(list => list.menu_id == id);
                orderedList[index].qty += orderedList[index].qty == 1 && inc == -1 ? 0 : inc;

                // Ubah qty dan ubah subtotal

                const txt_subtotal = $(el).closest('li').find('.subtotal')[0];
                const txt_qty = $(el).closest('li').find('.qty-item')[0];
                txt_qty.value = parseInt(txt_qty.value) == 1 && inc == -1 ? 1 : parseInt(txt_qty.value) + inc;
                txt_subtotal.innerHTML = orderedList[index].harga * orderedList[index].qty;

                // Ubah jumlah total
                $('#total').html(sum());
            };

            // Events
            $('.ordered-list').on('click', '.btn-dec', function() {
                changeQty(this, -1);
            });

            $('.ordered-list').on('click', '.btn-inc', function() {
                changeQty(this, 1); // Perbaiki parameter di sini
            });

            $('.ordered-list').on('click', '.remove-item', function() {
                const item = $(this).closest('li')[0];
                let index = orderedList.findIndex(list => list.id == parseInt(item.dataset.id));
                orderedList.splice(index, 1);
                $(this).closest('li').remove(); // Perbaiki pemanggilan remove
                $('#total').html(sum());
            });

            $('#bayarBtn').on('click', function() {
                $.ajax({
                    url: "{{ route('transaksi.store') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "orderedList": orderedList,
                        "total": sum()
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status) {
                            Swal.fire({
                                title: data.message,
                                showDenyButton: true,
                                confirmButtonText: "Cetak Nota",
                                denyButtonText: `OK`,
                                showCloseButton: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open("{{ url('nota') }}/" + data.notrans);
                                    location.reload();
                                } else if (result.isDenied) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire('Pemesanan Gagal!', '', 'error');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        Swal.fire('Pemesanan Gagal!', '', 'error');
                    }
                });
            });

            $(".menu-item .card li").click(function() {
                // Mengambil data
                const menu_clicked = $(this).text();
                const data = $(this)[0].dataset;
                const harga = parseFloat(data.harga);
                const id = parseInt(data.id);

                if (orderedList.every(list => list.menu_id !== id)) {
                    let dataN = {
                        'menu_id': id,
                        'menu': menu_clicked,
                        'harga': harga,
                        'qty': 1
                    };
                    orderedList.push(dataN);
                    let listOrder =
                        `<li  data-id="${id}"><div><h6>${menu_clicked}</h6></div>`;
                    listOrder += `Sub Total : Rp. ${harga}`;
                    listOrder += `<button class='remove-item'>hapus</button>
                           <button class="btn-dec"> - </button>`;
                    listOrder += `<input class="qty-item"
                                  type="number"
                                  value="1"
                                  style="width:35px"
                                  readonly
                              />
                              <button class="btn-inc">+</button><h2>
                              <span class="subtotal">${harga * 1}</span>
                          </li>`;
                    $('.ordered-list').append(listOrder);
                }
                $('#total').html(sum());
            });
        });
    </script>
@endpush
