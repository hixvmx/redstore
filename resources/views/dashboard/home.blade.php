@extends('layout.dashboard')
@section('metatags')
    <title>لوحة التحكم - ريدسطور</title>
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
                    <strong>{{$total_users}}</strong>
                    <span>الحسابات</span>
                </div>
                <div class="stat">
                    <strong>{{$total_ads}}</strong>
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
        var ctx1 = document.getElementById("usersCanvas").getContext("2d");
        var ctx2 = document.getElementById("adsCanvas").getContext("2d");

        var months = @json($months);
        var usersCounts = @json($users_counts);
        var adsCounts = @json($ads_counts);

        var usersReportsData = {
            labels: months,
            datasets: [{
                label: 'User',
                backgroundColor: "#acc0e5",
                data: usersCounts,
            }]
        };

        var adsReportsData = {
            labels: months,
            datasets: [{
                label: 'Ads',
                backgroundColor: "#e5acac",
                data: adsCounts,
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