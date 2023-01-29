@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">

            <div class="row">
                <div class="col-sm-12 col-lg-6 mb-3">
                    <div class="card bg-white text-black rounded p-4 shadow-sm">
                        <div class="card-title">
                            Web Config
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="form-text">
                                @csrf
                                <input type="hidden" name="type" value="nonImg" readonly required>

                                <div class="form-group mb-3">
                                    <label for="app_env">Environment Aplikasi</label>
                                    <select name="app_env" id="app_env" required class="form-control">
                                        <option value="development" @if ($data[0]->value == 'development') selected @endif>
                                            Development</option>
                                        <option value="production" @if ($data[0]->value == 'production') selected @endif>
                                            Production</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="app_name">Nama Aplikasi</label>
                                    <input type="text" name="app_name" id="app_name" required
                                        value="{{ $data[1]->value }}" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="app_desc">Deskripsi Aplikasi</label>
                                    <textarea name="app_desc" id="app_desc" cols="30" rows="5" class="form-control">{{ $data[3]->value }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tripay_api_key">Tripay API Key</label>
                                    <input type="text" name="tripay_api_key" id="tripay_api_key"
                                        value="{{ $data[6]->value }}" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tripay_private_key">Tripay Private Key</label>
                                    <input type="text" name="tripay_private_key" id="tripay_private_key"
                                        value="{{ $data[7]->value }}" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="fastwa_instance_key">FastWA Instance Key</label>
                                    <input type="text" name="fastwa_instance_key" id="fastwa_instance_key"
                                        value="{{ $data[8]->value }}" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="dana_number">Dana Number</label>
                                    <input type="text" name="dana_number" id="dana_number" value="{{ $data[9]->value }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="dana_holder_name">Nama Pemegang Dana</label>
                                    <input type="text" name="dana_holder_name" id="dana_holder_name"
                                        value="{{ $data[10]->value }}" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="discord_webhook_otp">Discord Webhook OTP</label>
                                    <input type="text" name="discord_webhook_otp" id="discord_webhook_otp"
                                        value="{{ $data[12]->value }}" class="form-control" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="discord_webhook_kas_payment">Discord Webhook Kas Pay</label>
                                    <input type="text" name="discord_webhook_kas_payment"
                                        id="discord_webhook_kas_payment" value="{{ $data[13]->value }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="discord_webhook_kas_cashout">Discord Webhook Kas Cashout</label>
                                    <input type="text" name="discord_webhook_kas_cashout"
                                        id="discord_webhook_kas_cashout" value="{{ $data[14]->value }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-info"
                                            style="width: 150px;margin-right: 12px">Perbarui
                                            Data</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="card bg-white text-black rounded p-4 shadow-sm">
                        <div class="card-title">
                            Gambar
                        </div>
                        <form action="" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="type" value="img">

                            <div class="form-group mb-3">
                                <img src="{{ asset('storage') }}/{{ $data[11]->value }}" alt="QRIS IMG"
                                    class="img-fluid" width="200"><br>
                                <label for="qris_url">QRIS</label>
                                <input type="file" name="qris_url" id="qris_url" class="form-control">
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-end">
                                    <button type="submit" class="btn btn-info"
                                        style="width: 150px;margin-right: 12px">Perbarui
                                        Data</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('app_js')
@endsection
