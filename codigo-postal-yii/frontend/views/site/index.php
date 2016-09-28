<?php
/* @var $this yii\web\View */
$this->title = 'SISTEMA DE DESPACHO';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<div class="site-index">

    <div class="jumbotron">
        <h2>SISTEMA DE DESPACHO</h2>

<?php
  $url = "http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
?>
<div class="row">
	<div id="images"></div>
	<div id="postal">
		<!-- <button class="btn btn-primary" 'data' ='confirm'>
			INICIAR SESION
		</button> -->
	</div>
       <?php
//$json_string = 'https://infinite-savannah-18136.herokuapp.com/ubications';
//$jsondata = file_get_contents($json_string);

//  echo "json_string: ".$json_string;

// Create a stream
// $opts = array(
//   'http'=>array(
//     'method'=>"GET",
//     'header'=>"Accept-language: en\r\n" .
//               "Cookie: foo=bar\r\n"
//   )
// );

// $context = stream_context_create($opts);

// // Open the file using the HTTP headers set above
// $file = file_get_contents('https://infinite-savannah-18136.herokuapp.com/ubications', false, $context);



//   echo '<script>
//   var jqxhr = $.getJSON( "https://infinite-savannah-18136.herokuapp.com/ubications", function() {
//   console.log( "success" );
//   alert(" success");
// })
//   .done(function() {
//     console.log( "second success" );
//     alert("second success");
//   })
//   .fail(function() {
//     console.log( "error" );
//     alert("error");
//   })
//   .always(function() {
//     console.log( "complete" );
//     alert("complete");
//     alert(jqxhr);
//   });
 
// // Perform other work here ...
 
// // Set another completion function for the request above
// jqxhr.complete(function() {
//   console.log( "second complete" );
//   alert("second another complete");
// });


//   </script>';

//   echo '
//   <script>
// 	(function() {
//   var flickerAPI = "https://infinite-savannah-18136.herokuapp.com/ubications";
//   $.getJSON( flickerAPI, {
//     tags: "mount rainier",
//     tagmode: "any",
//     format: "json"
//   })
//     .done(function( data ) {
//       $.each( data.items, function( i, item ) {
//         $( "<div>" ).attr( "src", item.media.m ).appendTo( "#postal" );
//         if ( i === 3 ) {
//           return false;
//         }
//       });
//     });
// 	})();
// </script>
//   ';

//   echo '
//   <script>
// 	(function() {
//   var flickerAPI = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
//   $.getJSON( flickerAPI, {
//     tags: "mount rainier",
//     tagmode: "any",
//     format: "json"
//   })
//     .done(function( data ) {
//       $.each( data.items, function( i, item ) {
//         $( "<img>" ).attr( "src", item.media.m ).appendTo( "#images" );
//         if ( i === 3 ) {
//           return false;
//         }
//       });
//     });
// 	})();
// </script>
//   ';
?> 
</div>
