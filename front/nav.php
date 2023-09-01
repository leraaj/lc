 <?php
    require_once '../back/conn.php';
    require_once '../back/cdn.php';
    ?>
 <nav class="sidebar-container col-xl-2 col-lg-2 col-md-3 col-sm-3 col-2 ">
     <div class="sidebar">
         <div class="top-container d-flex justify-content-center align-items-center shadow">
             <a href="#" class="navbar-brand logo d-flex align-items-center"><span
                     class="mx-2 d-md-block d-sm-block d-none text-light">CLAHS</span>
                 <span><img src="../img/logo.ico" alt=""></span> </a>
         </div>
         <div class="middle-container overflow-auto p-3">
             <ul class="ul-link">
             </ul>
         </div>
         <div class="bottom-container d-flex align-items-center px-3">
             <a class="btn btn-danger text-decoration-none d-flex justify-content-center align-items-center col-12"
                 href="../front/home.php">
                 <div class="col text-start d-md-block d-sm-block d-none">Logout</div>
                 <span class="col-auto"><i class="bi bi-box-arrow-right"></i></span>
             </a>
         </div>
     </div>
 </nav>
 <script>
const links = [{
        name: "Leave Card",
        link: "http://localhost/LC/front/leavecard.php",
        icon: `<i class="bi bi-file-text"></i>`
    },
    {
        name: "Accounts",
        link: "http://localhost/LC/front/account.php",
        icon: `<i class="bi bi-people "></i>`
    }, {
        name: "Settings",
        link: "http://localhost/LC/front/settings.php",
        icon: `<i class="bi bi-gear "></i>`
    }
];
$(document).ready(function() {
    links.map((link) => {
        $('.ul-link').append(`
                <li class="li-link">
                    <a class="btn-navlink text-decoration-none d-flex justify-content-center align-items-center col-12" href="${link.link}">
                    <div class="col text-start d-md-block d-sm-block d-none px-1">${link.name}</div>
                    <span class="col-auto">${link.icon}</span>
                    </a>
                </li>`);
    });
    const currentLink = `http://localhost` + window.location.pathname;
    var navLinks = document.querySelectorAll('.btn-navlink');
    // Get all elements with the class "btn-navlink"
    // Loop through each link and compare its href with the current pathname
    for (var i = 0; i < navLinks.length; i++) {
        var link = navLinks[i];
        if (link.getAttribute('href') === currentLink) {
            link.classList.add('nav-link-active');
            // Add the "active" class if the href matches
        }
    }
})
 </script>