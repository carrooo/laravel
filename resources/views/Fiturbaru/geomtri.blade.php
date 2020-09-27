@extends('layouts.base')

@section('content')


    <!-- Main content -->
    <push class="content">
        <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card col-md-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="card-title">Geometri</h3>
                        </div>
                        <div class="col-4">
                            <div class="pull-right">hitung</div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    <form class="form" id="formgeometri">
                        <div class="form-group">
                                <label class="control-label" >Tipe Geomtri</label>
                                <select id="type" class="form-control select2bs4" name="type">
                                    <option value="">--PILIH--</option>
                                    <option value="1">Diketahui 2 suku</option>
                                    <option value="2">Diketahui 1 suku dengan rasio</option>
                                </select>
                        </div>
                        <div class="form-group" id="d1">
                                <label class="control-label" >Diketahui</label>
                                <input type="number" class="form-control"  name="suku1" placeholder="Suku ke">
                                <input type="number" class="form-control"  name="nilaisuku1" placeholder="Nilai">
                        </div>
                        <div class="form-group" id="d2">
                                <label class="control-label" >Diketahui</label>
                                <input type="number" class="form-control" name="suku2" placeholder="Suku ke">
                                <input type="number" class="form-control" name="nilaisuku2" placeholder="Nilai">
                        </div>
                        <div class="form-group" id="r">
                                <label class="control-label" >Rasio</label>
                                <input type="email" class="form-control" name="rasio" placeholder="Selisih">
                        </div>
                        <div class="form-group" id="un">
                                <label class="control-label" >Mencari suku ke</label>
                                <input type="email" class="form-control" name="un" placeholder="Mencari suku ke">
                        </div>
                        <div class="form-group" id="c">
                            <a id="cari" class="btn btn-primary btn-block">Cari</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-md-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="card-title">Geomtri</h3>
                        </div>
                        <div class="col-4">
                            <div class="pull-right">hasil</div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Suku</td>
                                <td>Nilai</td>
                            </tr>
                        </thead>
                        <tbody id="hasil">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <script type="text/javascript">
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function(){
                $("#d1").fadeOut();
                $("#d2").fadeOut();
                $("#r").fadeOut();
                $("#un").fadeOut();
                $("#c").fadeOut();
                $("#type").change(function(){
                    var type = $(this).val();
                    if (type==1){
                        $("#d1").fadeIn();
                        $("#d2").fadeIn();
                        $("#r").fadeOut();
                        $("#un").fadeIn();
                        $("#c").fadeIn();
                        $("input").val("");
                    }else if (type==2){
                        $("#d1").fadeIn();
                        $("#d2").fadeOut();
                        $("#r").fadeIn();
                        $("#un").fadeIn();
                        $("#c").fadeIn();
                        $("input").val("");
                    }else{
                        $("#d1").fadeOut();
                        $("#d2").fadeOut();
                        $("#r").fadeOut();
                        $("#un").fadeOut();
                        $("#c").fadeOut();
                        $("input").val("");
                    }
                })

                $('#cari').click(function(){
                    var y = $("#formgeometri").serialize();
                        $.ajax({
                            type: "GET",
                            url: "/geometri-cari",
                            data: $("#formgeometri").serialize(),
                            success: function(data) {
                                console.log(data);
                                $('#hasil').html('<tr><td>Rumus</td><td>'+data.rumus+'</td></tr><tr><td>A</td><td>'+data.u1+'</td></tr><tr><td>B</td><td>'+data.b+'</td></tr><tr><td>U<sub>'+data.unn+'</sub></td><td>'+data.un+'</td></tr><td>S<sub>'+data.unn+'</sub></td><td>'+data.sn+'</td></tr><tr>');
                                
                            },
                            
                        });
                });
            });
        </script>
    </push>
@endsection