@extends('layouts.base')

@push('custom-style')
    
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">Data per negara</h1>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <!-- ini buat dropdown pilih negara -->
            <div class="w3-card-2 w3-blue-gray ">
                <div class="w3-container">
                    <br>
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" id="jnegara" for="roleFilter">Negara</label>
                            </div>
                            <select id="negara" class="form-control" name="negara">
                                <option value="1">--- Pilih ---</option>
                                @foreach ($negara as $key => $value)
                                <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- ini buat loading -->
            <div class="row justify-content-md-center" style="display: none;" id="loading">
                <button class="btn btn-primary" >
                    <span class="spinner-border spinner-border-sm"></span>
                    Loading..
                </button>
            </div>
            <!-- ini buat card negara -->
            <div class="w3-card-2" id="cardnegara" style="display: none;">
                <header class="w3-container w3-yellow">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" id="imgnegaraterpilih" style="width:50px;height:36px;">
                        </div>
                        <div class="col-md-6">
                            <h2 class="text-right"><strong id="negaraterpilih"></strong></h2>
                        </div>
                    </div>
                </header>
                <div class="w3-container">
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <p>Kasus</p>
                                    <h3 id="positif">n</h3>
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
                                    <h3 class="text-light" id="dirawat">n</h3>
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
                                    <h3 id="sembuh">n</h3>
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
                                    <h3 id="meninggal">n</h3>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-heartbeat"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" id="divdonat">
                        </div>
                        <div class="col-md-6">
                            <div class="row justify-content-md-center"><h2>Data persentasi</h2></div>
                            <label>Dirawat</label>
                            <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-warning" id="bardirawat" style="height:30px"></div>
                            </div>
                            <label>Sembuh</label>
                            <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-success" id="barsembuh" style="height:30px"></div>
                            </div>
                            <label>Meninggal</label>
                            <div class="progress" style="height:30px">
                                    <div class="progress-bar bg-danger" id="barmeninggal"style="height:30px"></div>
                            </div>
                            <div class="row justify-content-md-center"><h2>Data harian</h2></div>
                            <label>Hari ini kasus berambah</label>
                            <div class="bg-info"   style="height:30px">
                                <p class="text-center" id="kasusbertambah"><p>
                            </div>
                            <label>Hari ini meninggal berambah</label>
                            <div class="bg-danger"   style="height:30px">
                                <p  class="text-center" id="meninggalbertambah"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="tempatline">
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </section>
<script type="text/javascript">
    $(document).ready(function(){
        $('select').select2({
            theme: 'bootstrap4'
        });
        $('#negara').change(function(){

            $('#cardnegara').fadeOut();
            $('#prov').fadeOut();
            $('#loading').fadeIn();
            $('#divdonat').html('<canvas id="donat" width="150" height="150"></canvas>');
            var value = $(this).val();
            nline(value);
            if(value==1){
                alert('Pilih Negara Yang Lain');
            }else if(value=="Indonesia"){
                $('#jnegara').html(value);
                $('#negaraterpilih').html(value);
                $.ajax({
                    type: "GET",
                    url: "/getcovid/"+value,
                    success: function(data){
                        $('#loading').fadeOut();
                        $("#imgnegaraterpilih").attr("src", data.bendera);
                        $("#negaraterpilih").html(data.data.country);
                        $("#positif").html(data.data.cases);
                        $("#dirawat").html(data.data.active);
                        $("#sembuh").html(data.data.recovered);
                        $("#meninggal").html(data.data.deaths);
                        $('#prov').fadeIn();
                        $('#cardnegara').fadeIn();
                        ndonat(data.data);
                    },
                });
            }else{
                $('#jnegara').html(value);
                $('#negaraterpilih').html(value);
                $.ajax({
                    type: "GET",
                    url: "/getcovid/"+value,
                    success: function(data){
                        $('#loading').fadeOut();
                        $("#imgnegaraterpilih").attr("src", data.bendera);
                        $("#negaraterpilih").html(data.data.country);
                        $("#positif").html(data.data.cases);
                        $("#dirawat").html(data.data.active);
                        $("#sembuh").html(data.data.recovered);
                        $("#meninggal").html(data.data.deaths);
                        $('#cardnegara').fadeIn();
                        ndonat(data.data);
                    },
                });
            }
            
        });
        function ndonat(data){
            var dirawat = data.cases - data.deaths - data.recovered;
            var sembuh = data.recovered;
            var meninggal = data.deaths;
            var meninggalbertambah = data.todayDeaths;
            var kasusbertambah = data.todayCases;

            $("#meninggalbertambah").html("+"+meninggalbertambah);
            $("#kasusbertambah").html("+"+kasusbertambah);

            var pd = dirawat / data.cases * 100; 
            var vald = pd.toFixed(0);
            $("#bardirawat").html(vald+"%");
            $("#bardirawat").css("width", vald+"%");

            var ps = sembuh / data.cases * 100; 
            var vals = ps.toFixed(0);
            $("#barsembuh").html(vals+"%");
            $("#barsembuh").css("width", vals+"%");

            var pm = meninggal / data.cases * 100; 
            var valm = pm.toFixed(0);
            $("#barmeninggal").html(valm+"%");
            $("#barmeninggal").css("width", valm+"%");

            var ctx1 = $("#donat");
            var data1 = {
                            labels: ["Dirawat", "Sembuh", "Meninggal"],
                            datasets: [
                                {
                                label: "TeamA Score",
                                data: [dirawat, sembuh, meninggal],
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
        function nline(value){
            $('#tempatline').html('<canvas id="negaraline"></canvas>')
            $.ajax({
                type: "GET",
                url: "/covidloadline/"+value,
                success: function(data){
                    var ctx1 = $("#negaraline");
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
