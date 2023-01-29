@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">

            <div class="row">
                <div class="col-sm-12 col-lg-6 mb-3">
                    <div class="card bg-white text-black rounded p-4 shadow-sm">
                        <div class="card-title">
                            Pengaturan Akun
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="form-text">
                                @csrf
                                <input type="hidden" name="type" value="notif">

                                <div class="form-group mb-3">
                                    <label for="broadcast">Terima Broadcast WhatsApp Mingguan?</label>
                                    <select name="broadcast" id="broadcast" class="form-control" required>
                                        <option value="Ya" @if (Auth::user()->broadcast == 'Ya') selected @endif>Ya</option>
                                        <option value="Jangan" @if (Auth::user()->broadcast == 'Jangan') selected @endif>Jangan
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="notif_wa">Terima Notif WhatsApp?</label>
                                    <select name="notif_wa" id="notif_wa" class="form-control" required>
                                        <option value="Ya" @if (Auth::user()->notif_wa == 'Ya') selected @endif>Ya</option>
                                        <option value="Jangan" @if (Auth::user()->notif_wa == 'Jangan') selected @endif>Jangan
                                        </option>
                                    </select>
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
                            Ganti Password
                        </div>
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="type" value="change-password">

                            <div class="form-group mb-3">
                                <label for="oldPassword">Password Lama</label>
                                <input type="password" name="oldPassword" id="oldPassword" required class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" id="password" required class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-end">
                                    <button type="submit" class="btn btn-info"
                                        style="width: 150px;margin-right: 12px">Perbarui
                                        Password</button>
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
    <script>
        $(document).ready(() => {
            $("#profil_pic").change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $("#profil_pic_preview")
                            .attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
