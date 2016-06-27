/**
 * @DEBUT : LES FONCTIONS POPUR AFFICHAGE DU CANVAS
 */

function init() {
    prepareData();

    stage = new createjs.Stage(document.getElementById("raceCanvas"));
    stage.enableMouseOver(10);

    w = stage.canvas.width;
    h = stage.canvas.height;
    middleCanvas = w -(w/3);

    loader = new createjs.LoadQueue(false);
    loader.addEventListener("complete", loadComplete);

    manifest = [
        {src: "land/sky-01.jpg", id: "sky"},
        {src: "land/herbe.jpg", id: "ground"},
        {src: "land/rail-01.png", id: "rail"},
        {src: "land/rail-herbe-02.png", id: "rail2"},
        {src: "land/tree-01.png", id: "tree"},
        {src: "land/herbe-depart.jpg", id: "depart"},
        {src: "land/FinishPole.png", id: "finish"},
        {src: "land/resultat.png", id: "resultat"},
    ];
    loader.loadManifest(manifest, true, "images/");

}

function prepareData()
{
    for(var j = 0; j <= race.lenght; j+=100){
        distanceArray.push(j);
    }

    $.each(distanceArray, function(i, dist){
        var m = [];
        $.each(race.horses, function(j, item) {
            m.push(item.vitesse[dist]);
        });
        bVitesse[dist] = m;
    });
}

function loadComplete()
{
    //création du scène
    createScene();

    //cheval en course
    $.each(race.horses, function(i, item){
        //création du chéval
        createHorse( item, firstLine + i );
    });

    affichageDesTextes();

    createjs.Ticker.setFPS(60);
    createjs.Ticker.addEventListener("tick", handleTick);
}

function affichageDesTextes()
{
    //Texte qui affiche les classements pendant la course
    classementText = new createjs.Text("", "bold 12px Verdana", "#ffffff");
    classementText.y = 10;
    classementText.x = 5;
    classementText.textBaseline = "alphabetic";
    classementText.cursor =  'pointer';
    //classementText.outline =  1;
    stage.addChild(classementText);
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

    var departImg = loader.getResult("depart");
    depart = new createjs.Bitmap(departImg);
    depart.tileW = departImg.width;
    depart.y = h - departImg.height;
    depart.x = (w/2) + 100;

    var finishImg = loader.getResult("finish");
    finish = new createjs.Bitmap(finishImg);
    finish.tileW = departImg.width;
    finish.y = h - rail2.y + 60;
    finish.x = (w/2) + 100;

    stage.addChild(sky, ground, depart, tree, rail2, rail);

    var raceBarOutG = new createjs.Graphics();
    raceBarOutG.beginFill(createjs.Graphics.getRGB(0,0,0));
    raceBarOutG.drawRect(0,0,110,24);
    raceBarOut = new createjs.Shape(raceBarOutG);
    raceBarOut.x = 20;
    raceBarOut.y = 420;

    var raceBarInG = new createjs.Graphics();
    raceBarInG.beginFill(createjs.Graphics.getRGB(255,255,255));
    raceBarInG.drawRect(2,2,100,20);
    raceBarIn = new createjs.Shape(raceBarInG);
    raceBarIn.graphics.command.w = 0;
    raceBarIn.x = 20;
    raceBarIn.y = 420;

    var raceLenght = new createjs.Text(race.lenght + "m", "bold 12px Verdana", "#ffffff");
    raceLenght.y = 435;
    raceLenght.x = 130;
    raceLenght.textBaseline = "alphabetic";

    stage.addChild(raceBarOut, raceBarIn, raceLenght);



    firstLine  = rail.y - 40;
}

