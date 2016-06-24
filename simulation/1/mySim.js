/**
 * @DEBUT : LES FONCTIONS POPUR AFFICHAGE DU CANVAS
 */

function init() {
    stage = new createjs.Stage(document.getElementById("raceCanvas"));
    w = stage.canvas.width;
    h = stage.canvas.height;
    middleCanvas = w/2;

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
        createHorse( item, firstLine + i );
    });

    text = new createjs.Text("", "20px Arial", "#ff7700");
    text.y = 20;
    text.textBaseline = "alphabetic";
    stage.addChild(text);

    createjs.Ticker.setFPS(60);
    createjs.Ticker.addEventListener("tick", handleTick);
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
    var horse = new createjs.SpriteSheet({
        framerate: data.framerate * multiplicateurVitesse,
        images: ["../images/" + race.type + "/50Horse" + data.color + ".png"],
        frames: {"width": 160, "height": 120, "count": 12},
        animations: {}
    });
    var horseSprite = new createjs.Sprite(horse, "run");
    horseSprite.y = begin;
    horseSprite.x = (w/2) - 200;
    horses.push(horseSprite);
    bVitesse.push(data.vitesse[0]);

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

    distance.push({l:0, c:0, f:false}); //l: lenght, c: current key, f: is updated
}

function handleTick(event)
{
    if(middleReach == false) {
        animationScene(event);
        $.each(horses, function (i, item) {
            if (item.x <= middleCanvas && middleReach == false) {
                testDistance(i);
                if( distance[i].f == true && distance[i].c % 100 ==0 ){
                    lastVitesse[i] = currentVitesse[i];
                    currentVitesse[i] = race.horses[i].vitesse[distance[i].c];
                }else{
                    currentVitesse[i] = race.horses[i].vitesse[0];
                }

                var maxV = Math.max.apply(null, currentVitesse);
                if(maxV > currentVitesse[i]){
                    item.x -= (maxV + currentVitesse[i])*multiplicateurVitesseEcart ;
                }else if(maxV == currentVitesse[i]){
                    item.x += race.horses[i].vitesse[0]*multiplicateurVitesseEcart ;
                }

                distance[i].l += currentVitesse[i];
                curDistance[i] = distance[i].l;
            } else {
                if(middleReach == false) {
                    middleReach = true;
                    horseFirst = item;
                }
            }
        });
    }else{
        if( Math.max.apply(null, curDistance) > race.lenght ){
            $.each(horses, function (i, item) {
                testDistance(i);
                if( distance[i].f == true && distance[i].c % 100 ==0 ){
                    lastVitesse[i] = currentVitesse[i];
                    currentVitesse[i] = race.horses[i].vitesse[distance[i].c];
                }else{
                    currentVitesse[i] = race.horses[i].vitesse[0];
                }
                if(distance[i].l < 300){
                    item.x += (currentVitesse[i]*multiplicateurVitesseEcart)*10 ;
                    distance[i].l += currentVitesse[i];
                }

            });
        }else{
            if( middleReach  ){
                generateHorseVitesse();
            }
            animationScene(event);
        }
    }

    synchronizeHorseObject();

    //Debugger
    text.text = "Dist. : " + race.lenght + "m \n";
    if( race.horses.length >= 1)
        text.text += "cv-h1 : " + currentVitesse[0] + " / lv-h1 : " + lastVitesse[0] + " / x : " + horses[0].x + " / y: " + horses[0].y + " / dist1 : " + distance[0].l + "\n";

    if( race.horses.length >= 2)
        text.text += "cv-h2 : " + currentVitesse[1] + " / lv-h2 : " + lastVitesse[1] + " / x : " + horses[1].x + " / y: " + horses[1].y + " / dist2 : " + distance[1].l + "\n";

    if( race.horses.length >= 3)
        text.text += "cv-h3 : " + currentVitesse[2] + " / lv-h3 : " + lastVitesse[2] + " / x : " + horses[2].x + " / y: " + horses[2].y + " / dist3 : " + distance[2].l + "\n";

    stage.update(event);

}

