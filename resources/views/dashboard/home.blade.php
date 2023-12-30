@extends('layout.dashboard')
@section('metatags')
    <title>Dashboard - RedStore</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/home.css') }}" />
@endsection

@section('content')
    <div class="db__sec maxWidth">
        <div class="db__header">
            <h2>الإحصائيات</h2>
        </div>
        <div class="db__body">
            <div class="stats">
                <div class="stat">
                    <strong>19.245</strong>
                    <span>الحسابات</span>
                </div>
                <div class="stat">
                    <strong>103.245</strong>
                    <span>الإعلانات</span>
                </div>
            </div>

            <div class="charts__content">
                <div class="chart">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <canvas id="usersCanvas" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>

                <div class="chart">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <canvas id="adsCanvas" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>

        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        var ctx1 = document.getElementById("usersCanvas").getContext("2d");
        var ctx2 = document.getElementById("adsCanvas").getContext("2d");

        var usersReportsData = {
            labels: months,
            datasets: [{
                label: 'User',
                backgroundColor: "#acc0e5",
                data: ['50','43','47','21','43','17','21','43','55','44','2','25'],
            }]
        };

        var adsReportsData = {
            labels: months,
            datasets: [{
                label: 'Ads',
                backgroundColor: "#e5acac",
                data: ['19','32','11','01','2','35','46','19','6','54','28','9'],
            }]
        };

        window.onload = function() {
            // Users
            window.myBar = new Chart(ctx1, {
                type: 'bar',
                data: usersReportsData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 0,
                            borderColor: '#eee',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: ''
                    }
                }
            });
            
            // Ads
            window.myBar = new Chart(ctx2, {
                type: 'bar',
                data: adsReportsData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 0,
                            borderColor: '#eee',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: false,
                        text: ''
                    }
                }
            });
        };
    </script>
@endsection