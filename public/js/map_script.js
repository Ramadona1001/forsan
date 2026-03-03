$("#register-form-area-add").click(function () {
  $("#setMapModal").modal("show");
});
// for map from to
$("#register-form-area-from,#register-form-area-to").click(function () {
  $("#setMapFromToModal").modal("show");
});

let marker = null;
let isSettingFrom = true;
let fromMarker = null;
let toMarker = null;
let routeLine = null;
let mapFromTo = null;
$("#addAddressModal").on("shown.bs.modal", function () {
  InitializeMapAdd();
});
$("#setMapModal").on("shown.bs.modal", function () {
  InitializeMapAdd();
});
$("#setMapFromToModal").on("shown.bs.modal", function () {
  // 🧹 Reset state for fresh selection
  isSettingFrom = true;

  $("#form-coordinates-from").val("");
  $("#form-coordinates-to").val("");
  $("#register-form-area-from").val("");
  $("#register-form-area-to").val("");
  // ✅ Now initialize clean map
  InitializeMapFromTo();
});
$("#setMapFromToModal").on("hidden.bs.modal", function () {
  if (mapFromTo) {
    mapFromTo.off(); // remove all event listeners
    mapFromTo.remove(); // destroy the map
    mapFromTo = null;
  }
});

function InitializeMapAdd() {
  let coordinatesInput = document.getElementById("form-coordinates-add");
  let register_form_area = document.getElementById("register-form-area-add");
  let map = L.map("mapAdd", {
    center: [23, 45],
    zoom: 5,
    closeButton: false
  });

  var container = L.DomUtil.get("mapAdd");
  if (container != null) {
    container._leaflet_id = null;
  }

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
  map.on("click", function (event) {
    onMapClick(event, coordinatesInput, register_form_area, map);
  });
}

function InitializeMapFromTo() {
  isSettingFrom = true; // ✅ always start with "From"
  // Prevent duplicate map initialization
  var container = L.DomUtil.get("mapFromTo");
  if (container != null) {
    container._leaflet_id = null; // Reset container before recreating
  }

  mapFromTo = L.map("mapFromTo", {
    center: [23, 45],
    zoom: 5
  });

  // ✅ Clear old markers and line
  if (fromMarker) {
    fromMarker = null;
  }
  if (toMarker) {
    toMarker = null;
  }
  if (routeLine) {
    routeLine = null;
  }

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(
    mapFromTo
  );
  // mapFromTo.off("click");
  mapFromTo.on("click", function (event) {
    // 🔁 Reset if both already set
    if (fromMarker && toMarker) {
      console.log("🔁 Reset if both already set");

      mapFromTo.removeLayer(fromMarker);
      mapFromTo.removeLayer(toMarker);
      if (routeLine) mapFromTo.removeLayer(routeLine);
      fromMarker = null;
      toMarker = null;
      routeLine = null;
      $("#form-coordinates-from").val("");
      $("#form-coordinates-to").val("");
      $("#register-form-area-from").val("");
      $("#register-form-area-to").val("");
      isSettingFrom = true;
    }
    const lat = event.latlng.lat;
    const lng = event.latlng.lng;

    jQuery
      .get(
        `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`
      )
      .then((data) => {
        const address = data.display_name;
        const marker = L.marker([lat, lng]).bindPopup(
          (isSettingFrom ? "From: " : "To: ") + address
        );

        // Remove previous marker
        if (isSettingFrom) {
          if (fromMarker) mapFromTo.removeLayer(fromMarker);
          fromMarker = marker.addTo(mapFromTo).openPopup();
          $("#form-coordinates-from").val(`${lat}, ${lng}`);
          $("#register-form-area-from").val(address);
        } else {
          if (toMarker) mapFromTo.removeLayer(toMarker);
          toMarker = marker.addTo(mapFromTo).openPopup();
          $("#form-coordinates-to").val(`${lat}, ${lng}`);
          $("#register-form-area-to").val(address);
        }

        if (fromMarker && toMarker) drawLine();

        isSettingFrom = !isSettingFrom;
      });
  });
}

function drawLine() {
  if (routeLine) {
    mapFromTo.removeLayer(routeLine); // Remove old line
  }

  if (fromMarker && toMarker) {
    routeLine = L.polyline([fromMarker.getLatLng(), toMarker.getLatLng()], {
      color: "#0c4745",
      weight: 3,
      smoothFactor: 1
    }).addTo(mapFromTo);
  }
}

// Initialize Click On Map
$('[data-bs-target="#editAddressModal"]').on("click", function (e) {
  let el = e.target.closest("[data-coordinates]");
  document
    .querySelector("#editAddressModal")
    .setAttribute("data-coordinates", el.getAttribute("data-coordinates"));
});
$("#editAddressModal").on("shown.bs.modal", function (e) {
  let oldCoordinates = e.target.getAttribute("data-coordinates");
  let latitude = oldCoordinates.slice(0, oldCoordinates.indexOf(","));
  let longitude = oldCoordinates.slice(oldCoordinates.indexOf(" "));
  InitializeMapEdit(latitude, longitude);
});

// function edit coordinates
function InitializeMapEdit(latitude, longitude) {
  let coordinatesInput = document.getElementById("form-coordinates-edit");
  let register_form_area = document.getElementById("register-form-area-edit");
  let map = L.map("mapEdit", {
    center: [latitude, longitude],
    zoom: 5,
    closeButton: false
  });

  var container = L.DomUtil.get("mapEdit");
  if (container != null) {
    container._leaflet_id = null;
  }

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

  marker = L.marker([latitude, longitude]).addTo(map);
  // Change Inputs Values of Coordinates Input and Address Input
  coordinatesInput.value = `${latitude}, ${longitude}`;
  jQuery.get(
    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`,
    function (data) {
      register_form_area.value = `${data.display_name}`;
    }
  );

  map.on("click", function (event) {
    onMapClick(event, coordinatesInput, register_form_area, map);
  });
}
function onMapClick(event, coordinatesInput, register_form_area, map) {
  let latitude = event.latlng.lat;
  let longitude = event.latlng.lng;
  // Check if the map has marker aleady and remove it
  if (marker) {
    map.removeLayer(marker);
  }

  // Adding marker to map
  let url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`;
  jQuery.get(url).then((data) => {
    let address = data.display_name;
    marker = L.marker([latitude, longitude])
      .addTo(map)
      .bindPopup(address, {
        className: "search__map__padding"
      })
      .openPopup();
    // Change Inputs Values of Coordinates Input and Address Input
    coordinatesInput.value = `${latitude}, ${longitude}`;
    register_form_area.value = address;
  });
  if (document.getElementById("setMapModal")) {
    $("#setMapModal").modal("hide");
  }
}
