@extends('layouts.base')

@push('custom-style')
    
@endpush

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark">Data Provinsi Indonesia</h1>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <!-- ini buat dropdown pilih negara -->
            <div class="w3-card-2 w3-white">
                <div class="w3-container">
                    <br>
                    <div class="table table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
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
    </section>
<script type="text/javascript">
    $(document).ready(function(){
        $('table').dataTable();
    });
</script>
@endsection

@push('custom-script')


@endpush
