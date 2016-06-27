<!DOCTYPE html>
<html>
<head>
	<link href="css/style.css" rel="stylesheet" type="text/css"/>
	<script src="libs/jquery.min.js"></script>
	<script src="libs/easeljs-NEXT.combined.js"></script>
	<script src="libs/preloadjs-NEXT.min.js"></script>
	<script src="libs/tweenjs-NEXT.min.js"></script>
	<script>
		var stage, w, h, loader;
		var sky, hill, hill1, ground2, rail, ground, depart, finish;
		var horses = [], casaques = [], pants = [], numbers = [], horseFirst = false, bVitesse = [];
		var middleCanvas;
		var firstLine;
		var distance = [], distanceArray = [], lastDistance = [], nextDistance = [], classementDist = [], generalClassement =  [];
		var isResultatIsInstancied=false, classementText, standingText, raceBarIn, raceBarOut ;
		var multiplicateurVitesseEcart = 5, multiplicateurDelta = 2;
		var race = {
				"lenght": 1000,
				"type" : "galop",
				"horses": [
					{
						name : "Jango de Tercei",
						color: "Black",
						framerate : 15.3,
						vitesse : {0:0.17, 100:0.24, 200: 0.35, 300: 0.43, 400: 0.31, 500: 0.27, 600: 0.32, 700: 0.21, 800: 0.36, 900: 0.42}
					},
					{
						name : "Albatross",
						color: "Grey",
						framerate : 15.7,
						vitesse : {0:0.32, 100:0.23, 200: 0.26, 300: 0.19, 400: 0.24, 500: 0.18, 600: 0.26, 700: 0.32, 800: 0.42, 900: 0.37}
					},
					{
						name : "Je suis la",
						color: "Bay",
						framerate : 15.1,
						vitesse : {0:0.31, 100:0.43, 200: 0.34, 300: 0.22, 400: 0.14, 500: 0.26, 600: 0.24, 700: 0.37, 800: 0.39, 900: 0.28}
					},
					{
						name : "Je suis la 2",
						color: "Chestnut",
						framerate : 15,
						vitesse : {0:0.24, 100:0.31, 200: 0.35, 300: 0.29, 400: 0.21, 500: 0.19, 600: 0.28, 700: 0.36, 800: 0.41, 900: 0.37}
					},
					{
						name : "Je suis la 3",
						color: "Grey",
						framerate : 15.5,
						vitesse : {0:0.24, 100:0.42, 200: 0.37, 300: 0.29, 400: 0.21, 500: 0.17, 600: 0.27, 700: 0.38, 800: 0.43, 900: 0.37}
					},
					{
						name : "Je suis la 4",
						color: "Black",
						framerate : 15.9,
						vitesse : {0:0.21, 100:0.27, 200: 0.32, 300: 0.29, 400: 0.24, 500: 0.31, 600: 0.29, 700: 0.37, 800: 0.41, 900: 0.36}
					},
					{
						name : "Je suis la 5",
						color: "Chestnut",
						framerate : 15.6,
						vitesse : {0:0.15, 100:0.24, 200: 0.31, 300: 0.27, 400: 0.34, 500: 0.41, 600: 0.32, 700: 0.29, 800: 0.14, 900: 0.24}
					}
				]
			}
			;

		$( document ).ready(function(){
			init();
			chrono();
		});
	</script>
	<script src="js/RaceJs.js"></script>
</head>
<body>
<canvas id="raceCanvas" width="960" height="470"></canvas>
<form name="forsec">
	<input type="text" size="3" name="secb"> minute(s)
	<input type="text" size="3" name="seca"> secondes
	<input type="text" size="3" name="secc"> dixièmes


	<input type="button" value="RaZ" onclick="rasee()">
	<input type="button" value="Tempo" onclick="clearTimeout(compte); $('#distance7').val(distance)">
	//arrête temporairement la fonction chrono()
	<input type="text" id="distance7" value="" />
</form>
</body>
</html>

