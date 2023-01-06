@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row mb-3">
                <div class="col-sm-12 col-lg-4">
                    <div class="card bg-primary p-4 mb-2 rounded">
                        Terbayar <br>
                        Rp. {{ number_format($data['money_paid'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card bg-primary p-4 mb-2 rounded">
                        Proses <br>
                        Rp. {{ number_format($data['money_unpaid'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card bg-primary p-4 mb-2 rounded">
                        Kadaluarsa <br>
                        Rp. {{ number_format($data['money_expired'], 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="card bg-white text-black rounded p-4 shadow-sm mb-3">
                <div class="card-title">
                    Data Terbayar
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>Kode</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>WA</td>
                                <td>Metode</td>
                                <td>Bulan</td>
                                <td>Brp Minggu</td>
                                <td>Nominal</td>
                                <td>URL</td>
                                <td>Waktu, Tgl</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @if (is_null($data['paid']))
                                <tr>
                                    <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @else
                                @foreach ($data['paid'] as $data)
                                    <tr>
                                        <td>{{ $data->merchant_ref }}</td>
                                        <td>{{ $data->customer_name }}</td>
                                        <td>{{ $data->customer_email }}</td>
                                        <td>{{ $data->customer_phone }}</td>
                                        <td>{{ $data->method }}</td>
                                        <td>{{ $month[$data->month - 1] }}</td>
                                        <td>{{ $data->week }}</td>
                                        <td>Rp. {{ number_format($data->amount, 0, ',', '.') }}</td>
                                        <td><a href="{{ $data->checkout_url }}" target="_blank" rel="Marikas">LINK</a>
                                        </td>
                                        <td>{{ $data->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card bg-white text-black rounded p-4 shadow-sm mb-3">
                <div class="card-title">
                    Data Proses
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>Kode</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>WA</td>
                                <td>Metode</td>
                                <td>Bulan</td>
                                <td>Brp Minggu</td>
                                <td>Nominal</td>
                                <td>URL</td>
                                <td>Waktu, Tgl</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @if (is_null($data['unpaid']))
                                <tr>
                                    <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @else
                                @foreach ($data['unpaid'] as $data)
                                    <tr>
                                        <td>{{ $data->merchant_ref }}</td>
                                        <td>{{ $data->customer_name }}</td>
                                        <td>{{ $data->customer_email }}</td>
                                        <td>{{ $data->customer_phone }}</td>
                                        <td>{{ $data->method }}</td>
                                        <td>{{ $month[$data->month - 1] }}</td>
                                        <td>{{ $data->week }}</td>
                                        <td>Rp. {{ number_format($data->amount, 0, ',', '.') }}</td>
                                        <td><a href="{{ $data->checkout_url }}" target="_blank" rel="Marikas">LINK</a>
                                        </td>
                                        <td>{{ $data->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card bg-white text-black rounded p-4 shadow-sm mb-3">
                <div class="card-title">
                    Data Kadaluarsa
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>Kode</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>WA</td>
                                <td>Metode</td>
                                <td>Bulan</td>
                                <td>Brp Minggu</td>
                                <td>Nominal</td>
                                <td>URL</td>
                                <td>Waktu, Tgl</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @if (is_null($data['expired']))
                                <tr>
                                    <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @else
                                @foreach ($data['expired'] as $data)
                                    <tr>
                                        <td>{{ $data->merchant_ref }}</td>
                                        <td>{{ $data->customer_name }}</td>
                                        <td>{{ $data->customer_email }}</td>
                                        <td>{{ $data->customer_phone }}</td>
                                        <td>{{ $data->method }}</td>
                                        <td>{{ $month[$data->month - 1] }}</td>
                                        <td>{{ $data->week }}</td>
                                        <td>Rp. {{ number_format($data->amount, 0, ',', '.') }}</td>
                                        <td><a href="{{ $data->checkout_url }}" target="_blank" rel="Marikas">LINK</a>
                                        </td>
                                        <td>{{ $data->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('app_js')
    <script>
        $(document).ready(function() {
            if (sessionStorage.getItem("cashout-warning") !== 'true') {
                sessionStorage.setItem("cashout-warning", "true");
                Swal.fire({
                    title: 'Perhatian!',
                    text: "Berhati-hatilah saat melakukan input/perubahan data, pastikan double check. Karena data yang telah dirubah/diinputkan tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Mengerti',
                });
            }
        });

        $('#amount').on('keydown keyup', function(e) {
            var regExp = /[a-zA-Z]/g;
            var input = String.fromCharCode(e.which) || e.key;

            if (regExp.test(input)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nominal hanya boleh mengandung angka!',
                });
                return false;
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function submit() {
            Swal.fire({
                title: 'Periksa Lagi',
                text: "Apakah Anda yakin melakukan input ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-penarikan').submit();
                }
            })
        }
    </script>
@endsection
