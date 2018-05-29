var article = document.getElementById("article");
//change font size
function resizeText(index) {
    if (article.style.fontSize == "") {
        article.style.fontSize = "1rem";
    }
    article.style.fontSize =
        parseFloat(article.style.fontSize) + index * 0.12 + "rem";
}

var black = "#000000";
var white = "#ffffff";
var yellow = "#eded1a";
var blue = "#1227e5";

//change font colour
function changeTexColour(color) {
    article.style.color = color;
}

//change article background color
function changeBackground(color) {
    article.style.background = color;
}