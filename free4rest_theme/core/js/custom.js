
// $(window).load(function() {
//   // The slider being synced must be initialized first
//   $('#carousel').flexslider({
//     animation: "slide",
//     controlNav: false,
//     animationLoop: false,
//     slideshow: false,
//     itemWidth: 210,
//     itemMargin: 5,
//     asNavFor: '#slider'
//   });
 
//   $('#slider').flexslider({
//     animation: "slide",
//     controlNav: false,
//     animationLoop: false,
//     slideshow: false,
//     sync: "#carousel"
//   });
// });



jQuery(document).ready(function($) {

	  $('.rent_bxslider').bxSlider({
	    mode: 'fade',
	   //adaptiveHeight: true,
	    //slideWidth: 1300
	  });

	  $('.bxslider').bxSlider({
	    mode: 'fade',
	    adaptiveHeight: true,
	    slideWidth: 600
	  });

	  $('.image-link').magnificPopup({
	  	  type:'image',
  		  gallery:{enabled:true},
	  });

	  // 
	  $('div.LA_filters_checkbox.filters_image .slug-springs').parent().hide();
	  $('div.LA_filters_checkbox.filters_image .slug-castles').parent().hide();
	  $('div.LA_filters_checkbox.filters_image .slug-hiking').parent().hide();

});