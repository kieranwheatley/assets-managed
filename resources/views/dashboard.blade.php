@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
        <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js"></script>
        <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css" rel="stylesheet" />
        <style>
            #map {}

            .h3 {
                color: black !important;
            }

            .marker {
                background-image: URL('images/mapbox-icon.png');
                background-size: cover;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                cursor: pointer;
            }

            .mapboxgl-popup {
                max-width: 200px;
            }

            .mapboxgl-popup-content {
                text-align: center;
                font-family: 'Open Sans', sans-serif;
                color: black;
            }
        </style>
    </head>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <x-adminlte-info-box title="Assets" text="{{ $hardware_count }}" icon="fas fa-lg fa-laptop"
                    icon-theme="yellow" />
            </div>
            <div class="col">

                <x-adminlte-info-box title="Users" text="{{ $user_count }}" icon="fas fa-lg fa-users"
                    icon-theme="blue" />
            </div>
        </div>
    </div>
    <div id='map' style='width: 90%; min-height: 400px; margin: auto;'></div>
    @php
        // $locations = $hardware->pluck('locationName.id', 'id');
        // dd($locations->countBy(), $hardware->pluck('locationName.id', 'model'), $hardware->pluck('locationName.name', 'id'));
        $locations = $hardware->countBy('locationName.id');
        // $locationCounts = $hardware->pluck('locationName.id', 'id')->duplicates();
        // $locationUnique = $hardware->pluck('locationName.id', 'id')->unique();
        $newLocations = [];
        foreach ($locations as $key => $value) {
            $newLocations[] = [
                'id' => $key,
                'name' => App\Models\Locations::find($key)->name,
                'latitude' => App\Models\Locations::find($key)->latitude,
                'longitude' => App\Models\Locations::find($key)->longitude,
                'assetCount' => $value,
            ];
        }
        
        $jsonData = json_encode($newLocations);
        $original_data = json_decode($jsonData, true);
        $features = [];
        foreach ($original_data as $key => $value) {
            $features[] = [
                'type' => 'Feature',
                'properties' => ['name' => $value['name'], 'description' => $value['assetCount']],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [floatval($value['longitude']), floatval($value['latitude'])],
                ],
            ];
        }
        
        $new_data = [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
        
        $final_data = json_encode($new_data, JSON_PRETTY_PRINT);
        $decoded = json_decode($final_data, true);
        //@ddd($final_data);
        //print_r($final_data);
    @endphp

    <script>
        mapboxgl.accessToken =
            'pk.eyJ1Ijoia2llcmFudzEyMyIsImEiOiJjbGRvbmlwZWowMWh0M25vNHpqM2l2aHNkIn0.LK_Zzg5x6OGQG6AJjMAIdQ';

        let map = new mapboxgl.Map({
            container: 'map',
            center: [-3.287018, 54.35594511],
            zoom: 5,
            style: 'mapbox://styles/mapbox/satellite-streets-v12',
            accessToken: 'pk.eyJ1Ijoia2llcmFudzEyMyIsImEiOiJjbGRvbmlwZWowMWh0M25vNHpqM2l2aHNkIn0.LK_Zzg5x6OGQG6AJjMAIdQ'
        });
        // const geojson = @json($final_data);
        // console.log(geojson);
        const geojson = @json($decoded);
        console.log(geojson);

        // add markers to map
        for (const feature of geojson.features) {
            // create a HTML element for each feature
            const el = document.createElement('div');
            el.className = 'marker';

            function assetCountDesc() {
                if (feature.properties.description > 1) {
                    return 'assets';
                } else {
                    return 'asset';
                }
            }
            // make a marker for each feature and add it to the map
            new mapboxgl.Marker(el)
                .setLngLat(feature.geometry.coordinates)
                .setPopup(
                    new mapboxgl.Popup({
                        offset: 25
                    }) // add popups
                    .setHTML(
                        `<h3>${feature.properties.name}</h3><p>${feature.properties.description} ${assetCountDesc()} assigned to this location.</p>`
                    )
                )
                .addTo(map);

        }
        map.addControl(new mapboxgl.FullscreenControl());
        const nav = new mapboxgl.NavigationControl({
            visualizePitch: true
        });
        map.addControl(nav, 'bottom-right');
    </script>
@stop
