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
		<script src="_assets/js/SpriteContainer.js"></script>
		<script id="editable">
			var stage, w, h, loader;
			var sky, hill, hill1, ground2, rail, ground;
			var horses = [], jockeys = [], statics = [], numbers = [], horseFirst;
			var middleReach = false;
			var horseUp = [];
			var middleCanvas;
			var firstLine;

			function init() {
				stage = new createjs.Stage(document.getElementById("testCanvas"));
				middleCanvas = stage.canvas.width / 2;
				w = stage.canvas.width;
				h = stage.canvas.height;

				loader = new createjs.LoadQueue(false);
				loader.addEventListener("complete", handleComplete);

				manifest = [
					{src: "Sky08.jpg", id: "sky"},
					{src: "grass2.jpg", id: "ground"},
					{src: "Rail-Back.png", id: "rail"},
					{src: "Rail-Back-2.png", id: "ground2"},
					{src: "tree-1.png", id: "hill"},
				];
				loader.loadManifest(manifest, true, "../sprite/real/");

			}

			function createScene()
			{
				//sky = new createjs.Shape();
				//sky.graphics.beginBitmapFill(loader.getResult("sky")).drawRect(0, 0, w, h);
				var skyImg = loader.getResult("sky");
				sky = new createjs.Shape();
				sky.graphics.beginBitmapFill(skyImg).drawRect(0, 0, w + skyImg.width, skyImg.height);
				sky.tileW = skyImg.width;
				sky.y = 0;

				var groundImg = loader.getResult("ground");
				ground = new createjs.Shape();
				ground.graphics.beginBitmapFill(groundImg).drawRect(0, 0, w + groundImg.width, groundImg.height);
				ground.tileW = groundImg.width;
				ground.y = h - groundImg.height;

				var railImg = loader.getResult("rail");
				rail = new createjs.Shape();
				rail.graphics.beginBitmapFill(railImg).drawRect(0, 0, w + railImg.width, railImg.height);
				rail.tileW = railImg.width;
				rail.y = h - groundImg.height - railImg.height + 10;

				var ground2Img = loader.getResult("ground2");
				ground2 = new createjs.Shape();
				ground2.graphics.beginBitmapFill(ground2Img).drawRect(0, 0, w + ground2Img.width, ground2Img.height);
				ground2.tileW = ground2Img.width;
				ground2.y = h - ground2Img.height -  groundImg.height;

				var hillImg = loader.getResult("hill");
				hill = new createjs.Shape();
				hill.graphics.beginBitmapFill(hillImg).drawRect(0, 0, w + hillImg.width, hillImg.height);
				hill.tileW = hillImg.width;
				hill.y = h - groundImg.height - ground2Img.height - hillImg.height + 10;

				stage.addChild(sky, ground, hill, ground2, rail);

				firstLine  = rail.y - 40;
			}

			function createHorse(data, begin)
			{
				var horse = new createjs.SpriteSheet(data);
				var jockey =  new createjs.SpriteSheet(
					{
						images: ["../sprite/real/50JockeySilk.png"],
						frames: {"width":160, "height":120, "count": 12},
						animations: {}
					}
				);
				var static =  new createjs.SpriteSheet(
					{
						images: ["../sprite/real/50Static.png"],
						frames: {"width":160, "height":120, "count": 12},
						animations: {}
					}
				);



				var horseSprite = new createjs.Sprite(horse, "run");
				var jockeySprite = new createjs.Sprite(jockey, "run");
				var staticSprite = new createjs.Sprite(static, "run");

				horseSprite.y = begin;
				horseSprite.spriteSheet.framerate += (horseSprite.id+3);

				staticSprite.y = jockeySprite.y = horseSprite.y;
				staticSprite.spriteSheet.framerate = jockeySprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate;

				stage.addChild(horseSprite,jockeySprite, staticSprite);

				horses.push(horseSprite);
				var number =  new createjs.SpriteSheet(
					{
						images: ["../sprite/real/50Unit_" +  (horses.length) + ".png"],
						frames: {"width":160, "height":120, "count": 12},
						animations: {}
					}
				);
				var numberSprite = new createjs.Sprite(number, "run");
				numberSprite.y = horseSprite.y;
				numberSprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate;
				stage.addChild(numberSprite);

				jockeys.push(jockeySprite);
				statics.push(staticSprite);
				numbers.push(numberSprite);
			}

			function synchronizeHorseObject(){
				$.each(horses, function(i, item){
					jockeys[i].x = item.x;
					statics[i].x = item.x;
					numbers[i].x = item.x;
				});
			}

			function handleComplete()
			{
				createScene();

				var horsesData = [
					{
						framerate:15,
						images: ["../sprite/real/50HorseBlack.png"],
						frames: {"width":160, "height":120, "count": 12},
						animations: {}
					},
					{
						framerate:15,
						images: ["../sprite/real/50HorseGrey.png"],
						frames: {"width":160, "height":120, "count": 12},
						animations: {}
					},
					{
						framerate:15,
						images: ["../sprite/real/50HorseBay.png"],
						frames: {"width":160, "height":120, "count": 12},
						animations: {}
					}
				];

				$.each(horsesData, function(i, item){
					horseObject = createHorse(item, firstLine + i);
				});

				createjs.Ticker.addEventListener("tick", handleTick);

				function handleTick(event) {
					if( hasHorseMiddle() ){
						generateHorseVitesse(horseFirst);
						var deltaS = event.delta / 1000;
						ground.x = (ground.x - deltaS * 150) % ground.tileW;
						rail.x = (rail.x - deltaS * 150) % rail.tileW;
						ground2.x = (ground2.x - deltaS * 110) % ground2.tileW;
						hill.x = (hill.x - deltaS * 80) % hill.tileW;
						sky.x = (sky.x - deltaS * 3) % sky.tileW;

					}else{
						$.each(horses, function(i, item){
							item.x += 2;
							horseUp[item.id] = false;
						});
					}

					synchronizeHorseObject();
					stage.update(event);
				}
			}

			function hasHorseMiddle()
			{
				if(middleReach == false) {
					$.each(horses, function (i, item) {
						if (item.x <= middleCanvas && middleReach == false) {
							item.x += item.spriteSheet.framerate - item.id;
						} else {
							middleReach = true;
							horseFirst = item;
						}
					});
				}
				return middleReach;
			}

			function generateHorseVitesse()
			{
				$.each(horses, function(i, item){
					if(item.id != horseFirst.id){
						if(item.x > -20 && horseUp[item.id] == false){
							item.x -= 4;
						}else{
							item.x += 4;
							if(horseUp[item.id] == false || horseUp[item.id] == null){
								horseUp[item.id] = true;
							}

							if(item.x > middleCanvas && middleReach == true) {
								item.x =  middleCanvas;
								horseFirst = item;
								horseUp[item.id] = false;
							}
						}
					}
				});
			}



		</script>
	</head>
	<body onload="init();">
		<canvas id="testCanvas" width="960" height="470"></canvas>
	</body>
</html>
