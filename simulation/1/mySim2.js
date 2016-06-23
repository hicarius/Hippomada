/**
 * @DEBUT : LES FONCTIONS POPUR AFFICHAGE DU CANVAS
 */

function init() {
    stage = new createjs.Stage(document.getElementById("raceCanvas"));
    w = stage.canvas.width;
    h = stage.canvas.height;

    loader = new createjs.LoadQueue(false);
    loader.addEventListener("complete", loadComplete);

    manifest = [
        {src: "land/sky-01.jpg", id: "sky"},
        {src: "land/herbe.jpg", id: "ground"},
        {src: "land/rail-01.png", id: "rail"},
        {src: "land/rail-herbe-02.png", id: "rail2"},
        {src: "land/tree-01.png", id: "tree"},
    ];
    loader.loadManifest(manifest, true, "../images/");

}

function loadComplete()
{
    //création du scène
    createScene();

    //cheval en course
    $.each(race.horses, function(i, item){
        //création du chéval
        var horsesData = {
            framerate: item.b_framerate,
            images: ["../images/" + race.type + "/50Horse" + item.color + ".png"],
            frames: {"width": 160, "height": 120, "count": 12},
            animations: {}
        };

        horseObject = createHorse(horsesData, firstLine + i);
    });

    text = new createjs.Text("Dist. : " + distance, "20px Arial", "#ff7700");
    text.y = 100;
    text.textBaseline = "alphabetic";
    stage.addChild(text);

    createjs.Ticker.setFPS(30);
    createjs.Ticker.addEventListener("tick", handleTick);
}

function handleTick(event)
{
    if( hasHorseMiddle() ){
        generateHorseVitesse(horseFirst);
        var deltaS = event.delta / 1000;
        ground.x = (ground.x - deltaS * 150) % ground.tileW;
        rail.x = (rail.x - deltaS * 150) % rail.tileW;
        rail2.x = (rail2.x - deltaS * 110) % rail2.tileW;
        tree.x = (tree.x - deltaS * 80) % tree.tileW;
        sky.x = (sky.x - deltaS * 3) % sky.tileW;

    }else{
        $.each(horses, function(i, item){
            item.x += 2;
            horseUp[item.id] = false;
        });
    }

    synchronizeHorseObject();

    //distance
    text.text = "Dist. : " + distance + "/" + maxDistance + "m";
    if(count%6 == 0) {
        distance++;
    }
    count++;

    stage.update(event);

}

function createScene()
{
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

    var rail2Img = loader.getResult("rail2");
    rail2 = new createjs.Shape();
    rail2.graphics.beginBitmapFill(rail2Img).drawRect(0, 0, w + rail2Img.width, rail2Img.height);
    rail2.tileW = rail2Img.width;
    rail2.y = h - rail2Img.height -  groundImg.height;

    var treeImg = loader.getResult("tree");
    tree = new createjs.Shape();
    tree.graphics.beginBitmapFill(treeImg).drawRect(0, 0, w + treeImg.width, treeImg.height);
    tree.tileW = treeImg.width;
    tree.y = h - groundImg.height - rail2Img.height - treeImg.height + 10;

    stage.addChild(sky, ground, tree, rail2, rail);
    firstLine  = rail.y - 40;
}

function createHorse(data, begin)
{
    //Horse sprite
    var horse = new createjs.SpriteSheet(data);
    var horseSprite = new createjs.Sprite(horse, "run");
    horseSprite.y = begin;
    horseSprite.spriteSheet.framerate += (horseSprite.id+3);
    horses.push(horseSprite);

    //Jockey casaque sprite
    var casaque =  new createjs.SpriteSheet(
        {
            images: ["../images/galop/50JockeySilk.png"],
            frames: {"width":160, "height":120, "count": 12},
            animations: {}
        }
    );
    var casaqueSprite = new createjs.Sprite(casaque, "run");
    casaqueSprite.y = horseSprite.y; //synchronisation avec horse.y
    casaqueSprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate; //synchronisation avec horse.framerate
    casaques.push(casaqueSprite);

    //Jockey pantalon, ombre sprite
    var pant =  new createjs.SpriteSheet(
        {
            images: ["../images/galop/50Static.png"],
            frames: {"width":160, "height":120, "count": 12},
            animations: {}
        }
    );
    var pantSprite = new createjs.Sprite(pant, "run");
    pantSprite.y = horseSprite.y; //synchronisation avec horse.y
    pantSprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate; //synchronisation avec horse.framerate
    pants.push(pantSprite);

    //Ajout des sprites (horse, casaque, jockeys) dans la scène
    stage.addChild(horseSprite,casaqueSprite, pantSprite);

    //numéro du chéval dans la course
    var number =  new createjs.SpriteSheet(
        {
            images: ["../images/galop/50Unit_" +  (horses.length) + ".png"],
            frames: {"width":160, "height":120, "count": 12},
            animations: {}
        }
    );
    var numberSprite = new createjs.Sprite(number, "run");
    numberSprite.y = horseSprite.y; //synchronisation avec horse.y
    numberSprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate; //synchronisation avec horse.framerate
    numbers.push(numberSprite);

    stage.addChild(numberSprite);
}

function synchronizeHorseObject(){
    $.each(horses, function(i, item){
        casaques[i].x = item.x;
        pants[i].x = item.x;
        numbers[i].x = item.x;
    });
}
/**
 * @FIN : LES FONCTIONS POPUR AFFICHAGE DU CANVAS
 */



/**
 * @DEBUT : LES FONCTIONS NECESSAIRES POUR SIMULER LA COURSE
 */
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
            if(item.x > -200 && horseUp[item.id] == false){
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

/**
 * @FIN : LES FONCTIONS NECESSAIRES POUR SIMULER LA COURSE
 */
