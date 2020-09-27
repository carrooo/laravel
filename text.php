<script type="text/javascript">
$(document).ready(function(){
        $('body').load('/covidloadbody');
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
                $('#prov').fadeIn();
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
                        console.log(data.data);
                        coba()
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
                        console.log(data.data);
                        coba()
                    },
                    
                });
    
            }
            
        });
        function coba(){
            alert(oke);          
            var ctx = $('#myChart');
            var data1 = {
                            labels: ["Dirawat", "Sembuh", "Meninggal"],
                            datasets: [
                                {
                                label: "TeamA Score",
                                data: [11, 12, 13],
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
                            text: "Doughnut",
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
            var chart1 = new Chart(ctx, {
                            type: "doughnut",
                            data: data1,
                            options: options
                        });
        };
        
});
 
</script>