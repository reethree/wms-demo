(function($) {
$(document).ready(function(){
	
// Define Json
    var markers = [
            {
   "title": 'Grays',
   "lat": '51.483273',
   "lng": '0.322951'
   
},

{
   "title": 'Bromley',
   "lat": '51.411542',
   "lng": '0.012636'
},
{
   "title": 'Warlingham',
   "lat": '51.308674',
   "lng": '-0.051747'
},
{
   "title": 'West Kingsdown',
   "lat": '51.342253',
   "lng": '0.255898'
}
    ];

   	
// Set style
   var styles = [
    {
      featureType: "all",
      elementType: "all",
      stylers: [
        { saturation: -100 } // <-- THIS
      ]
    }
];


// call style map
   	var styledMap = new google.maps.StyledMapType(styles,
    {name: "Styled Map"});

   	
   	// define map options
	 var mapOptions = {
						center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
						zoom: 11,
						scrollwheel: false

		           };
		
	// create infowindo object..
       // var infoWindow = new google.maps.InfoWindow();
   // create map object
        
          var map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
 
 var boxText = document.createElement("div");
      

        var myOptions = {
             content: boxText
            ,disableAutoPan: false
            ,maxWidth: 0
            ,pixelOffset: new google.maps.Size(10, 50)
            ,zIndex: 1
            ,boxStyle: { 
              background: "url('tipbox.gif') no-repeat"
              ,opacity: 1
              ,width: 'auto'
             }
            ,closeBoxMargin: "10px 2px 2px 2px"
            
            ,infoBoxClearance: new google.maps.Size(5, 5)
            ,isHidden: false
            ,pane: "floatPane"
            ,enableEventPropagation: false
        };

 
         
        var i = 0;
  // Set interval
        var interval = setInterval(function () {
        	
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
          // define markar option
            var marker = new google.maps.Marker({
                position: myLatlng,
                icon:"assets/images/marker.png",
                map: map,
                title: data.title,
                animation: google.maps.Animation.DROP
            });
         
         // set style
            // map.mapTypes.set('map_style', styledMap);
            // map.setMapTypeId('map_style');
        // generate markar and set markar
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                   // infoWindow.setContent(data.description);
                    //infowindow.open(map, marker);
                    // boxText.innerHTML = data.description;
                     ib.open(map, marker)
                     map.panTo(myLatlng);
                });
            })(marker, data);
            // var ib = new InfoBox(myOptions);
                   //ib.open(map, this)
            i++;
            if (i == markers.length) {
                clearInterval(interval);
            }
        }, 200);
	
})
})(jQuery);