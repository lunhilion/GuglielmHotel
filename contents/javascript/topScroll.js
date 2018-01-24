window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
        document.getElementById("topScrollButton").style.display = "block";
    } else {
        document.getElementById("topScrollButton").style.display = "none";
    }
}
