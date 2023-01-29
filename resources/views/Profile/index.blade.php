@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">

            <div class="row">
                <div class="col-sm-12 col-lg-6 mb-3">
                    <div class="card bg-white text-black rounded p-4 shadow-sm">
                        <div class="card-title">
                            Profil {{ Auth::user()->name }}
                        </div>
                        <div class="card-body">
                            <form action="" method="post" id="form-text">
                                @csrf
                                <input type="hidden" name="type" value="nonImg" readonly required>

                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" required readonly
                                        value="{{ Auth::user()->name }}" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" required
                                        value="{{ Auth::user()->username }}" class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone_number">Nomor WhatsApp</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        value="{{ Auth::user()->phone_number }}" placeholder="08xxxx" class="form-control"
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
                            Foto Profil
                        </div>
                        <form action="" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="type" value="img">

                            <div class="form-group mb-3">
                                <img src="{{ asset('storage') }}/{{ is_null(Auth::user()->profil_pic) ? 'profile-pic/default.png' : Auth::user()->profil_pic }}"
                                    alt="{{ Auth::user()->name }} - MariKas Profile" class="img-fluid"
                                    id="profil_pic_preview" width="200"><br><br>
                                <input type="file" name="profil_pic" id="profil_pic" required class="form-control">
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-end">
                                    <button type="submit" class="btn btn-info"
                                        style="width: 150px;margin-right: 12px">Perbarui
                                        Foto</button>
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