function createHorse(data, begin)
{
    //Horse sprite
    var horse = new createjs.SpriteSheet({
        framerate: data.framerate * multiplicateurDelta,
        images: ["images/" + race.type + "/50Horse" + data.color + ".png"],
        frames: {"width": 160, "height": 120, "count": 12},
        animations: {"run" : [0, 11], "standby" : 0 }
    });
    var horseSprite = new createjs.Sprite(horse, "run");
    horseSprite.y = begin;
    horseSprite.x = (w/2);
    horses.push(horseSprite);
    bVitesse.push(data.vitesse[0]);

    //Jockey casaque sprite
    var casaque =  new createjs.SpriteSheet(
        {
            images: ["images/galop/50JockeySilk.png"],
            frames: {"width":160, "height":120, "count": 12},
            animations: {"run" : [0, 11], "standby" : 0 }
        }
    );
    var casaqueSprite = new createjs.Sprite(casaque, "run");
    casaqueSprite.y = horseSprite.y; //synchronisation avec horse.y
    casaqueSprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate; //synchronisation avec horse.framerate
    casaques.push(casaqueSprite);

    //Jockey pantalon, ombre sprite
    var pant =  new createjs.SpriteSheet(
        {
            images: ["images/galop/50Static.png"],
            frames: {"width":160, "height":120, "count": 12},
            animations: {"run" : [0, 11], "standby" : 0 }
        }
    );
    var pantSprite = new createjs.Sprite(pant, "run");
    pantSprite.y = horseSprite.y; //synchronisation avec horse.y
    pantSprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate; //synchronisation avec horse.framerate
    pants.push(pantSprite);

    //Ajout des sprites (horse, casaque, jockeys) dans la scène
    stage.addChild(horseSprite, casaqueSprite, pantSprite);

    //numéro du chéval dans la course
    var number =  new createjs.SpriteSheet(
        {
            images: ["images/galop/50Unit_" +  (horses.length) + ".png"],
            frames: {"width":160, "height":120, "count": 12},
            animations: {"run" : [0, 11], "standby" : 0 }
        }
    );
    var numberSprite = new createjs.Sprite(number, "run");
    numberSprite.y = horseSprite.y; //synchronisation avec horse.y
    numberSprite.spriteSheet.framerate = horseSprite.spriteSheet.framerate; //synchronisation avec horse.framerate
    numbers.push(numberSprite);

    stage.addChild(numberSprite);

    distance.push({l:0, c:0, id:horses.length}); //l: lenght, c: current key
}

function handleTick(event)
{
    animationScene(event);
    synchronizeHorseObject();

    if( Math.max.apply(null, nextDistance) > race.lenght ) {
        $.each(horses, function (i, item) {
            testDistance(i);
            if(item.x < 1000) {
                if (distance[i].l > race.lenght) {
                    item.x += 5;
                } else {
                    item.x += bVitesse[distance[i].c][i] * 15;
                    distance[i].l += bVitesse[distance[i].c][i];
                }
            }else{
                var isRegitred = false;
                $.each(generalClassement, function(x, item_x){
                    if( item_x.id == i){
                        isRegitred = true;
                    }
                });
                if( isRegitred == false ){
                    generalClassement.push({id: i, name: race.horses[i].name});
                }
                classement(true);
            }
        });
    }else {
        classement();
        $.each(horses, function (i, item) {
            //si position du cheval > milieu
            if (item.x > middleCanvas) {
                //on assigne le premier cheval
                horseFirst = item;
                //on reset tout les postions en fonction du milieu
                resetHorsesX(item);
            }

            testDistance(i);
            if (item != horseFirst) {
                var maxV = Math.max.apply(null, bVitesse[distance[i].c]);
                if (maxV > bVitesse[distance[i].c][i]) {
                    ///item.x -= (maxV - bVitesse[distance[i].c][i]) * multiplicateurVitesseEcart;
                    synchronizeHorseFramerate(i, race.horses[i].framerate - 2);
                } else {
                    if (horseFirst == false) {
                        //item.x += bVitesse[distance[i].c][i] * multiplicateurVitesseEcart;
                        synchronizeHorseFramerate(i, race.horses[i].framerate + 2);
                    }
                }
            } else {
                var lastVitesse = ((distance[i].c - 100) <= 0) ? 0 : (distance[i].c - 100);
                if (bVitesse[distance[i].c][i] > bVitesse[lastVitesse][i]) {
                    $.each(horses, function (x, item_x) {
                        if (item_x != horseFirst) {
                            //item_x.x -= (bVitesse[distance[x].c][i] - bVitesse[lastVitesse][i]) * multiplicateurVitesseEcart;
                        }
                    });
                } else if (bVitesse[distance[i].c][i] < bVitesse[lastVitesse][i]) {
                    $.each(horses, function (x, item_x) {
                        if (item_x != horseFirst) {
                            //item_x.x += (bVitesse[lastVitesse][i] - bVitesse[distance[x].c][i]) * multiplicateurVitesseEcart;
                        }
                    });
                }
            }

            lastDistance[i] = distance[i].l;
            distance[i].l += bVitesse[distance[i].c][i];
            nextDistance[i] = distance[i].l;

            item.x += (nextDistance[i] - lastDistance[i]) * 11;
        });
    }

    stage.update(event);
}

function synchronizeHorseObject(){
    $.each(horses, function(i, item){
        casaques[i].x = item.x;
        pants[i].x = item.x;
        numbers[i].x = item.x;
    });
}

function synchronizeHorseFramerate(i, framerate)
{
    casaques[i].spriteSheet.framerate = framerate * multiplicateurDelta;
    pants[i].spriteSheet.framerate = framerate * multiplicateurDelta;
    numbers[i].spriteSheet.framerate = framerate * multiplicateurDelta;
    horses[i].spriteSheet.framerate = framerate * multiplicateurDelta;
}

function horseStop(i)
{
    horses[i].gotoAndStop("standby");
    casaques[i].gotoAndStop("standby");
    pants[i].gotoAndStop("standby");
    numbers[i].gotoAndStop("standby");
}

