@extends('layout.dashboard')
@section('metatags')
    <title>Dashboard - RedStore</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/global.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/home.css') }}" />
@endsection

@section('content')
    <div class="db__sec wd__80">
        <div class="db__header">
            <h2>الإحصائيات</h2>
        </div>
        <div class="db__body">
            <div class="db__body__header">
                <ul>
                    <li>
                        <label>
                            <b>12,877</b>
                            <span>الزيارات</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <b>959</b>
                            <span>الإعلانات</span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <b>159</b>
                            <span>الحسابات</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="db__body__content">
                
                <div class="col-md-10 offset-md-1">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <canvas id="canvas" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>

        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

        var reportsData = {
            labels: months,
            datasets: [{
                label: 'User',
                backgroundColor: "#acc0e5",
                data: ['50','43','47','21','43','17','21','43','55','44','2','25'],
            },{
                label: 'Visits',
                backgroundColor: "#ace5ac",
                data: ['43','57','64','16','33','08','17','26','41','45','21','1'],
            },{
                label: 'Ads',
                backgroundColor: "#e5acac",
                data: ['19','32','11','01','2','35','46','19','6','54','28','9'],
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: reportsData,
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