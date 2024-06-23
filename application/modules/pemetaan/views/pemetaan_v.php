	<link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
    <!--  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY" async defer></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js" async defer></script> -->
<script src="https://maps.googleapis.com/maps/api/js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--  <link rel="stylesheet" href="../Leaflet/dist/leaflet.css" />
<script type="text/javascript" src="../Leaflet/dist/leaflet-src.js"></script>-->

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet-src.js" integrity="sha512-I5Hd7FcJ9rZkH7uD01G3AjsuzFy3gqz7HIJvzFZGFt2mrCS4Piw9bYZvCgUE0aiJuiZFYIJIwpbNnDIM6ohTrg==" crossorigin=""></script>

<!--        <script type="text/javascript" src="dist/Leaflet.GoogleMutant.js"></script> -->
<script src="https://unpkg.com/leaflet.gridlayer.googlemutant@latest/dist/Leaflet.GoogleMutant.js"></script>


		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo $subtitle; ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                    </li>
                    <li class="active">
                        <strong><?php echo $subtitle; ?></strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Pemetaan</h5>
                            <div class="ibox-tools">
                                <a class="fullscreen-link">
                                    <i class="fa fa-expand" id="expand"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                        
                        

                            <div id="map" style="height: 650px;" class="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<script type="text/javascript">
    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [-6.96938, 107.81871];
    }
    var mapopts = {
        zoomSnap: 0.25,
    };

    var map = L.map("map", mapopts).setView([-6.96938, 107.81871], 16);

    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: 'true'
    });
    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        // $("#lat").val(position.lat);
        // $("#long").val(position.lng).keyup();
        alert(position);
    });

    map.addLayer(marker);


    var roadMutant = L.gridLayer
        .googleMutant({
            maxZoom: 24,
            type: "satellite",
        })
        .addTo(map);

    var satMutant = L.gridLayer.googleMutant({
        maxZoom: 24,
        type: "satellite",
    });

    var terrainMutant = L.gridLayer.googleMutant({
        maxZoom: 24,
        type: "terrain",
    });

    var hybridMutant = L.gridLayer.googleMutant({
        maxZoom: 24,
        type: "hybrid",
    });

    var styleMutant = L.gridLayer.googleMutant({
        styles: [{
                elementType: "labels",
                stylers: [{
                    visibility: "off"
                }]
            },
            {
                featureType: "water",
                stylers: [{
                    color: "#444444"
                }]
            },
            {
                featureType: "landscape",
                stylers: [{
                    color: "#eeeeee"
                }]
            },
            {
                featureType: "road",
                stylers: [{
                    visibility: "off"
                }]
            },
            {
                featureType: "poi",
                stylers: [{
                    visibility: "off"
                }]
            },
            {
                featureType: "transit",
                stylers: [{
                    visibility: "off"
                }]
            },
            {
                featureType: "administrative",
                stylers: [{
                    visibility: "off"
                }]
            },
            {
                featureType: "administrative.locality",
                stylers: [{
                    visibility: "off"
                }],
            },
        ],
        maxZoom: 24,
        type: "roadmap",
    });

    var trafficMutant = L.gridLayer.googleMutant({
        maxZoom: 24,
        type: "roadmap",
    });
    trafficMutant.addGoogleLayer("TrafficLayer");

    var transitMutant = L.gridLayer.googleMutant({
        maxZoom: 24,
        type: "roadmap",
    });
    transitMutant.addGoogleLayer("TransitLayer");



    var grid = L.gridLayer({
        attribution: "Debug tilecoord grid", //disini gridlayer
    });

    // grid.createTile = function(coords) {
    //     var tile = L.DomUtil.create("div", "tile-coords");
    //     tile.style.border = "1px solid black";
    //     tile.style.lineHeight = "256px";
    //     tile.style.textAlign = "center";
    //     tile.style.fontSize = "20px";
    //     tile.innerHTML = [coords.x, coords.y, coords.z].join(", ");

    //     return tile;
    // };
    L.polygon([
        [-6.968277, 107.840530],
        [-6.968325, 107.840400],
        [-6.968367, 107.840207],
        [-6.968469, 107.840019],
        [-6.968574, 107.839836],
        [-6.968584, 107.839637],
        [-6.968595, 107.839461],
        [-6.968417, 107.839182],
        [-6.968196, 107.838889],
        [-6.968065, 107.838699],
        [-6.967810, 107.838380],
        [-6.967610, 107.838463],
        [-6.967585, 107.838435],
        [-6.967492, 107.838482],
        [-6.967536, 107.838644],
        [-6.967472, 107.838675],
        [-6.967533, 107.838791],
        [-6.967675, 107.838820],
        [-6.967770, 107.838853],
        [-6.967899, 107.838999],
        [-6.968007, 107.839257],
        [-6.968048, 107.839423],
        [-6.968064, 107.839540],
        [-6.967950, 107.839647],
        [-6.967948, 107.839691],
        [-6.968185, 107.840054],
        [-6.968200, 107.840101],
        [-6.968166, 107.840307],
        [-6.968224, 107.840454],
        [-6.968244, 107.840493]
    ]).addTo(map).bindPopup("CK 1 KR");
    L.polygon([
        [-6.968072, 107.840081],
        [-6.968136, 107.840034],
        [-6.968036, 107.839874],
        [-6.967912, 107.839683],
        [-6.967913, 107.839648],
        [-6.967943, 107.839594],
        [-6.968033, 107.839526],
        [-6.968029, 107.839441],
        [-6.967998, 107.839281],
        [-6.967931, 107.839126],
        [-6.967901, 107.839044],
        [-6.967819, 107.838954],
        [-6.967657, 107.838849],
        [-6.967523, 107.838804],
        [-6.967481, 107.838762],
        [-6.967185, 107.838772],
        [-6.967016, 107.838773],
        [-6.966932, 107.838722],
        [-6.966862, 107.838573],
        [-6.966719, 107.838604],
        [-6.966656, 107.838395],
        [-6.966604, 107.838381],
        [-6.966544, 107.838322],
        [-6.966428, 107.838427],
        [-6.966556, 107.838919],
        [-6.966723, 107.839437],
        [-6.967128, 107.839928],
        [-6.967203, 107.840022],
        [-6.967530, 107.840064],
        [-6.967866, 107.840043],
        [-6.967940, 107.840040],
        [-6.968029, 107.840103]
    ], {
        color: 'red',
        fillColor: 'red',
        fillOpacity: 0.3
    }).addTo(map).bindPopup("CK 1 KN");

    var latlngs = [
        [-6.970732, 107.826845],
        [-6.970523, 107.826358],
        [-6.970454, 107.825877],
        [-6.970201, 107.825371],
        [-6.970220, 107.825210],
        [-6.970438, 107.824941],
        [-6.970438, 107.824829],
        [-6.970150, 107.824829],
        [-6.970052, 107.824732],
        [-6.970009, 107.824378],
        [-6.970073, 107.824295],
        [-6.970496, 107.824105],
        [-6.970576, 107.823944],
        [-6.970448, 107.823777],
        [-6.970035, 107.823628],
        [-6.969803, 107.822401],
        [-6.969699, 107.822272],
        [-6.969450, 107.822058],
        [-6.969405, 107.821959],
        [-6.969443, 107.821245],
        [-6.969446, 107.821215],
        [-6.969555, 107.821059],
        [-6.969661, 107.820993],
        [-6.969823, 107.820939],
        [-6.970013, 107.820798],
        [-6.970084, 107.820632],
        [-6.970082, 107.820486],
        [-6.970038, 107.820327],
        [-6.969938, 107.820191],
        [-6.96984, 107.820074],
        [-6.969931, 107.819919],



    ];
    var polyline = L.polyline(latlngs, {
        color: 'yellow'
    }).addTo(map).bindPopup("Sungai Citarik");



    L.polygon([

        [-6.970081, 107.817185],
        [-6.969879, 107.817142],
        [-6.969861, 107.816927],
        [-6.969815, 107.816745],
        [-6.969703, 107.8166],
        [-6.969576, 107.815651],
        [-6.969607, 107.815329],
        [-6.969884, 107.81503],
        [-6.969954, 107.815127],
        [-6.970238, 107.814877],
        [-6.970601, 107.814624],
        [-6.970865, 107.814442],
        [-6.971398, 107.813921],
        [-6.972009, 107.813998],
        [-6.972286, 107.81417],
        [-6.97235, 107.814363],
        [-6.971961, 107.814642],
        [-6.971855, 107.814808],
        [-6.97162, 107.814841],
        [-6.971242, 107.814648],
        [-6.971061, 107.81469],
        [-6.971034, 107.815066],
        [-6.970976, 107.815264],
        [-6.970917, 107.815468],
        [-6.970912, 107.815661],
        [-6.970593, 107.815562],
        [-6.97045, 107.815625],
        [-6.970364, 107.81571],
        [-6.970321, 107.815935],
        [-6.97038, 107.81623],
        [-6.970774, 107.816659],
        [-6.970891, 107.817024],
        [-6.970795, 107.817104],
        [-6.970582, 107.81711],
        [-6.97038, 107.817062],
        [-6.970081, 107.817629],
        [-6.970225, 107.817877],
        [-6.970261, 107.818188],
        [-6.97057, 107.818396],
        [-6.970453, 107.818535],
        [-6.970287, 107.81882],
        [-6.970346, 107.819059],
        [-6.970183, 107.819288],
        [-6.970187, 107.819801],
        [-6.969849, 107.820072],
        [-6.970029, 107.82033],
        [-6.970089, 107.820496],
        [-6.970083, 107.820633],
        [-6.970013, 107.820799],
        [-6.96982, 107.820939],
        [-6.969643, 107.821],
        [-6.969693, 107.819942],
        [-6.969719, 107.819202],
        [-6.96965, 107.818805],
        [-6.970076, 107.818601],
        [-6.970032, 107.818184],
        [-6.969934, 107.818088],
        [-6.969687, 107.817823],
        [-6.969605, 107.817766],
        [-6.96956, 107.8176],
        [-6.969643, 107.817306],
        [-6.969765, 107.817271],
        [-6.970081, 107.817185],




       
     
       


    



       
    ], {
        color: 'blue',
        fillColor: 'blue',
        fillOpacity: 0.3
    }).addTo(map).bindPopup("Titik TRB");


    L.polygon([
        [-6.972197, 107.815511],
        [-6.973733, 107.814783],
        [-6.973026, 107.813584],
        [-6.971218, 107.815132]
    ], {
    color: '#ef800e91',
    fillColor: 'blue',
    fillOpacity: 0.1
    }).addTo(map).bindPopup("Titik TRB");
    
    
    
    var baseMaps = {
        "Roadmap": roadMutant,
        "Aerial": satMutant,
        "Terrain": terrainMutant,
        "Hybrid": hybridMutant,
        "Styles": styleMutant,
        "Traffic": trafficMutant,
        "Transit": transitMutant,
    };
    L.control
        .layers(baseMaps, {
            "Tilecoord grid": grid,
        }, {
            collapsed: true,
        })
        .addTo(map);
</script>
