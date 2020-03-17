/**
 * Map
 */

import $ from "jquery";
import Component from "../../js/lib/component";

/* global google */

const classList = {
  root: ".js-map",
  container: ".js-map-container"
};

export default class Map extends Component {
  init(data = null) {
    this.param = {};
    this.collections = [];

    if (window.google) {
      this.setParams(data);
      this.initMap();
    } else {
      $.getScript(
        "//maps.googleapis.com/maps/api/js?key=AIzaSyCGp6pOLSkRpcCD_AGJ4c9dlRZaHcuT9gs",
        () => {
          this.setParams(data);
          this.initMap();
        }
      );
    }
  }
  update(data) {
    this.setParams(data);
    this.removeAllMarkers();
    this.generateMarkers();
    this.setCenter(this.param.center);
    this.setZoom(this.param.zoom);
  }

  setParams(data) {
    const param = data || this.$.root.data("options");
    this.markers = param.markers || [];
    this.param.center = param.center || [54.775102, 32.047875];
    this.param.zoom = param.zoom || 16;
    this.param.container = param.container || ".js-map-container";
  }
  initMap() {
    this.$.container = $(`${this.param.container}`);
    this.$.container.html("");

    const options = {
      zoom: this.param.zoom,
      scrollwheel: false,
      center: new google.maps.LatLng(...this.param.center),
      disableDefaultUI: true,
      zoomControl: true,
      styles: [
        {
          featureType: "all",
          elementType: "all",
          stylers: [
            { gamma: "1.50" },
            { saturation: "35" },
            { lightness: "0" },
            { hue: "#0071ff" }
          ]
        },
        {
          featureType: "administrative.locality",
          elementType: "labels",
          stylers: [{ visibility: "simplified" }]
        },
        {
          featureType: "poi",
          elementType: "all",
          stylers: [{ visibility: "simplified" }]
        },
        {
          featureType: "poi",
          elementType: "labels",
          stylers: [{ visibility: "off" }]
        },
        {
          featureType: "poi",
          elementType: "labels.text",
          stylers: [{ visibility: "off" }]
        },
        {
          featureType: "transit",
          elementType: "labels",
          stylers: [{ visibility: "off" }]
        }
      ]
    };

    this.map = new google.maps.Map(this.$.container.get(0), options);
    this.generateMarkers();
  }
  generateMarkers() {
    this.markers.forEach(marker => {
      this.setMarker(marker.address, marker.coords);
    });
  }
  setMarker(title, coords) {
    const marker = new google.maps.Marker({
      position: new google.maps.LatLng(...coords),
      map: this.map,
      title,
      icon: {
        url: "/img/marker.png",
        size: new google.maps.Size(44, 58)
      }
    });

    this.collections.push(marker);

    return this;
  }
  setCenter([x, y]) {
    // this.map.setCenter({ lat: Number(x), lng: Number(y) });
    this.map.panTo({ lat: Number(x), lng: Number(y) });
    return this;
  }
  setZoom(value) {
    this.map.setZoom(value);
  }
  smoothZoom(map, max, cnt) {
    if (cnt >= max) {
      return;
    } else {
      const listener = google.maps.event.addListener(
        map,
        "zoom_changed",
        function(event) {
          google.maps.event.removeListener(listener);
          r(map, max, cnt + 1);
        }
      );
      setTimeout(function() {
        map.setZoom(cnt);
      }, 80);
    }
  }
  removeAllMarkers() {
    this.collections.forEach(marker => marker.setMap(null));
    this.collections = [];
  }
}

Component.mount(Map, {
  name: "Map",
  classList,
  state: {}
});
