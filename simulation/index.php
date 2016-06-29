<!DOCTYPE html>
<html>
	<head>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<script src="libs/jquery.min.js"></script>
		<script src="libs/easeljs-NEXT.combined.js"></script>
		<script src="libs/preloadjs-NEXT.min.js"></script>
		<script src="libs/tweenjs-NEXT.min.js"></script>
		<script>
			$.ajax({
				method : 'post',
				dataType : 'json',
				url : '/races/simulate/id/<?php echo $_GET['r'] ?>',
				success :  function(json){
					init(json);
				}
			});
		</script>
		<script src="js/RaceJs.js"></script>
	</head>
	<body>
		<canvas id="raceCanvas" width="960" height="470"></canvas>
	</body>
</html>

