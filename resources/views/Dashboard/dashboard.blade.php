@extends('Layouts.app')

@section('app_css')
    <!-- Charts min CSS -->
    <link rel="stylesheet" href="{{ asset('storage') }}/assets/modules/charts/Chart.min.css">
@endsection

@section('app_content')
    <div class="content-start transition">
        <div class="container-fluid dashboard">
            <div class="content-header">
                <h1>Dashboard</h1>
                <p>Selamat datang, {{ Auth::user()->name }}</p>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-primary p-4 rounded">
                        Total Uang Masuk <br>
                        Rp. {{ number_format($balance['manual_in'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-primary p-4 rounded">
                        Menunggu Konfirmasi <br>
                        Rp. {{ number_format($balance['manual_preview'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-primary p-4 rounded">
                        Total Uang Masuk (Tripay) <br>
                        Rp. {{ number_format($balance['tripay_in'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-primary p-4 rounded">
                        Menunggu Pembayaran (Tripay) <br>
                        Rp. {{ number_format($balance['tripay_unpaid'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-danger p-4 rounded">
                        Pembayaran Ditolak <br>
                        Rp. {{ number_format($balance['manual_rejected'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-success p-4 rounded">
                        Total Uang Masuk (Semua) <br>
                        Rp. {{ number_format($balance['total_money_in'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-info p-4 rounded">
                        Pembayaran Kadaluarsa (Tripay) <br>
                        Rp. {{ number_format($balance['tripay_expired'], 0, ',', '.') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 my-2">
                    <div class="card bg-warning p-4 rounded">
                        Total Uang Keluar (Semua) <br>
                        Rp. {{ number_format($balance['total_money_out'], 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Rekap Saldo {{ date('Y') }}</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="kas_tracking"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('app_js')
    <!-- Chart Js -->
    <script src="{{ asset('storage') }}/assets/modules/charts/chart.min.js"></script>
    <script src="{{ asset('storage') }}/assets/js/ui-chartjs.js"></script>

    <script>
        var kas_tracking = document.getElementById("kas_tracking").getContext("2d");
        var gradient = kas_tracking.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(50, 69, 209,1)');
        gradient.addColorStop(1, 'rgba(265, 177, 249,0)');

        var gradient2 = kas_tracking.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, 'rgba(255, 91, 92,1)');
        gradient2.addColorStop(1, 'rgba(265, 177, 249,0)');

        var myline = new Chart(kas_tracking, {
            type: 'line',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember"
                ],
                datasets: [{
                    label: 'Masuk',
                    data: {!! json_encode($graphic['cashIn']) !!},
                    backgroundColor: "rgba(50, 69, 209,.6)",
                    borderWidth: 3,
                    borderColor: 'rgba(63,82,227,1)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }, {
                    label: 'Keluar',
                    data: {!! json_encode($graphic['cashOut']) !!},
                    backgroundColor: "rgba(253, 183, 90,.6)",
                    borderWidth: 3,
                    borderColor: 'rgba(253, 183, 90,.6)',
                    pointBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointRadius: 3,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,1)',
                }]
            },
            options: {
                responsive: true,
                layout: {
                    padding: {
                        top: 10,
                    },
                },
                tooltips: {
                    intersect: false,
                    titleFontFamily: 'Helvetica',
                    titleMarginBottom: 10,
                    xPadding: 10,
                    yPadding: 10,
                    cornerRadius: 3,
                },
                legend: {
                    display: true,
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true,
                            drawBorder: true,
                        },
                        ticks: {
                            display: true,
                        },
                    }, ],
                    xAxes: [{
                        gridLines: {
                            drawBorder: true,
                            display: true,
                        },
                        ticks: {
                            display: true,
                        },
                    }, ],
                },
            }
        });
    </script>
@endsection
