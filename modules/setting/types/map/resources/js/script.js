function mapsetting() {
    ymaps = window.ymaps;

    if(!ymaps) {
        return false;
    }

    let $input = $('#setting-value');
    let $map = $('#map');
    let data;

    try {
        data = JSON.parse($input.val());
    } catch {
        data = {"coords":[54.782635,32.045251],"zoom":10};
    }

    let myMap = new ymaps.Map("map", {
        center: data.coords,
        zoom: data.zoom,
    });
    myMap.behaviors.disable('scrollZoom');

    let Placemark = new ymaps.Placemark(data.coords, {}, {draggable: true})
    let searchControl = myMap.controls.get('searchControl');

    searchControl.events.add('resultshow', function () {
        let coords = searchControl.getResult(0).valueOf().geometry.getCoordinates();
        searchControl.hideResult();
        Placemark.geometry.setCoordinates(coords);
    });

    myMap.geoObjects.add(Placemark);

    myMap.events.add('click', function (e) {
        Placemark.geometry.setCoordinates(e.get('coords'));
    });

    $map.closest('form').on('beforeSubmit', function(e) {
        $input.val(JSON.stringify({
            'coords': Placemark.geometry.getCoordinates(),
            'zoom': myMap.getZoom(),
        }));
    })
}