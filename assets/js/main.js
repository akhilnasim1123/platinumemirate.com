
function collapseNavbar() {
  const navbar = document.getElementById('navbarNav');
  navbar.classList.remove('show');
}

document.addEventListener('click', ({ target }) => {
  if (!target.matches('#navbarNav, #navbarNav *')) {
    collapseNavbar();
  }
});

window.addEventListener('scroll', () => {
  collapseNavbar();
});



function checkScreenSize() {
  var newWindowWidth = $(window).width();
  if (newWindowWidth < 481) {
    return true;
  } else {
    return false;
  }
}
$(document).scroll(function () {
  if ($(document).scrollTop() >= 50) {
    $(".nav-container").addClass("box-shadow");
  } else {
    $(".nav-container").removeClass("box-shadow");
  }

  
});




function lightGalleryFun() {
  var galleryElement = document.getElementById("static-thumbnails");

  if (galleryElement) {
    if (galleryElement.lightGallery) {
      galleryElement.lightGallery().destroy(true);
    }

    jQuery("#static-thumbnails")
      .justifiedGallery({
        captions: false,
        rowHeight: 300,
        margins: 5,
      })
      .on("jg.complete", function () {
        lightGallery(galleryElement, {
          autoplayFirstVideo: false,
          pager: false,
          galleryId: "nature",
          toggleThumb: true,
          animateThumb: true,
          allowMediaOverlap: true,
          plugins: [lgZoom, lgThumbnail],
          mobileSettings: {
            controls: false,
            showCloseIcon: false,
            download: false,
            rotate: false,
          },
        });
      });
  } else {
    console.error("Element #lightgallery not found");
  }

}






$(document).ready(function () {

  $(".banner-brand").slick({
      speed: 5000,
      autoplay: true,
      autoplaySpeed: 0,
      cssEase: 'linear',
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      swipeToSlide: true,
      centerMode: true,
      focusOnSelect: true,
      mobileFirst: true,
      prevArrow: false,
      nextArrow: false,
      speed: 2000, 
      responsive: [
        {
          breakpoint: 1800,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: true,
          },
        },
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
  });

  $(".about-brand").slick({
    slidesToShow: 6,
    autoplay: true,
    infinite: true,
    // speed: 5000,
    // autoplaySpeed: 0,
    swipeToSlide: true,
    centerMode: false,
    // cssEase: "linear",
    dots: false,
    focusOnSelect: true,
    // mobileFirst: true,
    slidesToScroll: 1,
    prevArrow: false,
    nextArrow: false,
    responsive: [
      {
        breakpoint: 1800,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1439,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".tesimonial-slider").slick({
    slidesToShow: 5,
    autoplay: true,
    infinite: true,
    // speed: 5000,
    // autoplaySpeed: 0,
    swipeToSlide: true,
    centerMode: true,
    // cssEase: "linear",
    dots: false,
    focusOnSelect: true,
    // mobileFirst: true,
    slidesToScroll: 1,
    prevArrow: false,
    nextArrow: false,
    responsive: [
      {
        breakpoint: 1800,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1439,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".team-slick").slick({
    slidesToShow: 4,
    autoplay: true,
    infinite: true,
    // speed: 5000,
    // autoplaySpeed: 0,
    swipeToSlide: true,
    centerMode: false,
    // cssEase: "linear",
    dots: false,
    focusOnSelect: true,
    // mobileFirst: true,
    slidesToScroll: 1,
    prevArrow: false,
    nextArrow: false,
    responsive: [
      {
        breakpoint: 1800,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1439,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

});


$(".prev-button").click(function () {
  $(".testimonial-slick").slick("slickPrev");
});

$(".next-button").click(function () {
  $(".testimonial-slick").slick("slickNext");
});


function changeNav(className){
  
  $(".nav-link").removeClass("text-theme").find('i').addClass('d-none');
  if (className != 'none'){
  $('.' + className).addClass("text-theme").find('i').removeClass('d-none');
}
}




function toastFun(message) {

  Toastify({
    text: message,
    duration: 3000,
    destination: "https://github.com/apvarun/toastify-js",
    newWindow: true,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    style: {
      background: "linear-gradient(to right, #C29300, #C29300)",
      color: "#1B2934",
    },
    onClick: function () { }
  }).showToast();
}


function toastError(message) {
  Toastify({
    text: message,
    duration: 3000,
    destination: "https://github.com/apvarun/toastify-js",
    newWindow: true,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    style: {
      background: "linear-gradient(to right, #red, #004368)",
    },
    onClick: function () { }
  }).showToast();
}