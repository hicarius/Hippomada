<!DOCTYPE html>
<html>
	<head>
		<link href="_assets/css/shared.css" rel="stylesheet" type="text/css"/>
		<link href="_assets/css/examples.css" rel="stylesheet" type="text/css"/>
		<script src="_assets/js/examples.js"></script>
		<script src="lib/easeljs-NEXT.combined.js"></script>
		<script id="editable">
			var stage;
			function init() {
				stage = new createjs.Stage(document.getElementById("testCanvas"));

				var horse1 = {
					framerate:20,
					images: ["../sprite/sp2.png"],
					frames: {"width":150, "height":97, "count": 12},
					animations: {
						stand_h1:0,
						run_h1:[1,11],
						stand_h2:12,
						run_h2:[13,23],
					}
				};

				var horse2 = {
					framerate:28,
					images: ["../sprite/sp2.png"],
					frames: {"width":150, "height":97, "count": 12},
					animations: {
						stand_h1:0,
						run_h1:[1,11],
						stand_h2:12,
						run_h2:[13,23],
					}
				};

				var horse1SpriteSheet = new createjs.SpriteSheet(horse1);
				var animation = new createjs.Sprite(horse1SpriteSheet, "run_h1");
				animation.y = 35;
				stage.addChild(animation);

				var horse2SpriteSheet = new createjs.SpriteSheet(horse2);
				var animation2 = new createjs.Sprite(horse2SpriteSheet, "run_h1");
				animation2.y = 55;
				stage.addChild(animation2);

				// create a new stage and point it at our canvas:


				createjs.Ticker.timingMode = createjs.Ticker.RAF;
				createjs.Ticker.addEventListener("tick", stage);
			}

		</script>
	</head>
	<body onload="init();">
		<canvas id="testCanvas" width="960" height="400"></canvas>
	</body>
</html>
