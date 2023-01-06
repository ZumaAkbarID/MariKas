@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row mb-3">
                <div class="col-sm-12 col-lg-6">
                    <div class="card bg-primary p-4 mb-2 rounded">
                        Total Penarikan <br>
                        {{ number_format($data['data']->count(), 0, ',', '.') }}x
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="card bg-primary p-4 mb-2 rounded">
                        Total Nominal <br>
                        Rp. {{ number_format($data['totalAmount'], 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-4 mb-3">
                    <div class="card bg-white text-black rounded p-4 shadow-sm">
                        <div class="card-title">
                            Formulir Penarikan
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" id="form-penarikan">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="amount">Nominal</label>
                                    <input type="text" name="amount" id="amount" required class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="purpose">Alasan Penarikan</label>
                                    <textarea name="purpose" id="purpose" rows="6" maxlength="255" class="form-control" required></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="cashout_proof">Bukti Penarikan</label>
                                    <input type="file" name="cashout_proof" id="cashout_proof" required
                                        class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="datetime">Tanggal Ditarik</label>
                                    <input type="datetime-local" name="datetime" id="datetime" required
                                        class="form-control">
                                </div>
                                <button type="submit" class="d-none"></button>

                            </form>

                            <div class="form-group">
                                <div class="row justify-content-end">
                                    <button type="button" onclick="submit()" class="btn btn-info"
                                        style="width: 150px;margin-right: 12px">Simpan
                                        Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-8">
                    <div class="card bg-white text-black rounded p-4 shadow-sm">
                        <div class="card-title">
                            Data Penarikan
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <td>Nama Pendata</td>
                                        <td>Nominal</td>
                                        <td>Alasan</td>
                                        <td>Bukti Penarikan</td>
                                        <td>Tanggal Ditarik</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['data'] as $data)
                                        <tr>
                                            <td>{{ $data->user->name }}</td>
                                            <td>Rp. {{ number_format($data->amount, 0, ',', '.') }}</td>
                                            <td>{{ $data->purpose }}</td>
                                            <td>
                                                <img src="{{ asset('storage') }}/{{ $data->cashout_proof }}" width="200">
                                            </td>
                                            <td>{{ $data->datetime }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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
