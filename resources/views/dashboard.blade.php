@extends('adminlte::page')

@section('title', 'Admin Dashboard')
@section('content_header')
    <h1>Dashboard</h1>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
        <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js"></script>
        <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css" rel="stylesheet" />
        <script src="path/to/chartjs/dist/chart.umd.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('resources/js/app.js') }}"></script>



        <style>
            #map {}

            .h3 {
                color: black !important;
            }

            .marker {
                background-image: image("resources/img/mapbox-icon.png");
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
    $location_names = [];
    $location_counts = [];
    foreach ($newLocations as $location) {
        $location_names[] = $location['name'];
        $location_counts[] = $location['assetCount'];
    }
    
    $new_data = [
        'type' => 'FeatureCollection',
        'features' => $features,
    ];
    $final_data = json_encode($new_data, JSON_PRETTY_PRINT);
    $decoded = json_decode($final_data, true);
@endphp
@section('content')
    <div class="container">
        <div class="row">
            <div class="col" style="width:33%;float: left;">
                <canvas id="encryption_chart"></canvas>
            </div>
            <div class="col" style="width:33%;float: right;">
                <canvas id="lifecycle_chart"></canvas>
            </div>
            <div class="col" style="width:33%;float: centre;">
                <canvas id="new_Chart"></canvas>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Assets Map</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id='map' style='width: 100%; min-height: 500px; margin: auto;'></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

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
            <div class="col">
                <x-adminlte-info-box title="Locations with assets" text="{{ count($newLocations) }}" icon="fa fa-globe"
                    icon-theme="green" />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-adminlte-info-box title="Unencrypted devices" text="{{ $unencrypted }}/{{ $hardware_count }}"
                    icon="fa fa-unlock" icon-theme="red" />
            </div>
            <div class="col">
                <x-adminlte-info-box title="Unsynced devices" text="{{ $last_boot_time }} devices not seen for 28+ days"
                    icon="fa fa-calendar" icon-theme="red" />
            </div>
            <div class="col">
                <x-adminlte-info-box title="Potentially vulnerable devices"
                    text="{{ $vulnerabilities }} device(s) have known CVEs" icon="fa fa-exclamation-triangle"
                    icon-theme="red" />
            </div>
        </div>
    </div>

    <body>


        <script>
            var xValues = ["Encrypted", "Unencrypted"];
            var yValues = [{{ $unencrypted }}, {{ $hardware_count }}];
            var barColors = [
                "green",
                "red"
            ];

            new Chart("encryption_chart", {
                type: "doughnut",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    title: {
                        animation: true,
                        animationEasing: "easeOutSine",
                        percentageInnerCutout: 60,
                        segmentShowStroke: false,
                        display: true,
                        text: "Device Encryption Status"
                    }
                }
            });
            var xValues = ["Encrypted", "Unencrypted"];
            var yValues = [{{ $unencrypted }}, {{ $hardware_count }}];
            var barColors = [
                "green",
                "red"
            ];

            // new Chart("lifecycle_chart", {
            //     type: "doughnut",
            //     data: {
            //         labels: xValues,
            //         datasets: [{
            //             backgroundColor: barColors,
            //             data: yValues
            //         }]
            //     },
            //     options: {
            //         title: {
            //             animation: true,
            //             animationEasing: "easeOutSine",
            //             percentageInnerCutout: 60,
            //             segmentShowStroke: false,
            //             display: true,
            //             text: "Devices by Lifecycle Status"
            //         }
            //     }
            // });

            // var names = [@json($location_names)];
            // names = JSON.stringify(names);
            // console.log(names);
            // var counts = [@json($location_counts)];
            // counts = JSON.stringify(counts);
            // var xValues = names.jsonarray.map(function(e) {
            //     return e.name;

            // var yValues = [counts];

            // var barColors = [
            //     "green",
            //     "red"
            // ];

            new Chart("new_Chart", {
                type: "doughnut",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    title: {
                        animation: true,
                        animationEasing: "easeOutSine",
                        percentageInnerCutout: 60,
                        segmentShowStroke: false,
                        display: true,
                        text: "Device Encryption Status"
                    }
                }
            });
        </script>
    </body>

    <script>
        mapboxgl.accessToken =
            'pk.eyJ1Ijoia2llcmFudzEyMyIsImEiOiJjbGRvbmlwZWowMWh0M25vNHpqM2l2aHNkIn0.LK_Zzg5x6OGQG6AJjMAIdQ';

        let map = new mapboxgl.Map({
            container: 'map',
            center: [-4.139329067763081, 50.37523227813306],
            zoom: 16.5,
            style: 'mapbox://styles/mapbox/satellite-streets-v12',
            accessToken: 'pk.eyJ1Ijoia2llcmFudzEyMyIsImEiOiJjbGRvbmlwZWowMWh0M25vNHpqM2l2aHNkIn0.LK_Zzg5x6OGQG6AJjMAIdQ'
        });
        map.on('style.load', () => {
            const layers = map.getStyle().layers;
            const labelLayerId = layers.find(
                (layer) => layer.type === 'symbol' && layer.layout['text-field']
            ).id;

            map.addLayer({
                    'id': 'add-3d-buildings',
                    'source': 'composite',
                    'source-layer': 'building',
                    'filter': ['==', 'extrude', 'true'],
                    'type': 'fill-extrusion',
                    'minzoom': 15,
                    'paint': {
                        'fill-extrusion-color': '#aaa',

                        'fill-extrusion-height': [
                            'interpolate',
                            ['linear'],
                            ['zoom'],
                            15,
                            0,
                            15.05,
                            ['get', 'height']
                        ],
                        'fill-extrusion-base': [
                            'interpolate',
                            ['linear'],
                            ['zoom'],
                            15,
                            0,
                            15.05,
                            ['get', 'min_height']
                        ],
                        'fill-extrusion-opacity': .9
                    }
                },
                labelLayerId
            );
        });
        const geojson = @json($decoded);
        console.log(geojson);
        dd(geojson);
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
            new mapboxgl.Marker()
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
