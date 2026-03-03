const dir = $("html").attr("dir");
// best seller slider
$(".owl-carousel").on(
  "initialized.owl.carousel refreshed.owl.carousel",
  function (event) {
    var visibleItems = event.page.size; // Number of items visible per page
    var totalItems = event.item.count; // Total number of items in the carousel

    // If the total items are less than or equal to the visible items, hide the navigation buttons
    if (totalItems <= visibleItems) {
      $(this).next(".custom-buttons").hide();
    } else {
      $(this).next(".custom-buttons").show();
    }
  }
);
$(".custom-button-next").click(function () {
  $($(this).parent(".custom-buttons").prev(".owl-carousel")).trigger(
    "next.owl.carousel"
  );
});
$(".custom-button-prev").click(function () {
  $($(this).parent(".custom-buttons").prev(".owl-carousel")).trigger(
    "prev.owl.carousel",
    [300]
  );
});

// home page slider
$(".header-slider--carousel").owlCarousel({
  loop: true,
  margin: 16,
  autoplay: true,
  nav: false,
  rtl: dir == "rtl" ? true : false,
  items: 1
});
// single product slider
$(".single-product--carousel").owlCarousel({
  loop: true,
  margin: 0,
  autoplay: true,
  nav: false,
  rtl: dir == "rtl" ? true : false,
  items: 1
});
// services slider
$(".services-slider--carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 16
    },
    574: {
      items: 3,
      margin: 16
    },
    767: {
      items: 4,
      margin: 16
    },
    991: {
      margin: 16,
      items: 5
    },
    1199: {
      items: 6
    }
  }
});
// sports slider
$(".sports-slider--carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 16
    },
    574: {
      items: 3,
      margin: 16
    },
    767: {
      items: 4,
      margin: 16
    },
    991: {
      margin: 16,
      items: 5
    },
    1199: {
      items: 7
    }
  }
});
// partners slider
$(".partners--carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 16
    },
    767: {
      items: 3,
      margin: 16
    },
    991: {
      items: 4,
      margin: 16
    },
    1199: {
      items: 6
    }
  }
});
// main slider
$(".main-slider--carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 2,
      margin: 10
    },
    767: {
      items: 3,
      margin: 16
    },
    991: {
      margin: 16
    },
    1199: {
      items: 4
    }
  }
});
// blogs slider
$(".blogs--carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 1,
      margin: 16
    },
    767: {
      items: 2,
      margin: 16
    }
  }
});
// two items slider
$(".two-items-carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 1,
      margin: 16
    },
    767: {
      items: 1,
      margin: 16
    },
    991: {
      items: 2
    }
  }
});
// our-knights slider
$(".our-knights--carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 1,
      margin: 16
    },
    767: {
      items: 2,
      margin: 16
    },
    991: {
      items: 3
    }
  }
});
// knight__certificates slider
$(".knight__certificates--carousel").owlCarousel({
  loop: false,
  touchDrag: false,
  mouseDrag: false,
  nav: false,
  dots: false,
  margin: 24,
  rtl: dir == "rtl" ? true : false,
  responsive: {
    0: {
      items: 1,
      margin: 16
    },
    767: {
      items: 2,
      margin: 16
    },
    991: {
      items: 3
    },
    1199: {
      items: 4
    }
  }
});
