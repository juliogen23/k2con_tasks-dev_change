<?php
$coloresGraficos=["#ed1c24","#8dc63f","#f7941d","#00aeef","#c1bf22","#2b3890","#9e1f63","#726658","#006738","#ecafb2","#e2ffbb","#f7dab7"];
///barras multiples
function graficosBarras($id="",$data=[],$display="false",$title=""){
  echo '
  var ctx_'.$id.' = document.getElementById("'.$id.'");
  var myChart = new Chart(ctx_'.$id.',{
  	type: "bar",
  	data: '.json_encode($data).',
  	options: {
  		responsive: true,
  		maintainAspectRatio: false,
  		scales: {
  			xAxes: [{
  				ticks: {
  					fontColor: "#77778e",

  				 },
  				gridLines: {
  					color: "rgba(119, 119, 142, 0.2)"
  				}
  			}],
  			yAxes: [{
  				ticks: {
  					beginAtZero: true,
  					fontColor: "#77778e",
            callback: function(label, index, labels) {
                       return label+"'.$title.'";
                   }
  				},
  				gridLines: {
  					color: "rgba(119, 119, 142, 0.2)"
  				},
  			}]
  		},
  		legend: {
        display: '.$display.',
  			labels: {
  				fontColor: "#77778e"
  			},
  		},
  	}
  });
  ';
}
 ?>
