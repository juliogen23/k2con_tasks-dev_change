<?php
	function printChartValue($arr) {
		foreach($arr as $a) {
			$salida[] = "'".$a."'";
		}
		return implode(",",$salida);
	}
function lineChartMultiple($id, $fechas,$clicks,$alcance,$likes,$comments) {
		?>
		<script>
			$(document).ready(function() {
				/*======== 16. ANALYTICS - ACTIVITY CHART ========*/
				  var activity_<?php echo $id; ?> = document.getElementById("<?php echo $id; ?>");

				  if (activity_<?php echo $id; ?> !== null) {
					var activityData_<?php echo $id; ?> = [
					  {
						first: [<?php echo printChartValue($clicks); ?>]
					  },
					  {
						first: [<?php echo printChartValue($alcance); ?>]
					  },
					  {
						first: [<?php echo printChartValue($likes); ?>]
					  },
					  {
						first: [<?php echo printChartValue($comments); ?>]
					  }
					];
					var config_<?php echo $id; ?> = {
					  // The type of chart we want to create
					  type: "line",
					  // The data for our dataset
					  data: {
						labels: [<?php echo printChartValue($fechas); ?>
						],
						datasets: [
						  {
							label: "Trained Staff",
							backgroundColor: "transparent",
							borderColor: "rgb(237, 42, 38)",
							data: activityData_<?php echo $id; ?>[0].first,
							lineTension: 0,
							pointRadius: 5,
							pointBackgroundColor: "rgba(255,255,255,1)",
							pointHoverBackgroundColor: "rgba(255,255,255,1)",
							pointBorderWidth: 2,
							pointHoverRadius: 7,
							pointHoverBorderWidth: 1
						  }
						]
					  },
					  // Configuration options go here
					  options: {
						responsive: true,
						maintainAspectRatio: false,
						legend: {
						  display: false
						},
						scales: {
						  xAxes: [
							{
							  gridLines: {
								display: false,
							  },
							  ticks: {
								fontColor: "#686f7a", // this here
							  },
							}
						  ],
						  yAxes: [
							{
							  gridLines: {
								fontColor: "#686f7a",
								fontFamily: "Roboto, sans-serif",
								display: true,
								color: "#efefef",
								zeroLineColor: "#efefef"
							  },
							  ticks: {
								// callback: function(tick, index, array) {
								//   return (index % 2) ? "" : tick;
								// }
								fontColor: "#686f7a",
								fontFamily: "Roboto, sans-serif"
							  }
							}
						  ]
						},
						tooltips: {
						  mode: "index",
						  intersect: false,
						  titleFontColor: "#333",
						  bodyFontColor: "#686f7a",
						  titleFontSize: 12,
						  bodyFontSize: 15,
						  backgroundColor: "rgba(256,256,256,0.95)",
						  displayColors: true,
						  xPadding: 10,
						  yPadding: 7,
						  borderColor: "rgba(220, 220, 220, 0.9)",
						  borderWidth: 2,
						  caretSize: 6,
						  caretPadding: 5
						}
					  }
					};

					var ctx_<?php echo $id; ?> = document.getElementById("activity_<?php echo $id; ?>").getContext("2d");
					var myLine_<?php echo $id; ?> = new Chart(ctx_<?php echo $id; ?>, config_<?php echo $id; ?>);

					var items_<?php echo $id; ?> = document.querySelectorAll("#user-activity_<?php echo $id; ?> .nav-tabs .nav-item");
					items_<?php echo $id; ?>.forEach(function(item, index){
					  item.addEventListener("click", function() {
						config_<?php echo $id; ?>.data.datasets[0].data = activityData_<?php echo $id; ?>[index].first;
						myLine_<?php echo $id; ?>.update();
					  });
					});
				  }
			})
		</script>
		<?php
	}
	function pieChart($id, $arrNames,$arrValores,$titulo) {
		global $arrColores;
		?>
		<script>
			$(document).ready(function() {
				var configPie_<?php echo $id; ?> = {
					type: 'doughnut',
					data: {
						datasets: [{
							data: [<?php echo printChartValue($arrValores); ?>],
							backgroundColor: [
								<?php echo printChartValue($arrColores);?>
							],
							label: 'Dataset 1'
						}],
						labels: [<?php echo printChartValue($arrNames); ?>]
					},
					options: {
						responsive: true,
						legend: {
							position: 'top',
							// display: false,
						},
						title: {
							display: false,
							text: '<?php echo $titulo; ?>'
						},
						animation: {
							animateScale: true,
							animateRotate: true
						}
					}
				};

				var ctxPie_<?php echo $id; ?> = document.getElementById('<?php echo $id; ?>').getContext('2d');
				window.myDoughnut = new Chart(ctxPie_<?php echo $id; ?>, configPie_<?php echo $id; ?>);
			})
		</script>
		<?php
	}
