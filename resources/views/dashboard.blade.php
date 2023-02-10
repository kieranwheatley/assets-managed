@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
        <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js"></script>
        <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css" rel="stylesheet" />
        <script src="path/to/chartjs/dist/chart.umd.js"></script>

        <style>
            #map {}

            .h3 {
                color: black !important;
            }

            .marker {
                background-image: URL('images/mapbox-icon.png');
                background-size: cover;
                width: 40px;
                height: 40px;
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

    @php
        $locations = $hardware->countBy('locationName.id');
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
    @endphp
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Assets Map</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i></button>
                            <!-- This will cause the card to collapse when clicked -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <!-- This will cause the card to be removed when clicked -->
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i></button> --}}
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id='map' style='width: 100%; min-height: 500px; margin: auto;'></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div>

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
        const geojson = @json($decoded);
        console.log(geojson);
        for (const feature of geojson.features) {
            const el = document.createElement('div');
            el.className = 'marker';

            function assetCountDesc() {
                if (feature.properties.description > 1) {
                    return 'assets';
                } else {
                    return 'asset';
                }
            }
            new mapboxgl.Marker(el)
                .setLngLat(feature.geometry.coordinates)
                .setPopup(
                    new mapboxgl.Popup({
                        offset: 25
                    })
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