function synchronizeHorseObject(){
    $.each(horses, function(i, item){
        casaques[i].x = item.x;
        pants[i].x = item.x;
        numbers[i].x = item.x;
    });
}

function animationScene(event)
{
    var deltaS = event.delta / 1000 * multiplicateurVitesse;
    ground.x = (ground.x - deltaS * 150) % ground.tileW;
    rail.x = (rail.x - deltaS * 150) % rail.tileW;
    rail2.x = (rail2.x - deltaS * 110) % rail2.tileW;
    tree.x = (tree.x - deltaS * 80) % tree.tileW;
    sky.x = (sky.x - deltaS * 3) % sky.tileW;
}

/**
 * @FIN : LES FONCTIONS POPUR AFFICHAGE DU CANVAS
 */



/**
 * @DEBUT : LES FONCTIONS NECESSAIRES POUR SIMULER LA COURSE
 */
function generateHorseVitesse()
{
    ecartP[0] = false;
    $.each(horses, function(i, item){
        if( distance[i].l < 100){
            var maxV = Math.max.apply(null, bVitesse);
            if(maxV > bVitesse[i]){
                item.x -= (maxV + bVitesse[i])*multiplicateurVitesseEcart ;
            }else if(maxV == bVitesse[i]){
                item.x += bVitesse[i]*multiplicateurVitesseEcart ;
            }

            distance[i].l += bVitesse[i];
            curDistance[i] = distance[i].l;
        }else {
            var ecart;
            testDistance(i);
            if (distance[i].f == true && distance[i].c % 100 == 0) {
                lastVitesse[i] = currentVitesse[i];
                currentVitesse[i] = race.horses[i].vitesse[distance[i].c];
            }

            distance[i].l += currentVitesse[i];
            curDistance[i] = distance[i].l;

            // si nouvelle vitesse inférieur à l'anciene
            if (lastVitesse[i] < currentVitesse[i]) {
                ecart = currentVitesse[i] - lastVitesse[i];

                // si cheval n'est pas le premier
                if (item.id != horseFirst.id) {
                    // reduction du course avec l'ecart
                    item.x += ecart * multiplicateurVitesseEcart;
                } else {
                    ecartP[0] = true;
                    ecartP[1] = ecart;
                    ecartP[2] = '+';
                    ecartP[3] = currentVitesse[i];
                }


                // sinon
            } else if (lastVitesse[i] > currentVitesse[i]) {
                ecart = lastVitesse[i] - currentVitesse[i];

                // si cheval n'est pas le premier
                if (item.id != horseFirst.id) {
                    // augmentation du course avec l'ecart
                    item.x -= ecart * multiplicateurVitesseEcart;
                } else {
                    ecart = lastVitesse[i] - currentVitesse[i];
                    //si premier
                    ecartP[0] = true;
                    ecartP[1] = ecart;
                    ecartP[2] = '-';
                    ecartP[3] = currentVitesse[i];
                }
            }

            if (ecartP[0] == true) {
                $.each(horses, function (i, item) {
                    if (item.id != horseFirst.id) {
                        if (ecartP[3] > currentVitesse[i]) { //si first vitesse > current vitesse
                            item.x -= (ecartP[3] - currentVitesse[i]) * multiplicateurVitesseEcart;
                        } else if (ecartP[3] < currentVitesse[i]) { //si first vitesse < current vitesse
                            item.x += (currentVitesse[i] - ecartP[3]) * multiplicateurVitesseEcart;
                        }

                    }
                });
            }


            if (item.x >= middleCanvas) {
                horseFirst = item;
            }
        }
    });

}

function testDistance(i)
{
    $.each( distanceArray, function(x, item){
        distance[i].f = false;
        if(distance[i].c != item) {
            if (distance[i].l >= item && distance[i].l < distanceArray[x + 1]) {
                distance[i].c = item;
                distance[i].f = true;
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