function barCharWidget($id, $arrNames,$arrValores,$titulo) {
		?>
		<script>
			$(document).ready(function() {
			var barX<?php echo $id; ?> = document.getElementById("barChart<?php echo $id; ?>");
			if (barX<?php echo $id; ?> !== null) {
			  var myChart<?php echo $id; ?> = new Chart(barX<?php echo $id; ?>, {
				type: "bar",
				data: {
				  labels: [
					<?php echo printChartValue($arrNames); ?>
				  ],
				  datasets: [
					{
					  label: "<?php echo $titulo; ?>",
					  data: [<?php echo printChartValue($arrValores); ?>],
					  // data: [6, 3, 4, 3, 6, 9, 4, 8, 9, 5, 8, 3, 4],
					  backgroundColor: "#AACDF4"
					}
				  ]
				},
				options: {
				  responsive: true,
				  maintainAspectRatio: false,
				  legend: {
					display: false
				  },
				  scales: {
					xAxes: [
					  {
						gridLines: {
						  drawBorder: false,
						  display: false
						},
						ticks: {
						  display: true, // hide main x-axis line
						  beginAtZero: true
						},
						barPercentage: 1.8,
						categoryPercentage: 0.2
					  }
					],
					yAxes: [
					  {
						gridLines: {
						  drawBorder: false, // hide main y-axis line
						  display: false
						},
						ticks: {
						  display: false,
						  beginAtZero: true
						}
					  }
					]
				  },
				  tooltips: {
					titleFontColor: "#333",
					bodyFontColor: "#686f7a",
					titleFontSize: 12,
					bodyFontSize: 12,
					backgroundColor: "rgba(256,256,256,0.95)",
					displayColors: false,
					borderColor: "rgba(220, 220, 220, 0.9)",
					borderWidth: 2
				  }
				}
			  });
			}
			})
		</script>
		<?php
	}
	function graficoDeBarrasMultiple($id,$matrixValores,$mostrarLeyenda=true,$matrix_val) {
		global $arrColores;
			?>
			<script>
			$(document).ready(function(){
				var var_<?php echo $id; ?>=JSON.parse('<?php echo addslashes(json_encode($matrix_val)); ?>');
				document.getElementById("<?php echo $id; ?>").onclick = function(evt){
				    //
		          var activePoints =<?php echo $id; ?>Chart.getElementsAtEvent(evt);
		          if (activePoints[0]) {
		            var chartData = activePoints[0]['_chart'].config.data;
		            var idx = activePoints[0]['_index'];
		            var label = chartData.labels[idx];
								// console.log(url);
								var url = window.location.href;
								var conector = url.indexOf("?") < 0 ? "?"+var_<?php echo $id; ?>[label] : "&"+var_<?php echo $id; ?>[label];
								console.log(conector);

		          }
				    //
				}
				<?php echo $id; ?>Chart= new Chart(
					document.getElementById("<?php echo $id; ?>"),
					{
						"type":"bar",
						"data":{
							"labels":['<?php echo implode("','",array_keys($matrix_val)); ?>'],
							"datasets":[
								<?php foreach ($matrixValores as $k => $v){ ?>
								<?php if($k!="vacio"){ ?>
									{
										"label":"<?php echo $k; ?>",
										"data":[<?php echo implode(",",$v) ?>],
										"fill":false,
										// "backgroundColor":"#ffa500",
										// "borderColor":"#ffa500",
										"backgroundColor":[<?php echo printChartValue($arrColores); ?>],
										"borderWidth":1
									},
								<?php } ?>
								<?php } ?>
							]
						},
						"options":{
							"legend": {
					        "display": false
					    },
							"scales":{
								"yAxes":[{
									"ticks":{
										"stepSize": 1,
										"beginAtZero":true
									}
								}],
								"xAxes":[{
									"ticks":{
										"display":true
									}
								}]
							}
						}
					});
					});
					</script>
			<?php
		}

	function graficoDeBarras($id, $arrNames,$arrValores,$titulo,$mostrarLeyenda=true,$matrix_val=array()){
		global $arrColores;
			?>
			<script>
			$(document).ready(function(){
				var var_<?php echo $id; ?>=JSON.parse('<?php echo addslashes(json_encode($matrix_val)); ?>');
				document.getElementById("<?php echo $id; ?>").onclick = function(evt){
				    //
		          var activePoints =<?php echo $id; ?>Chart.getElementsAtEvent(evt);
		          if (activePoints[0]) {
		            var chartData = activePoints[0]['_chart'].config.data;
		            var idx = activePoints[0]['_index'];
		            var label = chartData.labels[idx];
								// console.log(url);
								var url = window.location.href;
								var conector = url.indexOf("?") < 0 ? "?"+var_<?php echo $id; ?>[label] : "&"+var_<?php echo $id; ?>[label];
								console.log(conector);

		          }
				    //
				}
				<?php echo $id; ?>Chart= new Chart(
					document.getElementById("<?php echo $id; ?>"),
					{
						"type":"bar",
						"data":{
							"labels":[<?php echo printChartValue($arrNames); ?>],
							"datasets":[
								{
									"label":"<?php echo $titulo; ?>",
									"data":[<?php echo printChartValue($arrValores); ?>],
									"fill":false,
									"backgroundColor":[<?php echo printChartValue($arrColores); ?>],
									// "borderColor":[
									// 	<?php //echo printChartValue($arrColores);?>
									// ],
									"borderWidth":1}
							]
						},
						"options":{
							"legend": {
					        "display": false
					    },
							"scales":{
								"yAxes":[{
									"ticks":{
										"stepSize": 1,
										"beginAtZero":true
									}
								}],
								"xAxes":[{
									"ticks":{

										<?php echo ($mostrarLeyenda)?'"display":true':'"display":false';?>
									}
								}]
							}
						}
					});
					});
					</script>
			<?php
		}

		function graficoHorizontalBarMultiple($id,$matrixValores,$mostrarLeyenda=true,$matrix_val){
			global $arrColores;
				?>
				<script>
				$(document).ready(function(){
						var var_<?php echo $id; ?>=JSON.parse('<?php echo addslashes(json_encode($matrix_val)); ?>');
						document.getElementById("<?php echo $id; ?>").onclick = function(evt){
						    //
				          var activePoints =<?php echo $id; ?>Chart.getElementsAtEvent(evt);
				          if (activePoints[0]) {
				            var chartData = activePoints[0]['_chart'].config.data;
				            var idx = activePoints[0]['_index'];
				            var label = chartData.labels[idx];
										// console.log(url);
										var url = window.location.href;
										var conector = url.indexOf("?") < 0 ? "?"+var_<?php echo $id; ?>[label] : "&"+var_<?php echo $id; ?>[label];
										console.log(conector);

				          }
						    //
						}
						<?php echo $id; ?>Chart= new Chart(
						document.getElementById("<?php echo $id; ?>"),
						{
							"type":"horizontalBar",
							"data":{
								"labels":['<?php echo implode("','",array_keys($matrix_val)); ?>'],
								"datasets":[
									<?php foreach ($matrixValores as $k => $v){ ?>
									<?php if($k!="vacio"){ ?>
										{
											"label":"<?php echo $k; ?>",
											"data":[<?php echo implode(",",$v) ?>],
											"fill":false,
											"backgroundColor":"#ffa500",
											"borderColor":"#ffa500",
											// "backgroundColor":[<?php //echo printChartValue($arrColores); ?>],
											"borderWidth":1,
										},
									<?php } ?>
									<?php } ?>
								]
							},
							"options":{
								"legend": {
						        "display": false

						    },
								"scales":{
									"yAxes":[{
										"ticks":{

											"stepSize": 1,
											"beginAtZero":true
										}
									}],
									"xAxes":[{
										"ticks":{
											"stepSize": 1,
											"min":0
											// "display":true
										}
									}]
								}
							}
						});
						});
						</script>
				<?php
			}
		//
		function graficoHorizontalBar($arrColores_,$id, $arrNames,$arrValores,$titulo) {
				?>
				<script>
				$(document).ready(function(){
					new Chart(
						document.getElementById("<?php echo $id; ?>"),
						{
							"type":"horizontalBar",
							"data":{
								"labels":[<?php echo printChartValue($arrNames); ?>],
								"datasets":[
									{
										"label":"<?php echo $titulo; ?>",
										"data":[<?php echo printChartValue($arrValores); ?>],
										"fill":false,
										"backgroundColor":"#ffa500",
										"borderColor":"#ffa500",
										"borderWidth":1
									}
								]
							},
							"options":{
								"legend": {
						        "display": false
						    },
								"scales":{
									"yAxes":[{
										"ticks":{
											"stepSize": 1,
											"beginAtZero":true
										}
									}],
									"xAxes":[{
										"ticks":{
											"stepSize": 1,
											"min":0
										}
									}]
								}
							}
						});
						});
						</script>
				<?php
			}
