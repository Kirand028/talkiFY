function showPage(pageId) {
    var pages = document.getElementsByClassName("main-content")[0].children;
    for (var i = 0; i < pages.length; i++) {
        if (pages[i].id === pageId) {
            pages[i].style.display = "flex";
        } else {
            pages[i].style.display = "none";
        }
    }
}