function resetHorsesX(horse){
    var ecart = horse.x - middleCanvas ;
    $.each(horses, function (i, item){
        item.x -= ecart;
    });
}

function animationScene(event)
{
    var stopSlide = false;
    if( Math.max.apply(null, nextDistance) < race.lenght ) {
        var deltaS = event.delta / 1000 * multiplicateurDelta;
        ground.x = (ground.x - deltaS * 150) % ground.tileW;
        rail.x = (rail.x - deltaS * 150) % rail.tileW;
        rail2.x = (rail2.x - deltaS * 110) % rail2.tileW;
        tree.x = (tree.x - deltaS * 80) % tree.tileW;
        sky.x = (sky.x - deltaS * 3) % sky.tileW;
    }else{
        stopSlide =  true;
    }

    //depart
    if(depart.x > -300 && stopSlide == false ){
        depart.x -= (deltaS * 150);
    }else{
        if(stage.getChildIndex(depart) != -1) {
            stage.removeChild(depart);
        }
    }

    //finish
    if( Math.max.apply(null, nextDistance) >= (race.lenght - ( (race.lenght +200)/100))){
        if(stage.getChildIndex(finish) == -1) {
            finish.x = 1000;
            stage.addChildAt(finish,5);
        }
        if(stopSlide == false) {
            finish.x -= (deltaS * 150);
        }
    }
}

function classement(finalResult)
{
    classementText.text = 'CLASSEMENT : \n';
    if(finalResult == true){
        classementText.visible = false;
        //Image de fonds
        if(isResultatIsInstancied == false) {
            var resultatImg = loader.getResult("resultat");
            var resultat = new createjs.Bitmap(resultatImg);
            resultat.tileW = resultatImg.width;
            resultat.y = 40;
            resultat.x = 400;
            stage.addChild(resultat);

            //Texte qui s'affiche dès que la course arrive au finish line
            standingText = new createjs.Text("", "bold 15px Verdana", "#000");
            standingText.x = 570;
            standingText.y = 57;
            standingText.textBaseline = "alphabetic";
            stage.addChild(standingText);
            isResultatIsInstancied = true;
        }
        standingText.text = "";
        $.each(generalClassement, function (i, item){
            if( i < 7) {
                standingText.text += (item.id + 1);
                if (i < (generalClassement.length - 1) && i < 6) {
                    standingText.text += " - "
                }
            }
        });
    }else {
        classementDist = distance.slice();
        classementDist.sort( function(a, b){
            if (a.l < b.l)
                return 1;
            if (a.l > b.l)
                return -1;
            return 0;
        });
        $.each(classementDist, function (i, item) {
            classementText.text += item.id + " - " + race.horses[item.id - 1].name + " \n";
        });

        //actualiser race bar
        var m = 100;
        var t = Math.max.apply(null, nextDistance);
        var add_b = 100 * t / race.lenght;
        raceBarIn.graphics.command.w = add_b;
    }
}

/**
 * @FIN : LES FONCTIONS POPUR AFFICHAGE DU CANVAS
 */



/**
 * @DEBUT : LES FONCTIONS NECESSAIRES POUR SIMULER LA COURSE
 */
function testDistance(i)
{
    $.each( distanceArray, function(x, item){
        if(distance[i].c != item) {
            if (distance[i].l >= item && distance[i].l < distanceArray[x + 1]) {
                distance[i].c = item;
                return false;
            }
        }
    });
}


var centi = 0; // initialise les dixtièmes
var secon = 0; //initialise les secondes
var minu = 0; //initialise les minutes

function chrono(){
    centi++; //incrémentation des dixièmes de 1
    if (centi > 9){centi = 0;secon++} //si les dixièmes > 9, on les réinitialise à 0 et on incrémente les secondes de 1
    if (secon >59){secon = 0;minu++} //si les secondes > 59, on les réinitialise à 0 et on incrémente les minutes de 1
    document.forsec.secc.value = " "+centi; //on affiche les dixièmes
    document.forsec.seca.value = " "+secon; //on affiche les secondes
    document.forsec.secb.value = " "+minu; //on affiche les minutes
    compte = setTimeout('chrono()',100); //la fonction est relancée tous les 10° de secondes
}

function rasee(){ //fonction qui remet les compteurs à 0
    clearTimeout(compte); //arrête la fonction chrono()
    centi=0;
    secon=0;
    minu=0;
    document.forsec.secc.value=" "+centi;
    document.forsec.seca.value=" "+secon;
    document.forsec.secb.value=" "+minu;
}

Array.prototype.max = function() {
    return Math.max.apply(null, this);
};

Array.prototype.min = function() {
    return Math.min.apply(null, this);
};

/**
 * @FIN : LES FONCTIONS NECESSAIRES POUR SIMULER LA COURSE
 */
