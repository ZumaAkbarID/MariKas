@extends('Layouts.app')

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-content">
                            @if ($data['message'] == 'Whatsapp instance connected successfully')
                                <div class="alert alert-success">WhatsApp sudah terhubung dengan nomor
                                    {{ $data['data']['phone_number'] }}</div>
                            @else
                                <img class="img-fluid w-100" src="{{ $data['qr_url'] }}">
                            @endif
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            {{-- <span>Card Footer</span> --}}
                            @if ($data['message'] !== 'Whatsapp instance connected successfully')
                                <button class="btn btn-light-primary" onclick="location.reload()">Refresh</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('app_js')
    <script>
        function NotAvailable() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Provider penyedia API belum support',
            })
        }
    </script>
@endsection
