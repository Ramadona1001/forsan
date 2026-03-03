// import copyCurrentPageURL from "./helpers/copyCurrentPageURL.js";
// $("#copyBtn").click(copyCurrentPageURL);

$(document).ready(function () {
  // wow initialization
  if (document.querySelector(".wow")) {
    new WOW({ duration: 1 }).init();
  }
  // lazy initialization
  if (document.querySelector(".lazy")) {
    $(".lazy").lazy();
  }
  // niceSelect initialization
  if (document.querySelector("select")) {
    $("select").niceSelect();
  }
  // counter up initialization
  if (document.querySelector(".counter")) {
    $(".counter").counterUp({
      delay: 1,
      time: 500,
      offset: 70,
      beginAt: 100,
    });
  }
  // handel show password
  if (document.querySelector(".showPassword")) {
    $(".showPassword").click(function () {
      if ($(this).next("input").attr("type") == "password") {
        $(this).next('[type="password"]').attr("type", "text");
        $(this).find(".bi-eye").hide();
        $(this).find(".bi-eye-slash").show();
      } else {
        $(this).next('[type="text"]').attr("type", "password");
        $(this).find(".bi-eye").show();
        $(this).find(".bi-eye-slash").hide();
      }
    });
  }
  // for set id removed item in modal
  if (document.querySelector('[data-bs-toggle="modal"]')) {
    window.setIdRemovedItem = function (id, element) {
      const modal = document.querySelector(element.getAttribute("data-bs-target"));
      modal.querySelector('[name="idRemovedItem"]').value = id;
    };
  }
  // for set Driver License To Modal
  if (document.querySelector('[data-bs-toggle="modal"]')) {
    window.setDriverLicenseToModal = function (src, element) {
      const modal = document.querySelector(element.getAttribute("data-bs-target"));
      modal.querySelector("#drivingLicense").src = src;
    };
  }
  // for handel show success modal
  if (document.querySelector("#successModal")) {
    $("#walletCharging__form").on("submit", function () {
      $("#walletChargingModal").modal("hide");
      $("#successModal").modal("show");
    });
  }
  // for handel show thankYou  modal
  if (document.querySelector("#thankYouModal")) {
    $("#thankYouModal").modal("show");
  }
  // for handel show verification Code  modal
  if (document.querySelector("#verificationCodeModal")) {
    $("#verificationCodeModal").modal("show");
  }
  // for handel show transportationTicketModal
  if (document.querySelector("#transportationTicketModal")) {
    $("#transportationTicketModal").modal("show");
  }
  // for handel show insuranceCard modal
  if (document.querySelector("#insuranceCardModal")) {
    $("#insuranceCardModal").modal("show");
  }
  // Date Range Picker initialization
  function initDateRangePickerFor(input) {
    const disabledDates = input.dataset.disableddates ? JSON.parse(input.dataset.disableddates) : [];

    const specialHourRules = input.dataset.specialhourrules ? JSON.parse(input.dataset.specialhourrules) : {};

    const isSingle = input.dataset.singledatepicker === "true";
    const withTime = input.dataset.timepicker === "true";
    const dateFormat = input.dataset.format || "DD-MM-YYYY";
    const dateSeparator = input.dataset.separator || " to ";
    const dropDirection = input.dataset.drops || "auto";

    $(input).daterangepicker({
      timePicker: withTime,
      timePickerIncrement: 15,
      singleDatePicker: isSingle,
      autoUpdateInput: false,
      locale: {
        format: dateFormat,
      },
      drops: dropDirection,
      isInvalidDate: function (date) {
        const today = moment().startOf("day");
        const formattedDate = date.format("YYYY-MM-DD");
        return date.isBefore(today, "day") || disabledDates.includes(formattedDate);
      },
    });

    const updateDisabledHours = (dateStr) => {
      const disabledHours = specialHourRules[dateStr] || [];
      const isPM = $(".ampmselect").val() === "PM";

      $(".hourselect option").each(function () {
        const hourVal = parseInt($(this).val());
        if (isNaN(hourVal)) return;
        const hour24 = isPM ? (hourVal % 12) + 12 : hourVal % 12;
        $(this).prop("disabled", disabledHours.includes(hour24));
      });
    };

    $(input).on("show.daterangepicker", function (ev, picker) {
      if (isSingle && withTime) {
        setTimeout(() => {
          const selectedDate = picker.startDate.format("YYYY-MM-DD");
          updateDisabledHours(selectedDate);
        }, 10);
      }
    });

    $(document).on("click", ".ampmselect", function () {
      const picker = $(input).data("daterangepicker");
      const selectedDate = picker.startDate.format("YYYY-MM-DD");
      updateDisabledHours(selectedDate);
    });

    $(document).on("click", ".hourselect, .minuteSelect, .calendar-table", function () {
      const picker = $(input).data("daterangepicker");
      const selectedDate = picker.startDate.format("YYYY-MM-DD");
      updateDisabledHours(selectedDate);
    });

    $(input).on("apply.daterangepicker", function (ev, picker) {
      if (!isSingle) {
        const start = picker.startDate.clone().startOf("day");
        const end = picker.endDate.clone().startOf("day");
        const selectedRange = [];

        while (start.isSameOrBefore(end)) {
          selectedRange.push(start.format("YYYY-MM-DD"));
          start.add(1, "day");
        }

        const overlap = selectedRange.some((date) => disabledDates.includes(date));

        if (overlap) {
          ev.preventDefault();
          alert("التاريخ المختار يحتوي على أيام غير متاحة. الرجاء اختيار فترة مختلفة.");
          $(this).val("");
          picker.setStartDate(moment());
          picker.setEndDate(moment());
          return;
        }

        $(this).val(picker.startDate.format(dateFormat) + dateSeparator + picker.endDate.format(dateFormat));
      } else {
        $(this).val(picker.startDate.format(dateFormat));
      }
    });

    $(input).on("cancel.daterangepicker", function (ev, picker) {
      $(this).val("");
      picker.setStartDate(moment());
      picker.setEndDate(moment());
    });
  }
  // Initialize all existing pickers
  document.querySelectorAll("input.main_range_picker").forEach(initDateRangePickerFor);
  // Date Emoji Picker initialization
  if (document.querySelector("[data-emojiable=true]")) {
    $(function () {
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: "[data-emojiable=true]",
        assetsPath: "../../images/emoji",
        popupButtonClasses: "bi bi-emoji-smile",
      });
      window.emojiPicker.discover();
    });
    $(".conversation__user").click(function () {
      document.getElementById("removeChat").setAttribute("data-userid", this.dataset.userid);
      $(".conversation__chat").css({ transform: "translateX(0)" });
    });
    $("#backToConversationsList").click(function () {
      $(".conversation__chat").css({ transform: "translateX(100%)" });
    });
  }
  //  handel increment and decrement and share link function
  if (document.querySelector(".counter-parent")) {
    $(".counter-parent .increment").click(function () {
      let quantityInput = $(this).parent(".counter-parent").find("input");
      let counter = $(this).prev(".value").text();
      if (counter < $(quantityInput).data("max")) {
        counter++;
      }
      $(this).prev(".value").text(counter);
      $(quantityInput).val(counter);
    });
    $(".counter-parent .decrement").click(function () {
      let quantityInput = $(this).parent(".counter-parent").find("input");
      let counter = $(this).next(".value").text();
      if (counter > $(quantityInput).data("min")) {
        counter--;
      }
      $(this).next(".value").text(counter);
      $(quantityInput).val(counter);
    });
  }
  //  initialization tooltip
  if (document.querySelector('[data-bs-toggle="tooltip"]')) {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map((tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl));
  }
  //  handel verification-code function
  if (document.querySelector("#verification-code")) {
    //cache dom
    var $inputs = $("#verification-code").find("input");
    $inputs[0].focus();
    console.log($inputs[0]);
    //bind events
    $inputs.on("keyup", processInput);
    //define methods
    function processInput(e) {
      var x = e.charCode || e.keyCode;
      if ((x == 8 || x == 46) && this.value.length == 0) {
        var indexNum = $inputs.index(this);
        if (indexNum != 0) {
          $inputs.eq($inputs.index(this) - 1).focus();
        }
      }

      if (ignoreChar(e)) return false;
      else if (this.value.length == this.maxLength) {
        $(this).next("input").focus();
      }
    }
    function ignoreChar(e) {
      var x = e.charCode || e.keyCode;
      if (x == 37 || x == 38 || x == 39 || x == 40) return true;
      else return false;
    }
  }
  // Handel custom toggler
  if (window.innerWidth >= 991) {
    $(".custom-toggler").on("click", function (event) {
      event.stopPropagation();
      const $target = $($(this).data("target"));

      // If the target is already active, just close it
      if ($target.hasClass("active")) {
        $target.removeClass("active");
        $target.find(".custom-dropdown.active").removeClass("active");
      } else {
        // Otherwise, close others and open this one
        if ($target.parents(".custom-dropdown.active").length == 0) {
          $(".custom-dropdown.active").removeClass("active");
        }
        $target.parents(".custom-dropdown.active").find(".children-parent .custom-dropdown.active").removeClass("active");
        $target.addClass("active");
      }
    });

    $(document).on("click", function (event) {
      if (!$(event.target).closest(".custom-toggler, .custom-dropdown").length) {
        $(".custom-dropdown.active").removeClass("active");
      }
    });
  } else {
    $(".custom-toggler").on("click", function (event) {
      if (!$(this).parents().hasClass("top-navbar")) {
        event.stopPropagation();
        const $target = $($(this).data("target"));
        // Close all unrelated dropdowns
        $(".custom-dropdown").each(function () {
          if (!$(this).is($target) && !$.contains(this, $target[0]) && !$.contains($target[0], this)) {
            $(this).slideUp();
          }
        });
        if ($target.is(":visible")) {
          // Hide target and any nested dropdowns
          $target.find(".custom-dropdown:visible").slideUp();
          $target.slideUp();
        } else {
          $target.stop(true, true).slideDown("slow", function () {
            $target.css("display", "flex");
          });
        }
      }
    });
    $(".top-navbar .custom-toggler").on("click", function (event) {
      event.stopPropagation();
      const $target = $($(this).data("target"));

      // If the target is already active, just close it
      if ($target.hasClass("active")) {
        $target.removeClass("active");
        $target.find(".top-navbar .custom-dropdown.active").removeClass("active");
      } else {
        // Otherwise, close others and open this one
        if ($target.parents(".top-navbar .custom-dropdown.active").length == 0) {
          $(".top-navbar .custom-dropdown.active").removeClass("active");
        }
        $target.addClass("active");
      }
    });

    $(document).on("click", function (event) {
      if (!$(event.target).closest(".custom-toggler, .custom-dropdown").length) {
        $(".custom-dropdown.active").removeClass("active");
      }
    });
  }
  window.addEventListener("scroll", (_) => {
    $(".custom-dropdown.active").removeClass("active");
  });
  // Handel search Area results for develop
  $("#dropdown-search [type='search']").on("input", function (event) {
    if ($(this).val() !== "") {
      $("#dropdown-searchResult").addClass("active");
    } else {
      $("#dropdown-searchResult").removeClass("active");
    }
  });
  // handel footer in mobile
  if (window.innerWidth <= 768 && document.querySelector("footer")) {
    $("footer .footer__head").click(function () {
      if ($(this).parent(".footer__links").find(".mobile_links").hasClass("active")) {
        $(this).parent(".footer__links").find(".mobile_links").removeClass("active").slideUp();
      } else {
        $(".footer__links").find(".mobile_links").removeClass("active").slideUp();
        $(this).parent(".footer__links").find(".mobile_links").toggleClass("active").slideToggle(300);
      }
    });
  }
  let scrollBtn = document.querySelector(".scrollTo");
  if (scrollBtn) {
    window.addEventListener("scroll", (_) => {
      if (scrollY >= 500) scrollBtn.classList.add("active");
      else scrollBtn.classList.remove("active");
    });
    scrollBtn.addEventListener("click", (_) => {
      scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }
  // handel preloader
  $(".preloader-parent").addClass("not-active");

  function initCloneLogic(containerId, buttonId) {
    const container = document.getElementById(containerId);
    const addBtn = document.getElementById(buttonId);
    if (addBtn && container) {
      addBtn.addEventListener("click", () => {
        const blocks = container.querySelectorAll(".disease-block");
        const lastBlock = blocks[blocks.length - 1];
        const clone = lastBlock.cloneNode(true);
        const newIndex = blocks.length;

        // Reset names, ids, values
        const inputs = clone.querySelectorAll("input, select, textarea, label");
        inputs.forEach((el) => {
          if (el.tagName === "LABEL") {
            const oldFor = el.getAttribute("for");
            if (oldFor) {
              const base = oldFor.replace(/(_\d+)?$/, "");
              el.setAttribute("for", `${base}_${newIndex}`);
            }
          } else {
            if (el.name) {
              const base = el.name.replace(/(_\d+)?$/, "");
              el.name = `${base}_${newIndex}`;
            }
            if (el.id) {
              const base = el.id.replace(/(_\d+)?$/, "");
              el.id = `${base}_${newIndex}`;
            }

            if (el.tagName === "SELECT") {
              const placeholder = el.querySelector("option[disabled][selected]");
              el.value = placeholder ? placeholder.value || "" : "";
            } else {
              el.value = "";
            }
          }
        });

        if (container.id !== "servicesContainer") {
          // Add <hr> and cloned block
          const hr = document.createElement("hr");
          hr.classList.add("divider");
          container.appendChild(hr);
        }
        container.appendChild(clone);

        // Re-init plugins
        $(clone).find(".nice-select").remove();
        $(clone).find("select").niceSelect();

        const newPicker = clone.querySelector(".main_range_picker");
        if (newPicker) {
          const existing = $(newPicker).data("daterangepicker");
          if (existing) existing.remove();
          initDateRangePickerFor(newPicker);
        }
      });
    }
  }

  // Initialize clone logic for both sections
  initCloneLogic("vaccineContainer", "addVaccineBtn");
  initCloneLogic("diseaseContainer", "addDiseaseBtn");
  initCloneLogic("servicesContainer", "addServicesBtn");
  initCloneLogic("packageItemsContainer--add", "addPackageItemBtn--add");
  initCloneLogic("packageItemsContainer--edit", "addPackageItemBtn--edit");
});

document.addEventListener("DOMContentLoaded", function () {
  let hash = window.location.hash;
  if (hash) {
    let tab = document.querySelector(`a[href="${hash}"]`);
    if (tab) {
      new bootstrap.Tab(tab).show();
    }
  }
});
