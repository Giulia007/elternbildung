window.addEventListener("load", setLayoutOnLoad);
// window.addEventListener("resize", adjustLayoutOnResize);

var dims = null;

var prova = $("#prova");

function viewportSize(){
    var test = document.createElement( "div" );

    test.style.cssText = "position: fixed;top: 0;left: 0;bottom: 0;right: 0;";
    document.documentElement.insertBefore( test, document.documentElement.firstChild );

    var dims = { width: test.offsetWidth, height: test.offsetHeight };
    document.documentElement.removeChild( test );

    console.log(dims.width);

    return dims.width;
}

function setLayoutOnLoad() {
    dims =  viewportSize();
    if (dims < 992) {
        prova.toggle();
    }
}

function adjustLayoutOnResize() {
    dims =  viewportSize();
    if (dims < 992) {
        prova.toggle();
    }
    console.log(dmis);
}
