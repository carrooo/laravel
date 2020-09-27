@extends('layouts.base')

@push('custom-style')
    
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">Data Dunia</h1>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="w3-card-2">
                <header class="w3-container w3-yellow">
                    <h2>Dunia</h2>
                </header>
                <div class="w3-container">
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <p>Kasus</p>
                                    <h3>{{$dunia->cases}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-ambulance"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <p class="text-light">Dirawat</p>
                                    <h3 class="text-light">{{$dunia->active}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-wheelchair"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <p>Sembuh</p>
                                    <h3>{{$dunia->recovered}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-medkit"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <p>Meninggal</p>
                                    <h3>{{$dunia->deaths}}</h3>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-heartbeat"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="duniadonat" width="150" height="150"></canvas>
                        </div>
                        <div class="col-md-6">
                            <div class="row justify-content-md-center"><h2>Data persentasi</h2></div>
                            <label>Dirawat</label>
                            <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-warning" id="duniabardirawat" style="height:30px"></div>
                            </div>
                            <label>Sembuh</label>
                            <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-success" id="duniabarsembuh" style="height:30px"></div>
                            </div>
                            <label>Meninggal</label>
                            <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-danger" id="duniabarmeninggal"style="height:30px"></div>
                            </div>
                            <div class="row justify-content-md-center"><h2>Data harian</h2></div>
                            <label>Hari ini kasus berambah</label>
                            <div class="bg-info"   style="height:30px">
                                <p class="text-center" id="duniakasusbertambah"><p>
                            </div>
                            <label>Hari ini meninggal berambah</label>
                            <div class="bg-danger"   style="height:30px">
                                <p class="text-center" id="duniameninggalbertambah"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <canvas id="dunialine"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script type="text/javascript">
    $(document).ready(function(){
        ddonat();
        dline();
        function ddonat(){
            var duniakasus = {{$dunia->cases}} ;
            var duniadirawat = {{$dunia->active}} ;
            var duniasembuh = {{$dunia->recovered}} ;
            var duniameninggal = {{$dunia->deaths}} ;
            var duniameninggalbertambah = {{$dunia->todayDeaths}} ;
            var duniakasusbertambah = {{$dunia->todayCases}} ;

            $("#duniameninggalbertambah").html("+"+duniameninggalbertambah);
            $("#duniakasusbertambah").html("+"+duniakasusbertambah);

            var pd = duniadirawat / duniakasus * 100; 
            var vald = pd.toFixed(0);
            $("#duniabardirawat").html(vald+"%");
            $("#duniabardirawat").css("width", vald+"%");

            var ps = duniasembuh / duniakasus * 100; 
            var vals = ps.toFixed(0);
            $("#duniabarsembuh").html(vals+"%");
            $("#duniabarsembuh").css("width", vals+"%");

            var pm = duniameninggal / duniakasus * 100; 
            var valm = pm.toFixed(0);
            $("#duniabarmeninggal").html(valm+"%");
            $("#duniabarmeninggal").css("width", valm+"%");

            var ctx1 = $("#duniadonat");
            var data1 = {
                            labels: ["Dirawat", "Sembuh", "Meninggal"],
                            datasets: [
                                {
                                label: "Diagram",
                                data: [duniadirawat, duniasembuh, duniameninggal],
                                backgroundColor: [
                                    "#f0ad4e",
                                    "#28a745",
                                    "#dc3545"
                                ],
                                borderColor: [
                                    "#17a2b8",
                                    "#17a2b8",
                                    "#17a2b8"
                                ],
                                borderWidth: [1, 1, 1]
                                }
                            ]
                        };
            var options = {
                responsive: true,
                title:  {
                            display: true,
                            position: "top",
                            text: "Diagram Lingkaran",
                            fontSize: 18,
                            fontColor: "#111"
                        },
                legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                        fontColor: "#333",
                        fontSize: 16
                        }
                    }
             };
            var chart1 = new Chart(ctx1, {
                            type: "doughnut",
                            data: data1,
                            options: options
            });
            
        };
        function dline(){
            $.ajax({
                type: "GET",
                url: "/covidloadline/all",
                success: function(data){
                    var ctx1 = $("#dunialine");
                    var stackedLine = new Chart(ctx1, {
                                        type: 'line',
                                        data: {
                                            labels: data.tanggal,
                                            datasets: [{
                                                label: 'Kasus',
                                                backgroundColor: '#17a2b8',
                                                borderColor: '#17a2b8',
                                                data: data.valuek,
                                                fill: false,
                                            },{
                                                label: 'Meninggal',
                                                backgroundColor: '#dc3545',
                                                borderColor: '#dc3545',
                                                data: data.valuem,
                                                fill: false,
                                            },{
                                                label: 'Sembuh',
                                                backgroundColor: '#28a745',
                                                borderColor: '#28a745',
                                                data: data.values,
                                                fill: false,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            title: {
                                                display: true,
                                                text: 'Diagram garis dalam 1 bulan terakhir'
                                            },
                                            tooltips: {
                                                mode: 'index',
                                                intersect: false,
                                            },
                                            hover: {
                                                mode: 'nearest',
                                                intersect: true
                                            },
                                            scales: {
                                                xAxes: [{
                                                    display: true,
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'Tanggal'
                                                    }
                                                }],
                                                yAxes: [{
                                                    display: true,
                                                    scaleLabel: {
                                                        display: true,
                                                        labelString: 'Jumlah'
                                                    }
                                                }]
                                            }
                                        }
                                    });
                    
                },
            });
        }
    });
</script>
@endsection

@push('custom-script')


@endpush
