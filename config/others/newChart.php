<?php
function ChartBar($id,$lables,$data,$more_options=""){
  /*$id es el id del elemto canva
  labels un string de palabras entre "" y separadas por comas
  data un array donde el key es el titulo de los datos y el value es un string de numeros separados por comas
  ejemplo ChartBar( "myChart",
            "'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'",
            ["hola" => "1,3,4,5,1","hola2" => "22,31,23,11,1"]
          );
  */
  echo 'const ctx_'.$id.'= document.getElementById("'.$id.'").getContext("2d");
        const myChart_'.$id.' = new Chart(ctx_'.$id.', {
            type: "bar",
            data:{
                labels: ['.$lables.'],
                datasets: [';
  foreach ($data as $key => $value) {
    echo '  {label: "'.$key.'",
              data: ['.$value.'],
              backgroundColor: [
                  "#f98f10","#f9400f","#dc110c","#bb0231","#7d1a5b","#512c91","#7633ff","#2fb6ff","#36d7c7"
              ],
            },';
  }
  echo '      ]
            },
            options: {
				
				layout: {
				  padding: {
					bottom: 25
				  }
				},
				plugins: {
					legend: { display: false },
					tooltip: {
						callbacks: {
							label: function(context) {
								var todo = context.dataset.data;
								var sum = 0;
								todo.map(data => {
								  sum += Number(data);
								});
								let percentage = (context.parsed.y * 100 / sum).toFixed(2) + "%";
								console.log(context)
								let label = context.label || "";

								if (label) {
									label += ": ";
								}
								if (context.parsed.y !== null) {
									label += context.parsed.y + " ("+percentage+")";
								}
								return label;
							}
						}
					}					
				  
				},
				'.$more_options.'
			  },
        });';
}

function ChartPie($id,$lables,$data,$more_options=""){
	
	
	
  echo '$(function() { const ctxp_'.$id.' = document.getElementById("'.$id.'").getContext("2d");
        const myChartPie_'.$id.' = new Chart(ctxp_'.$id.', {
        type: "pie",
        data:{
          labels: ['.$lables.'],
          datasets: [';
    foreach ($data as $key => $value) {
        echo '      {label: "'.$key.'",
                        data: ['.$value.'],
                        backgroundColor: [
                          "#f98f10","#dc110c","#7633ff","#2fb6ff","#36d7c7"
                        ],
                        hoverOffset: 4
                      },';
    }
    echo'   ]
          },
			options: {
				layout: {
				  padding: {
					bottom: 25
				  }
				},
				plugins: {
					legend: { position: "bottom" },
				  tooltip: {
					enabled: true,
					callbacks: {
					  footer: (ttItem) => {
						let sum = 0;
						let dataArr = ttItem[0].dataset.data;
						dataArr.map(data => {
						  sum += Number(data);
						});

						let percentage = (ttItem[0].parsed * 100 / sum).toFixed(2) + "%";
						return `${percentage}`;
					  }
					}
				  },
				  /** Imported from a question linked above. 
					  Apparently Works for ChartJS V2 **/
				  datalabels: {
					formatter: (value, dnct1) => {
					  let sum = 0;
					  let dataArr = dnct1.chart.data.datasets[0].data;
					  dataArr.map(data => {
						sum += Number(data);
					  });

					  let percentage = (value * 100 / sum).toFixed(2) + "%";
					  return percentage;
					},
					color: "#ff3",
				  }
				},
				'.$more_options.'
			  },
        });
        });	';
}
 ?>
