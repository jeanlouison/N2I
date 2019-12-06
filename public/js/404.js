var canvas = document.getElementById("game");

var myGameArea = {
    start : function() {
        this.context = canvas.getContext("2d");
        this.interval = setInterval(updateGameArea, 20);
        window.addEventListener('keydown', function (e) {
            myGameArea.keys = (myGameArea.keys || []);
            myGameArea.keys[e.keyCode] = (e.type == "keydown");
        })
        window.addEventListener('keyup', function (e) {
            myGameArea.keys[e.keyCode] = (e.type == "keydown");
        })
    },
    clear : function(){
        this.context.clearRect(0, 0, canvas.width, canvas.height);
    }
}

myGameArea.start();

var myGamePiece;
var ticks = 0;
var doors = [];
var pages = ["Accueil", "Outils", "Forum", "CSGROUP", "Se connecter", "Se créer un compte"]
var links = ["https://maths.1d-works.fr//", "https://maths.1d-works.fr//outils/categories", "https://maths.1d-works.fr//CSGROUP",
    "https://maths.1d-works.fr//forum/categories", "https://maths.1d-works.fr//signin", "https://maths.1d-works.fr//signup"];

var Background = new background(1920, 1080, "/storage/2D/couloir.png", 0, -320, "image");
myGamePiece = new component(428, 240, "/storage/2D/robot_side2.png", 10, 250, "image");
pages.forEach(add_door);

function add_door(item, index) {
    doors[index] = new door(14 + (index*603), 196, links[index], "/storage/2D/door_closed.png");
}

function door(x, y, link, image) {
    this.type = "image";
    this.image = new Image();
    this.image.src = image;
    this.width = 614;
    this.height = 273;
    this.link = link;
    this.x = x;
    this.y = y;
    this.gamearea = myGameArea;
    this.update = function() {
        console.log("Oui.")
        ctx = myGameArea.context;
        if (this.type == "image") {
            ctx.drawImage(this.image,
                this.x,
                this.y,
                this.width, this.height);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    }
}

function background(width, height, color, x, y, type) {
    this.type = type;
    if (type == "image") {
        this.image = new Image();
        this.image.src = color;
    }
    this.gamearea = myGameArea;
    this.width = width;
    this.height = height;
    this.gamearea = myGameArea
    this.x = x;
    this.y = y;
    this.update = function() {
        ctx = myGameArea.context;
        if (this.type == "image") {
            ctx.drawImage(this.image,
                this.x,
                this.y,
                this.width, this.height);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    }
}

function component(width, height, color, x, y, type) {
    this.type = type;
    if (type == "image") {
        this.image = new Image();
        this.image.src = color;
    }
    this.gamearea = myGameArea;
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;
    this.x = x;
    this.y = y;
    this.update = function() {
        if (this.speedX < 0) {
            this.image.src = "/storage/2D/robot_side.png";
        }
        if (this.speedX > 0) {
            this.image.src = "/storage/2D/robot_side2.png";
        }
        if (this.speedY > 0) {
            this.image.src = "/storage/2D/robot_back.png";
        }
        if (this.speedY < 0) {
            this.image.src = "/storage/2D/robot_front.png";
        }
        ctx = myGameArea.context;
        if (this.type == "image") {
            ctx.drawImage(this.image,
                this.x,
                this.y,
                this.width, this.height);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
    }
    this.newPos = function() {
        if (this.speedX != 0) {
            this.x += this.speedX;
        }
        if (this.speedY < 0) {
            doors.forEach(goTo);
        }
        if (this.speedX == 0 && this.speedY == 0) {
            // Standing animation.
        }
    }
}

function goTo(item, index) {
    if (item.image.src == "/storage/2D/door_open.png") {
        window.location.assign(item.link);
    }
}

function isInReach(item, index) {
    if (myGamePiece.x > (item.x - 93) && myGamePiece.x < (item.x + 193 + 25)) {
        item.image.src = "/storage/2D/door_open.png";
    }
    else {
        item.image.src = "/storage/2D/door_closed.png";
    }
}

function display(item, index) {
    item.update();
}

function updateGameArea() {
    myGameArea.clear();
    myGamePiece.speedX = 0;
    myGamePiece.speedY = 0;
    if (myGameArea.keys &&( myGameArea.keys[37] || myGameArea.keys[81])) { myGamePiece.speedX = -3; }
    else if (myGameArea.keys && (myGameArea.keys[39] || myGameArea.keys[68])) { myGamePiece.speedX = 3; }
    else if (myGameArea.keys && (myGameArea.keys[40] || myGameArea.keys[83])) { myGamePiece.speedY = -3; }
    else if (myGameArea.keys && (myGameArea.keys[38] || myGameArea.keys[90])) { myGamePiece.speedY = 3; }

    myGamePiece.newPos();
    Background.update();
    doors.forEach(display);
    doors.forEach(isInReach);

    myGamePiece.update();

    ticks++;
}