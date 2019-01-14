@extends('layouts.admin')
 
@section('content')
	<h1>Admin</h1>
	
<?php 
	/* display chart using loop */
	// foreach($counts as $count){
	// 	echo $count . ",";
	// }
?>


		<canvas id="myChart"></canvas>
		<hr>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Users", "Categories", "Comments","Roles","Posts","Photos","Approved Comments","Unapproved Comments"],
        datasets: [{
            label: 'Data of CMS',
            data: [{{$users_count}},{{$categories_count}},{{$comments_count}},{{$roles_count}},{{$posts_count}},{{$photos_count}},{{$approved_comments}},{{$unapproved_comments}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@stop
