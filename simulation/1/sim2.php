<!DOCTYPE html>
<html>
	<head>
		<link href="_assets/css/shared.css" rel="stylesheet" type="text/css"/>
		<link href="_assets/css/examples.css" rel="stylesheet" type="text/css"/>
		<script src="_assets/js/examples.js"></script>
		<script src="lib/jquery.min.js"></script>
		<script src="_assets/libs/preloadjs-NEXT.min.js"></script>
		<script src="_assets/libs/preloadjs-NEXT.min.js"></script>

		<script src="lib/easeljs-NEXT.combined.js"></script>
		<script src="mySim2.js"></script>
		<script>
			var stage, w, h, loader;
			var sky, tree, rail2, rail, ground;
			var horsesData = [], horses = [], casaques = [], pants = [], numbers = [];
			var firstLine, distance = 0, count = 0;
			var text ;
			var distImg;

			var race = {
					"lenght": 16000,
					"type" : "galop",
					"horses": [
						{
							color: "Black",
							b_vitesse : 0.4,
							b_framerate : 15,
							vitesse : {0:2, 100:2, 200: 1, 300: 4, 400: 3}
						},
						{
							color: "Grey",
							b_vitesse : 0.1,
							b_framerate : 15,
							vitesse : {0:3, 100:4, 200: 2, 300: 4, 400: 3}
						},
						{
							color: "Bay",
							b_vitesse : 0.2,
							b_framerate : 15,
							vitesse : {0:1, 100:1, 200: 4, 300: 4, 400: 1}
						}
					]
				}
			;

			$( document ).ready(function(){
				$('#raceCanvas').attr('width', race.lenght)	;
				init();
			});
		</script>
	</head>
	<body>
		<div id="race_block" style="width: 800px; overflow: hidden;">
			<canvas id="raceCanvas" width="0" height="470"></canvas>
		</div>

	</body>
</html>
