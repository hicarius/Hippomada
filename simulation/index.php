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

		var race;

		/**
		 * 0.2 : 580m/min
		 * 0.2547169811320755: 750m/min 45km/h
		 * 0.3 : 880m/min 53km/h
		 *
		 * @type {{lenght: number, type: string, horses: *[]}}
		 */

		$.ajax({
			method : 'post',
			dataType : 'json',
			url : '/races/simulate/',
			data :  '',
			success :  function(json){
				/*race = {
					"lenght": 1000,
					"type" : "galop",
					"horses": [
						{
							name : "Jango de Tercei",
							color: "noir",
							framerate : 15.3,
							vitesse : {0:0.2547169811320755, 100:0.2547169811320755, 200: 0.2547169811320755, 300: 0.2547169811320755, 400: 0.2547169811320755, 500: 0.2547169811320755, 600: 0.2547169811320755, 700: 0.2547169811320755, 800: 0.2547169811320755, 900: 0.2547169811320755}
						}
					]
				}
				;*/
				race = json;
				init();
				chrono();
			}
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

