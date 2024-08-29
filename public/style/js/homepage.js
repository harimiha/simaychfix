// //nav bar button action
//     var navLinks = document.getElementById("navLinks");
//     function showMenu () {
//         navLinks.style.right = "0";
//     }
//     function hideMenu () {
//         navLinks.style.right = "-200px";
//     }

// auto-scroll page nav bar
    let sections = document.querySelectorAll('section');
    let navLinks1 = document.querySelectorAll('header nav a');

    window.onscroll = () => {
        sections.forEach(sec => {
            let top = window.scrollY;
            let offset = sec.offsetTop - 150;
            let height = sec.offsetHeight;
            let id = sec.getAttribute('id');

            if(top >= offset && top < offset + height) {
                navLinks1.forEach(links => {
                    links.classList.remove('active');
                    document.querySelector('header nav a[href*= ' + id + ']').classList.add('active')
                })
            }
        })
    }

// // sticky navbar
//     window.addEventListener("scroll", function(){
//         var header = this.document.querySelector("nav");
//         header.classList.toggle("sticky" ,window.scrollY > 0);
//     })