        (function($) {
          "use strict";

    /* ==============================================
    OFFSET MENU
    =============================================== */

        smoothScroll.init({
            speed: 500, // Integer. How fast to complete the scroll in milliseconds
            easing: 'easeInOutCubic', // Easing pattern to use
            updateURL: false, // Boolean. Whether or not to update the URL with the anchor hash on scroll
            offset: 70, // Integer. How far to offset the scrolling anchor location in pixels
            callbackBefore: function ( toggle, anchor ) {}, // Function to run before scrolling
            callbackAfter: function ( toggle, anchor ) {} // Function to run after scrolling
        });

    /* ==============================================
    AFF NEBU
    =============================================== */

    $(".header .menu-wrapper").affix({
        offset: {
            top: 200, 
            bottom: function () {
            return (this.bottom = $('.footer').outerHeight(true))
            }
        }
    })

    /* ==============================================
    MAP
    =============================================== */

            var locations = [
            ['<div class="infobox"><h3 class="title"><a href="about-1.html">LIRA PAULISTANA</a></h3><span>SÃO PAULO / 65</span><br></p></div></div></div>', -23.574041,-46.631317, 2]
            ];
        
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 15,
                scrollwheel: false,
                navigationControl: true,
                mapTypeControl: false,
                scaleControl: false,
                draggable: false,
                styles: [ { "stylers": [ { "hue": "#000" },  {saturation: -200},
                    {gamma: 0.50} ] } ],
                center: new google.maps.LatLng(-23.574041,-46.631317),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        
            var infowindow = new google.maps.InfoWindow();
        
            var marker, i;
        
            for (i = 0; i < locations.length; i++) {  
          
                marker = new google.maps.Marker({ 
                position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
                map: map ,
                icon: '../default/images/marker.png'
                });
        
        
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
        })(jQuery);