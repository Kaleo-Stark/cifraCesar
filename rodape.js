
var elem = document.getElementById('cursor');

setInterval(function () {
    if (elem.style.visibility == 'hidden') {
        elem.style.visibility = 'visible';
    } else {
        elem.style.visibility = 'hidden';
    }
}, 500);