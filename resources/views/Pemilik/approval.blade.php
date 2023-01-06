@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row mb-3">
                <div class="col-sm-12 col-lg-4">
                    <div class="card bg-primary p-4 mb-2 rounded">
                        Preview <br>
                        {{ number_format($data['preview']->count(), 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card bg-info p-4 mb-2 rounded">
                        Approved <br>
                        {{ number_format($data['approved']->count(), 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card bg-warning p-4 mb-2 rounded">
                        Rejected <br>
                        {{ number_format($data['rejected']->count(), 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="card bg-white text-black rounded p-4 mb-3">
                <div class="card-title">
                    Butuh Approval
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>WhatsApp</td>
                                <td>Bulan</td>
                                <td>Berapa Minggu</td>
                                <td>Jumlah</td>
                                <td>Bukti</td>
                                <td>Waktu, Tgl</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @forelse ($data['preview'] as $prev)
                                <tr>
                                    <td>{{ $prev->name }}</td>
                                    <td>{{ $prev->phone_number }}</td>
                                    <td>{{ $month[$prev->month - 1] }}</td>
                                    <td>{{ $prev->week }}</td>
                                    <td>Rp. {{ number_format($prev->amount, 0, ',', '.') }}</td>
                                    <td>
                                        <img src="{{ asset('storage') }}/{{ $prev->payment_proof }}" width="200">
                                    </td>
                                    <td>{{ $prev->created_at }}</td>
                                    <td>
                                        <button onclick="approve('{{ $prev->trx_code }}')"
                                            class="border-0 badge bg-success" title="Terima"><i
                                                class='bx bxs-check-square'></i></button> |
                                        <button onclick="reject('{{ $prev->trx_code }}')" class="border-0 badge bg-danger"
                                            title="Tolak"><i class='bx bx-x'></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card bg-white text-black rounded p-4 mb-3">
                <div class="card-title">
                    Approved
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>Diterima Oleh</td>
                                <td>WhatsApp</td>
                                <td>Bulan</td>
                                <td>Berapa Minggu</td>
                                <td>Jumlah</td>
                                <td>Bukti</td>
                                <td>Waktu, Tgl</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @forelse ($data['approved'] as $appr)
                                <tr>
                                    <td>{{ $appr->name }}</td>
                                    <td>{{ $appr->user->name }}</td>
                                    <td>{{ $appr->phone_number }}</td>
                                    <td>{{ $month[$appr->month - 1] }}</td>
                                    <td>{{ $appr->week }}</td>
                                    <td>Rp. {{ number_format($appr->amount, 0, ',', '.') }}</td>
                                    <td>
                                        <img src="{{ asset('storage') }}/{{ $appr->payment_proof }}" width="200">
                                    </td>
                                    <td>{{ $appr->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card bg-white text-black rounded p-4 mb-3">
                <div class="card-title">
                    Rejected
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <td>Nama</td>
                                <td>Ditolak Oleh</td>
                                <td>WhatsApp</td>
                                <td>Bulan</td>
                                <td>Berapa Minggu</td>
                                <td>Jumlah</td>
                                <td>Bukti</td>
                                <td>Waktu, Tgl</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            @forelse ($data['rejected'] as $reject)
                                <tr>
                                    <td>{{ $reject->name }}</td>
                                    <td>{{ $reject->user->name }}</td>
                                    <td>{{ $reject->phone_number }}</td>
                                    <td>{{ $month[$reject->month - 1] }}</td>
                                    <td>{{ $reject->week }}</td>
                                    <td>Rp. {{ number_format($reject->amount, 0, ',', '.') }}</td>
                                    <td>
                                        <img src="{{ asset('storage') }}/{{ $reject->payment_proof }}" width="200">
                                    </td>
                                    <td>{{ $reject->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
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
            if (sessionStorage.getItem("approve-warning") !== 'true') {
                sessionStorage.setItem("approve-warning", "true");
                Swal.fire({
                    title: 'Perhatian!',
                    text: "Berhati-hatilah saat melakukan perubahan data, pastikan double check. Karena data yang telah dirubah tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Mengerti',
                });
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function approve(code) {
            Swal.fire({
                title: 'Periksa Lagi',
                text: "Apakah Anda yakin pembayaran ini valid?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Valid',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('Pemilik_Ajax_Approve') }}",
                        data: {
                            code: code
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: 'Yay...',
                                    text: data.msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops...',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            })
        }

        function reject(code) {
            Swal.fire({
                title: 'Periksa Lagi',
                text: "Apakah Anda yakin menolak pembayaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('Pemilik_Ajax_Reject') }}",
                        data: {
                            code: code
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: 'Yay...',
                                    text: data.msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops...',
                                    text: data.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Okey',
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
