<?php /* view */ ?>
<html>
	<head>
		<title>GemerGraphs</title>
		<link rel="stylesheet" type="text/css" href="style/global.css" />
		
		<!--[if IE]><script language="javascript" type="text/javascript" src="/js/excanvas.js"></script><![endif]-->
		<script language="javascript" type="text/javascript" src="/js/prototype.js"></script>
		<script language="javascript" type="text/javascript" src="/js/flotr.js"></script>
		
		<meta name="viewport" content="width=630" />
	</head>
	<body>
	<div class="container">
		<h2>GemerGraphs</h2>
		<div id="totalCountGraph" style="width:600px;height:300px;"></div>
	
<?php 
	/* build out js data array */ 
	$jsArray = "[";
	
	//foreach by key
	$keys = array_keys($days);
	foreach ($keys as $key) {
		$jsArray = $jsArray . "[" . $key . "," . $days[$key] . "], ";
	}
	
	//pull off last comma
	$jsArray = substr($jsArray, 0, (strlen($jsArray) - 2)) . "]";
?>
	<script type="text/javascript">
		//render dates
		var dates = <?php echo($jsArray); ?>;
		
		//render graph
		var f = Flotr.draw($('totalCountGraph'), [ dates ], {	
			xaxis: {
				noTicks: <?php echo count($days); ?>,
				tickDecimals: 0,
				tickFormatter: function (n){
					//js expect unix time in miliseconds instead of seconds
					var currentItem = new Date(n * 1000)
					return currentItem.toDateString();
				}
			}
		});
	</script>
	</div>
	</body>
</html>