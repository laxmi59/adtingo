<? 
class graphs_types{
	function line_graph($xvalues,$yvalues,$title,$arry1,$arry2,$gtype){
		$char=	"chart: {
			renderTo: 'container',
			defaultSeriesType: '".$gtype."',
			marginRight: 130,
			marginBottom: 25
		},".$title.",
		xAxis: {
			categories: [".$xvalues."]
		},
		yAxis: {
			title: {
				text: 'Avarage'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'%';
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -10,
			y: 100,
			borderWidth: 0
		},
		series: [{";
		$tt = sizeof($arry1)-1;
		for($ff=0; $ff<sizeof($arry1); $ff++){
			if($tt == $ff)
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]";
			else
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]},{";
		}
		$char .="}]";
		return $char;
	}
	function line_labels($xvalues,$yvalues,$title,$arry1,$arry2,$gtype){
		$char=	"chart: {
			renderTo: 'container',
			defaultSeriesType: '".$gtype."',
			marginRight: 130,
			marginBottom: 25
		},".$title.",
		xAxis: {
			categories: [".$xvalues."]
		},
		yAxis: {
			title: {
				text: 'Avarage'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'%';
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -10,
			y: 100,
			borderWidth: 0
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: true
			}
		},
		series: [{";
		$tt = sizeof($arry1)-1;
		for($ff=0; $ff<sizeof($arry1); $ff++){
			if($tt == $ff)
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]";
			else
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]},{";
		}
		$char .="}]";
		return $char;
	}
	function line_time_series($xvalues,$yvalues,$title,$arry1,$arry2){
		$char="chart: {
			renderTo: 'container',
			zoomType: 'x'
		}, ".$title.",
		xAxis: {
			type: 'datetime',
			maxZoom: 5 * 24 * 3600000, // fourteen days
			categories: [".$xvalues."]
		},
		yAxis: {
			title: {
				text: 'Exchange rate'
			},
			startOnTick: false,
			showFirstLabel: false
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'%';
			}
		},
		legend: {
			enabled: false
		},
		plotOptions: {
			area: {
				fillColor: {
					linearGradient: [0, 0, 0, 300],
					stops: [
						[0, '#4572A7'],
						[1, 'rgba(2,0,0,0)']
					]
				},
				lineWidth: 1,
				marker: {
					enabled: false,
					states: {
						hover: {
							enabled: true,
							radius: 5
						}
					}
				},
				shadow: false,
				states: {
					hover: {
						lineWidth: 1						
					}
				}
			}
		},
		series: [{
			type: 'area',
			name: 'open',
			pointInterval: 24 * 3600 * 1000,
			pointStart: Date.UTC(2006, 0, 01),
			data: [".$arry2[0]."]";
		$char .="}]";
		return $char;
	
	}
	function spline_plot_bands($xvalues,$yvalues,$title,$arry1,$arry2){
		$char = "chart: {
			renderTo: 'container',
			defaultSeriesType: 'spline',
			ignoreHiddenSeries: false
		},".$title.",
		xAxis: {
			type: 'datetime',
			categories: [".$xvalues."]
		},
		yAxis: {
			title: {
				text: 'Wind speed (m/s)'
			},
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'%';
			}
		},
		series: [{";
			$tt = sizeof($arry1)-1;
		for($ff=0; $ff<sizeof($arry1); $ff++){
			if($tt == $ff)
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]";
			else
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]},{";
		}
		$char .="}]	,
		navigation: {
			menuItemStyle: {
				fontSize: '10px'
			}
		}";
		return $char;
	}
	function area_basic($xvalues,$yvalues,$title,$arry1,$arry2){
		$char = "chart: {
			renderTo: 'container', 
			defaultSeriesType: 'area'
		},".$title.",
		xAxis: {
			categories: [".$xvalues."],
			tickmarkPlacement: 'on',
		},
		yAxis: {
			title: {
				text: 'Nuclear weapon states'
			},
			labels: {
				formatter: function() {
					return this.value / 1000 +'k';
				}
			}
		},
		tooltip: {
			formatter: function() {
				return this.series.name +'% <b>'+
					Highcharts.numberFormat(this.y, 0, null, ' ') +'</b>';
			}
		},
		plotOptions: {
			area: {
				stacking: 'normal',
				lineColor: '#666666',
				lineWidth: 1,
				marker: {
					lineWidth: 1,
					lineColor: '#666666'
				}
			}
		},
		series: [{";
			$tt = sizeof($arry1)-1;
		for($ff=0; $ff<sizeof($arry1); $ff++){
			if($tt == $ff)
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]";
			else
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]},{";
		}
		$char .="}]";
		return $char;
	}
	function bar_graph($xvalues,$yvalues,$title,$arry1,$arry2,$ttype){
		$char=	"chart: {
			renderTo: 'container',
			defaultSeriesType: '".$ttype."',
			marginRight: 130,
			marginBottom: 25
		},".$title.",
		xAxis: {
			categories: [".$xvalues."]
		},
		yAxis: {
			title: {
				text: 'Avarage'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.series.name +'</b><br/>'+this.x +': '+ this.y +'%';
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -10,
			y: 100,
			borderWidth: 0
		},
		series: [{";
		$tt = sizeof($arry1)-1;
		for($ff=0; $ff<sizeof($arry1); $ff++){
			if($tt == $ff)
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]";
			else
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]},{";
		}
		$char .="}]";
		return $char;
	}
	function bar_graph_stak($xvalues,$yvalues,$title,$arry1,$arry2,$btype){
		$char= "chart: {
			renderTo: 'container',
			defaultSeriesType: '".$btype."'
		},
		".$title.",
		xAxis: {
			categories: [".$xvalues."]
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Total fruit consumption'
			}
		},
		legend: {
			backgroundColor: '#FFFFFF',
			reversed: true
		},
		tooltip: {
			formatter: function() {
				return ''+
					 this.series.name +': '+ this.y +'';
			}
		},
		plotOptions: {
			series: {
				stacking: 'normal'
			}
		},
		series: [{";
		$tt = sizeof($arry1)-1;
		for($ff=0; $ff<sizeof($arry1); $ff++){
			if($tt == $ff)
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]";
			else
				$char .= "name: '".$arry1[$ff]."',data: [".$arry2[$ff]."]},{";
		}
		$char .="}]";
		return $char;
	}
	function piechart($title,$arry1,$arry2){
	$char= "chart: {
			renderTo: 'container',
			margin: [50, 200, 60, 170]
		},
		".$title.",	
		plotArea: {
			shadow: null,
			borderWidth: null,
			backgroundColor: null
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					formatter: function() {
						if (this.y > 5) return this.point.name;
					},
					color: 'white',
					style: {
						font: '13px Trebuchet MS, Verdana, sans-serif'
					}
				}
			}
		},
		legend: {
			layout: 'vertical',
			style: {
				left: 'auto',
				bottom: 'auto',
				right: '50px',
				top: '100px'
			}
		},
		series: [{
			type: 'pie',
			name: 'Browser share',
			data: [";
			//$arr=array('open','unique','unread','unsubscribe','reply','send');
			//$arr1=array($yopen,$yunique,$yunread,$yunsub,$yreply,$ysend);
			//print_r($arry2);
			for($i=0;$i<sizeof($arry1);$i++){
				if($i==sizeof($arry1)-1)
					$char .= "['".$arry1[$i]."', ".$arry2[$i]."]";
				else
					$char .= "['".$arry1[$i]."', ".$arry2[$i]."],";
			}
				
			$char .="]
		}]";
	
return $char;
	}
	
}
?>