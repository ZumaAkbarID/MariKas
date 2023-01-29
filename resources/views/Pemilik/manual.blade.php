@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-lg-6">
                    <div class="card bg-white rounded p-4">
                        <div class="card-content">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group my-3">
                                    <label for="name">Nama</label>
                                    <select name="name" id="name" required
                                        class="form-control @if ($errors->has('name')) is-invalid @endif">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($users as $u)
                                            <option value="{{ $u->name }}" data-phone="{{ $u->phone_number }}"
                                                @if (old('name') == $u->name) selected @endif>{{ $u->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group my-3">
                                    <label for="phone_number">Nomor WhatsApp</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="form-control @if ($errors->has('phone_number')) is-invalid @endif" required
                                        value="{{ old('phone_number') }}"
                                        placeholder="Akan terisi otomatis jika nama berubah" readonly>
                                </div>

                                {{-- <div class="form-group my-3">
                                    <label for="month">Bulan</label>
                                    <input type="number" name="month" id="month" min="1" max="12"
                                        class="form-control @if ($errors->has('month')) is-invalid @endif" required
                                        value="{{ old('month') }}" placeholder="cnth: 1 untuk Januari">
                                </div> --}}

                                <div class="form-group my-3">
                                    <label for="amount">Jumlah x Pembayaran</label>
                                    <input type="number" name="amount" id="amount" min="1"
                                        class="form-control @if ($errors->has('amount')) is-invalid @endif" required
                                        value="{{ old('amount') }}" placeholder="cnth: 2">
                                    <span class="text-secondary">Berapa minggu</span>
                                </div>

                                <img src="https://via.placeholder.com/150x300.png?text=Image+preview" class="img-fluid"
                                    alt="" id="imgPreview">
                                <div class="form-group my-3">
                                    <label for="payment_proof">Bukti Pembayaran</label>
                                    <input type="file" name="payment_proof" id="payment_proof"
                                        class="form-control @if ($errors->has('payment_proof')) is-invalid @endif" required>
                                </div>

                                <div class="form-group my-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="approved" selected>Lunas</option>
                                        {{-- <option value="preview">Preview</option> --}}
                                    </select>
                                </div>

                                <div class="form-group my-3">
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-8"></div>
                                        <div class="col-lg-2 col-sm-4">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('app_js')
    <script>
        $(document).ready(() => {
            $('#payment_proof').change(function() {
                const file = this.files[0];
                console.log(file);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        console.log(event.target.result);
                        $('#imgPreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        $('#name').on('change', function() {
            $('#name option:nth-child(1)').attr('disabled', 'disabled');
            $('#phone_number').val($(this).find(':selected').data('phone'));
        });
    </script>
@endsection
