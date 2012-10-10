<?
function charts($rid){
	$wsdl = 'http://api.stormpost.datranmedia.com/services/SoapRequestProcessor?wsdl';
	$soapClient = new SoapClient($wsdl);
	$login = new SOAPHeader($wsdl, 'username', 'soap@conglomeratenetwork.com');
	$password = new SOAPHeader($wsdl, 'password', 'Password2');
	$headers = array($login, $password);
	$soapClient->__setSOAPHeaders($headers);
	$gdmr=array("mailingId"=>$rid);
	print_r($gdmr);
	try{
		$gdmr_res =  $soapClient->__call("getDetailedMailingReport", $gdmr);
		return $gdmr_res;
		//echo $gdmr_res->mailingID;
	} catch (SoapFault $fault) {
		$error = "gdmr_error";
	}
}
class graphs_types{
function piechart($arry1,$arry2){
	$char= "chart: {
			renderTo: 'container',
			margin: [50, 200, 60, 170]
		},
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
	
	
function line_graph($xvalues,$arry1,$arry2,$gtype){
		$char=	"chart: {
			renderTo: 'container',
			defaultSeriesType: '".$gtype."',
			marginRight: 130,
			marginBottom: 25
		},
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
}
?>