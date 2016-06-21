<!DOCTYPE html>
<html>
	<head>
		<link href="_assets/css/shared.css" rel="stylesheet" type="text/css"/>
		<link href="_assets/css/examples.css" rel="stylesheet" type="text/css"/>
		<script src="_assets/js/examples.js"></script>
		<script src="lib/jquery.min.js"></script>
		<script src="_assets/libs/preloadjs-NEXT.min.js"></script>

		<script src="lib/easeljs-NEXT.combined.js"></script>
		<script id="editable">
			var stage, w, h, loader;
			var ground1, ground2, hill1, sky;
			var horses = [], horseFirst;
			var middleReach = false;
			var horseUp = [];
			var middleCanvas;

			function init() {
				stage = new createjs.Stage(document.getElementById("testCanvas"));
				middleCanvas = stage.canvas.width / 2;
				w = stage.canvas.width;
				h = stage.canvas.height;
				manifest = [
					{src: "sp2.png", id: "horse"},
					{src: "sky.png", id: "sky"},
					{src: "h-ground.png", id: "ground"},
					{src: "h-ground2.png", id: "ground2"},
					{src: "h-hill1.png", id: "hill"}
				];

				loader = new createjs.LoadQueue(false);
				loader.addEventListener("complete", handleComplete);
				loader.loadManifest(manifest, true, "../sprite/");

			}

			function handleComplete()
			{
				sky = new createjs.Shape();
				sky.graphics.beginBitmapFill(loader.getResult("sky")).drawRect(0, 0, w, h);

				var groundImg = loader.getResult("ground");
				ground = new createjs.Shape();
				ground.graphics.beginBitmapFill(groundImg).drawRect(0, 0, w + groundImg.width, groundImg.height);
				ground.tileW = groundImg.width;
				ground.y = h - groundImg.height;

			  	var groundImg2 = loader.getResult("ground2");
				ground1 = new createjs.Shape();
				ground1.graphics.beginBitmapFill(groundImg2).drawRect(0, 0, w + groundImg2.width, groundImg2.height);
				ground1.tileW = groundImg2.width;
				ground1.y = h - groundImg.height - groundImg2.height;

				var hillImg = loader.getResult("hill");
				hill = new createjs.Shape();
				hill.graphics.beginBitmapFill(hillImg).drawRect(0, 0, w + hillImg.width, hillImg.height);
				hill.tileW = hillImg.width;
				hill.y = h - groundImg.height - groundImg2.height - hillImg.height;

				stage.addChild(sky, ground, ground1, hill);

				var horsesData = [
					{
						framerate:15,
						images: ["../sprite/sp2.png"],
						frames: {"width":150, "height":97, "count": 12},
						animations: {

						}
					},
					{
						framerate:15,
						images: ["../sprite/sp2.png"],
						frames: {"width":150, "height":97, "count": 12},
						animations: {

						}
					},
					{
						framerate:15,
						images: ["../sprite/sp2.png"],
						frames: {"width":150, "height":97, "count": 12},
						animations: {

						}
					}
				];

				$.each(horsesData, function(i, item){
					horseObject = horse(item, ground.y + (i*10));
					stage.addChild(horseObject);
					horses.push(horseObject);
				});


				createjs.Ticker.addEventListener("tick", handleTick);

				function handleTick(event) {
					if( hasHorseMiddle() ){
						generateHorseVitesse(horseFirst);
						var deltaS = event.delta / 1000;
						ground.x = (ground.x - deltaS * 150) % ground.tileW;
						ground1.x = (ground1.x - deltaS * 50) % ground1.tileW;
						hill.x = (hill.x - deltaS * 20) % hill.tileW;

					}else{
						$.each(horses, function(i, item){
							item.x += 2;
							horseUp[item.id] = false;
						});
					}

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

			function horse(data, begin)
			{
				var horse = new createjs.SpriteSheet(data);
				var object = new createjs.Sprite(horse, "run");
				object.y = begin;
				object.spriteSheet.framerate += (object.id+3);
				stage.addChild(object);
				return object;
			}

		</script>
	</head>
	<body onload="init();">
		<canvas id="testCanvas" width="960" height="500"></canvas>
	</body>
</html>