// function addCommas(nStr){
// 			    nStr += '';
// 			    x = nStr.split('.');
// 			    x1 = x[0];
// 			    x2 = x.length > 1 ? '.' + x[1] : '';
// 			    var rgx = /(\d+)(\d{3})/;
// 			    while (rgx.test(x1)) {
// 			        x1 = x1.replace(rgx, '$1' + ',' + '$2');
// 			    }
// 			    return x1 + x2;
// 			}
function barCharWidget2($id, $arrNames,$arrValores,$titulo,$max = NULL,$interval = NULL,$steep = NULL, $monto=false) {
		?>
		<script>
			$(document).ready(function() {
			var barX<?php echo $id; ?> = document.getElementById("barChart<?php echo $id; ?>");
			if (barX<?php echo $id; ?> !== null) {
			  var myChart<?php echo $id; ?> = new Chart(barX<?php echo $id; ?>, {
				type: "line",
				data: {
				  labels: [
					<?php echo printChartValue($arrNames); ?>
				  ],
				  datasets: [
					{
					  label: "<?php echo $titulo; ?>",
					  data: [<?php echo printChartValue($arrValores); ?>],
					  // data: [6, 3, 4, 3, 6, 9, 4, 8, 9, 5, 8, 3, 4],
					}
				  ]
				},
				options: {
					// tooltips: {
				  //     callbacks: {
				  //         label: function(tooltipItem, data) {
				  //             return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
				  //         }
				  //     }
				  // },
				  responsive: true,
				  maintainAspectRatio: false,
				  legend: {
					display: false
				  },
				  scales: {
					xAxes: [
					  {
						gridLines: {
						  drawBorder: true,
						  display: true
						},
						ticks: {
						  display: true, // hide main x-axis line
						  beginAtZero: true
						},
						barPercentage: 1.8,
						categoryPercentage: 0.2
					  }
					],
					yAxes: [
					  {
						gridLines: {
						  drawBorder: true, // hide main y-axis line
						  display: true
						},
						ticks: {
						  display: true,
						  beginAtZero: true
						}
					  }
					]
				  },
				  tooltips: {
						<?php if($monto){ ?>
							callbacks: {
									label: function(tooltipItem, data){
											return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.');
									}
								},
						<?php } ?>
					titleFontColor: "#333",
					bodyFontColor: "#686f7a",
					titleFontSize: 12,
					bodyFontSize: 12,
					backgroundColor: "rgba(256,256,256,0.95)",
					displayColors: false,
					borderColor: "rgba(220, 220, 220, 0.9)",
					borderWidth: 2
				  },
				  annotation: {
						annotations: [{
							type: 'line',
							mode: 'horizontal',
							scaleID: 'y-axis-0',
							value: '26',
							borderColor: 'red',
							borderWidth: 5
						}]
					}
				}
			  });
			}
			})
		</script>
		<?php
	}
?>
