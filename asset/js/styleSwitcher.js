"use strict";


(function ($) {
  "use strict";

  const body = $("body");
  const html = $("html");

  //get the DOM elements from right sidebar
  const typographySelect = $("#typography");
  //const versionSelect = $('#theme_version');
  const themeSelect = $("#theme_data");
  const layoutSelect = $("#theme_layout");
  const sidebarStyleSelect = $("#sidebar_style");
  const sidebarPositionSelect = $("#sidebar_position");
  const headerPositionSelect = $("#header_position");
  const containerLayoutSelect = $("#container_layout");
  const themeDirectionSelect = $("#theme_direction");

  //change the theme typography controller
  typographySelect.on("change", function () {
    body.attr("data-typography", this.value);

    setCookie("typography", this.value);
  });

  //change the theme version controller
  // versionSelect.on('change', function() {
  //body.attr('data-theme-version', this.value);

  /* if(this.value === 'dark'){
			//jQuery(".nav-header .logo-abbr").attr("src", "./images/logo-white.png");
			jQuery(".nav-header .logo-compact").attr("src", "images/logo-text-white.png");
			jQuery(".nav-header .brand-title").attr("src", "images/logo-text-white.png");
			
			setCookie('logo_src', './images/logo-white.png');
			setCookie('logo_src2', 'images/logo-text-white.png');
		}else{
			jQuery(".nav-header .logo-abbr").attr("src", "./images/logo.png");
			jQuery(".nav-header .logo-compact").attr("src", "images/logo-text.png");
			jQuery(".nav-header .brand-title").attr("src", "images/logo-text.png");
			
			setCookie('logo_src', './images/logo.png');
			setCookie('logo_src2', 'images/logo-text.png');
		} */

  //setCookie('version', this.value);
  //});

  //change the sidebar position controller
  sidebarPositionSelect.on("change", function () {
    this.value === "fixed" &&
    body.attr("data-sidebar-style") === "modern" &&
    body.attr("data-layout") === "vertical"
      ? alert("Sorry, Modern sidebar layout dosen't support fixed position!")
      : body.attr("data-sidebar-position", this.value);
    setCookie("sidebarPosition", this.value);
  });

  //change the header position controller
  headerPositionSelect.on("change", function () {
    body.attr("data-header-position", this.value);
    setCookie("headerPosition", this.value);
  });

  //change the theme direction (rtl, ltr) controller
  themeDirectionSelect.on("change", function () {
    html.attr("dir", this.value);
    html.attr("class", "");
    html.addClass(this.value);
    body.attr("direction", this.value);
    setCookie("direction", this.value);
  });

  //change the theme layout controller
  layoutSelect.on("change", function () {
    if (body.attr("data-sidebar-style") === "overlay") {
      body.attr("data-sidebar-style", "full");
      body.attr("data-layout", this.value);
      return;
    }

    body.attr("data-layout", this.value);
    setCookie("layout", this.value);
  });

  //change the container layout controller
  containerLayoutSelect.on("change", function () {
    if (this.value === "boxed") {
      if (
        body.attr("data-layout") === "vertical" &&
        body.attr("data-sidebar-style") === "full"
      ) {
        body.attr("data-sidebar-style", "overlay");
        body.attr("data-container", this.value);

        setTimeout(function () {
          $(window).trigger("resize");
        }, 200);

        return;
      }
    }

    body.attr("data-container", this.value);

    setTimeout(function () {
      window.dispatchEvent(new Event("resize"));
    }, 500);

    setCookie("containerLayout", this.value);
  });

  //change the sidebar style controller
  sidebarStyleSelect.on("change", function () {
    if (body.attr("data-layout") === "horizontal") {
      if (this.value === "overlay") {
        alert("Sorry! Overlay is not possible in Horizontal layout.");
        return;
      }
    }

    if (body.attr("data-layout") === "vertical") {
      if (body.attr("data-container") === "boxed" && this.value === "full") {
        alert("Sorry! Full menu is not available in Vertical Boxed layout.");
        return;
      }

      if (
        this.value === "modern" &&
        body.attr("data-sidebar-position") === "fixed"
      ) {
        alert(
          "Sorry! Modern sidebar layout is not available in the fixed position. Please change the sidebar position into Static."
        );
        return;
      }
    }

    body.attr("data-sidebar-style", this.value);

    if (body.attr("data-sidebar-style") === "icon-hover") {
      $(".dlabnav").hover(
        function () {
          $("#main-wrapper").addClass("iconhover-toggle");
        },
        function () {
          $("#main-wrapper").removeClass("iconhover-toggle");
        }
      );
    }

    setCookie("sidebarStyle", this.value);
  });

  /* jQuery("#nav_header_color_1").on('click',function(){
		jQuery(".nav-header .logo-abbr").attr("src", "./images/logo.png");
		setCookie('logo_src', './images/logo.png');
		return false;
    }); */

  /* jQuery("#sidebar_color_2, #sidebar_color_3, #sidebar_color_4, #sidebar_color_5, #sidebar_color_6, #sidebar_color_7, #sidebar_color_8, #sidebar_color_9, #sidebar_color_10, #sidebar_color_11, #sidebar_color_12, #sidebar_color_13, #sidebar_color_14, #sidebar_color_15").on('click',function(){
		jQuery(".nav-header .logo-abbr").attr("src", "./images/logo-white.png");
		jQuery(".nav-header .brand-title").attr("src", "./images/logo-text-white.png");
		setCookie('logo_src', './images/logo-white.png');
		return false;
    }); */

  /* jQuery("#nav_header_color_3").on('click',function(){
		jQuery(".nav-header .logo-abbr").attr("src", "./images/logo-white.png");
		setCookie('logo_src', './images/logo-white.png');
		return false;
    }); */

  //change the nav-header background controller
  $('input[name="navigation_header"]').on("click", function () {
    body.attr("data-nav-headerbg", this.value);
    setCookie("navheaderBg", this.value);
  });

  //change the header background controller
  $('input[name="header_bg"]').on("click", function () {
    body.attr("data-headerbg", this.value);
    setCookie("headerBg", this.value);
  });

  //change the primary color controller
  $('input[name="primary_bg"]').on("click", function () {
    body.attr("data-primary", this.value);
    setCookie("primary", this.value);
  });

  //change the primary color controller
  $('input[name="sidebar_img_bg"]').on("click", function () {
    var sidebarBgImg = this.value;
    $(".dlabnav").css("background-image", "url(" + sidebarBgImg + ")");
    $(".nav-header").css("background-image", "url(" + sidebarBgImg + ")");
    $("body").attr("data-navigationbarimg", sidebarBgImg);
    $(".nav-header").addClass("nav-header-brand");
    $(".dlabnav").addClass("dz-bg");

    setCookie("navigationBarImg", this.value);
  });

  //change the theme color controller
  $('input[name="themecolor_bg"]').on("click", function () {
    body.attr("data-theme", this.value);
    setCookie("themeBg", this.value);
  });

  //remove the sidebar image
  $(".remove-img").on("click", function () {
    $(".dlabnav, .nav-header").removeAttr("style");
    $("body").attr("data-navigationbarimg", "");
    jQuery(".chk-col-primary").prop("checked", false);
    setCookie("navigationBarImg", "");
  });
})(jQuery);
