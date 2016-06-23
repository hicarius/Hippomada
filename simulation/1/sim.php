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
		<script>
			var stage, w, h, loader;
			var sky, hill, hill1, ground2, rail, ground;
			var horses = [], casaques = [], pants = [], numbers = [], horseFirst, lastVitesse = [], currentVitesse = [];
			var middleReach = false;
			var horseUp = [];
			var middleCanvas;
			var firstLine;
			var distance = 0, count = 0, updateDistance = false;
			var text ;
			var distImg;
			var multiplicateurVitesse = 2, ecartP = [false, 0];

			var race = {
					"lenght": 1000,
					"type" : "galop",
					"horses": [
						{
							color: "Black",
							framerate : 14,
							vitesse : {0:2, 100:2, 200: 1, 300: 4, 400: 3}
						},
						{
							color: "Grey",
							framerate : 18,
							vitesse : {0:3, 100:4, 200: 2, 300: 4, 400: 1}
						},
						{
							color: "Bay",
							framerate : 13,
							vitesse : {0:1, 100:3, 200: 4, 300: 2, 400: 1}
						}
					]
				}
				;

			$( document ).ready(function(){
				init();
			});
		</script>
		<script src="mySim.js"></script>
	</head>
	<body>
		<canvas id="raceCanvas" width="960" height="470"></canvas>
	</body>
</html>
