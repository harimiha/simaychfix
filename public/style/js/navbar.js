//nav bar button action
var navLinks = document.getElementById("navLinks");
function showMenu () {
    navLinks.style.right = "0";
}
function hideMenu () {
    navLinks.style.right = "-200px";
}

// sticky navbar
window.addEventListener("scroll", function(){
    var header = this.document.querySelector("nav");
    header.classList.toggle("sticky" ,window.scrollY > 0);
})