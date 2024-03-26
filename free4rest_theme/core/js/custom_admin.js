jQuery(document).ready(function($) {

		  $('.get-markers').click(function(event) {
		  		 //console.log( $("input[name='locate-anything-lat']").val() );
		  		 //console.log( $("input[name='locate-anything-lon']").val() );
		  		 if ( $("input[name='locate-anything-lat']").val() && $("input[name='locate-anything-lon']").val() ) {
			  		 $('#acf-field_5b854a3d60cd8').val(  $("input[name='locate-anything-lat']").val() );
			  		 $('#acf-field_5b854a8760cd9').val( $("input[name='locate-anything-lon']").val() );
			  	}
		  });
});