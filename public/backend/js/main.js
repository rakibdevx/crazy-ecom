

$(function () {
  "use strict";


  /* scrollar */

  new PerfectScrollbar(".notify-list")

  // new PerfectScrollbar(".mega-menu-widgets")



  /* toggle button */

  $(".btn-toggle").click(function () {
    $("body").hasClass("toggled") ? ($("body").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) : ($("body").addClass("toggled"), $(".sidebar-wrapper").hover(function () {
      $("body").addClass("sidebar-hovered")
    }, function () {
      $("body").removeClass("sidebar-hovered")
    }))
  })




  /* menu */

  $(function () {
    $('#sidenav').metisMenu();
  });

  $(".sidebar-close").on("click", function () {
    $("body").removeClass("toggled")
  })



  /* dark mode button */

  $(".dark-mode i").click(function () {
    $(this).text(function (i, v) {
      return v === 'dark_mode' ? 'light_mode' : 'dark_mode'
    })
  });


    $(document).ready(function () {
        $(".dark-mode").click(function () {
            $("html").attr("data-bs-theme", function (i, v) {
            const newTheme = v === 'dark' ? 'light' : 'dark';
            localStorage.setItem('myecom', newTheme);
            return newTheme;
            });
        });
    });


  /* search control */

  $(".search-control").click(function () {
    $(".search-popup").addClass("d-block");
    $(".search-close").addClass("d-block");
  });


  $(".search-close").click(function () {
    $(".search-popup").removeClass("d-block");
    $(".search-close").removeClass("d-block");
  });


  $(".mobile-search-btn").click(function () {
    $(".search-popup").addClass("d-block");
  });


  $(".mobile-search-close").click(function () {
    $(".search-popup").removeClass("d-block");
  });



  $(function () {
    for (var e = window.location, o = $(".metismenu li a").filter(function () {
      return this.href == e
    }).addClass("").parent().addClass("mm-active"); o.is("li");) o = o.parent("").addClass("mm-show").parent("").addClass("mm-active")
  });



});










