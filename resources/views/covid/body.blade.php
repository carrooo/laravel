<div class="container-fluid">
        <div class="row justify-content-center">
        <div class="card col-md-12">
                <div class="card-header bg-info">
                    <div class="row">
                        <div class="col-8">
                            <div class="text-left"><strong>Covid-19</strong></div>
                        </div>
                        <div class="col-4">
                            <div class="text-right"><strong>Catur-22</strong></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                                <!-- ini buat duni -->
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
                                                    <p id="duniakasusbertambah"><p>
                                                </div>
                                                <label>Hari ini meninggal berambah</label>
                                                <div class="bg-danger"   style="height:30px">
                                                    <p id="duniameninggalbertambah"></p>
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
                                <br>
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
                                            <div class="col-md-6">
                                                <canvas id="donat" width="150" height="150"></canvas>
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
                                                    <p id="kasusbertambah"><p>
                                                </div>
                                                <label>Hari ini meninggal berambah</label>
                                                <div class="bg-danger"   style="height:30px">
                                                    <p id="meninggalbertambah"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- ini buat provunsi indonesia aja -->
                                <div class="w3-card-2" id="prov" style="display: none;">
                                    <header class="w3-container w3-blue">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="https://raw.githubusercontent.com/NovelCOVID/API/master/assets/flags/id.png" style="width:50px;height:36px;">
                                            </div>
                                            <div class="col-md-6">
                                                <h2 class="text-right"><strong>Indonesia/Provinsi</strong></h2>
                                            </div>
                                        </div>
                                    </header>
                                    <div class="w3-container">
                                        <br>
                                        <div class="table table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nama prov</th>
                                                    <th>Positif</th>
                                                    <th>Sembuh</th>
                                                    <th>Meninggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($provinsi as $key => $value)
                                                <tr>
                                                    <td>{{$value->Provinsi}}</td>
                                                    <td>{{$value->Kasus_Posi}}</td>
                                                    <td>{{$value->Kasus_Semb}}</td>
                                                    <td>{{$value->Kasus_Meni}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        ddonat();
        dline();
        $('table').dataTable();
        $('select').select2({
            theme: 'bootstrap4'
        });
        $('#negara').change(function(){

            $('#cardnegara').fadeOut();
            $('#prov').fadeOut();
            $('#loading').fadeIn();

            var value = $(this).val();

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
                        $("#sembuh").html(data.data.recovered);
                        $("#meninggal").html(data.data.deaths);
                        $('#prov').fadeIn();
                        $('#cardnegara').fadeIn();
                        fdonat(data.data);
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
                        $("#sembuh").html(data.data.recovered);
                        $("#meninggal").html(data.data.deaths);
                        $('#cardnegara').fadeIn();
                        fdonat(data.data);
                    },
                });
            }
            
        });
        function fdonat(data){
            console.log(data);
            
            var dirawat = data.cases - data.deaths - data.recovered;
            var sembuh = data.recovered;
            var meninggal = data.deaths;
            var meninggalbertambah = data.todayDeaths;
            var kasusbertambah = data.todayCases;

            $("#dirawat").html(dirawat);
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
                url: "/covidloadline/",
                success: function(data){
                    var tanggal = [];
                    var valuek = [];
                    var valuem = [];
                    var values = [];
                    for (var i in data.tanggal) {
                        tanggal.push(data.tanggal[i]);
                    }
                    for (var i in data.valuek) {
                        valuek.push(data.valuek[i]);
                    }
                    for (var i in data.valuem) {
                        valuem.push(data.valuem[i]);
                    }
                    for (var i in data.values) {
                        values.push(data.values[i]);
                    }
                    var ctx1 = $("#dunialine");
                    var stackedLine = new Chart(ctx1, {
                                        type: 'line',
                                        data: {
                                            labels: tanggal,
                                            datasets: [{
                                                label: 'Kasus',
                                                backgroundColor: '#17a2b8',
                                                borderColor: '#17a2b8',
                                                data: valuek,
                                                fill: false,
                                            },{
                                                label: 'Meninggal',
                                                backgroundColor: '#dc3545',
                                                borderColor: '#dc3545',
                                                data: valuem,
                                                fill: false,
                                            },{
                                                label: 'Sembuh',
                                                backgroundColor: '#28a745',
                                                borderColor: '#28a745',
                                                data: values,
                                                fill: false,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            title: {
                                                display: true,
                                                text: 'Diagram garis dunia'
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