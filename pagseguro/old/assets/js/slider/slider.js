/* Demo Scripts for Bootstrap Carousel and Animate.css article*/
(function ($) {
	function doAnimations(elems) {
		var animEndEv = 'webkitAnimationEnd animationend';
		elems.each(function () {
			var $this = $(this),
				$animationType = $this.data('animation');
			$this.addClass($animationType).one(animEndEv, function () {
				$this.removeClass($animationType);
			});
		});
	}
	var $mainslider = $('#mainslider'),
		$firstAnimatingElems = $mainslider.find('.item:first').find("[data-animation ^= 'animated']");
	$mainslider.carousel();
	doAnimations($firstAnimatingElems);
	$mainslider.carousel('pause');
	$mainslider.on('slide.bs.carousel', function (e) {
		var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
		doAnimations($animatingElems);
	});

})(jQuery);


/*Todos os Sliders do mesmo tamanho*/

function carouselNormalization() {
	var items = $('#mainslider .item'), // grab all the slides
		heights = [], // array to store heights
		tallest; // tallest slide

	if (items.length) {
		function normalizeHeights() {
			items.each(function () {
				heights.push($(this).height()); // add each slide's height
			}); // to the array

			tallest = Math.max.apply(null, heights); // find the largest height

			items.each(function () {
				$(this).css('height', tallest + 'px'); // set each slide's minimum
			}); // height to the largest
		};

		normalizeHeights();

		$(window).on('resize orientationchange', function () {
			tallest = 0, heights.length = 0; // reset the variables

			//			items.each(function () {
			//				$(this).css('min -height', '0'); // reset each slide's height
			//			});

			normalizeHeights(); // run it again
		});
	}
}


/* Touch */

$(".carousel-inner").swipe({
	//Generic swipe handler for all directions
	swipeLeft: function (event, direction, distance, duration, fingerCount) {
		$(this).parent().carousel('next');
	},
	swipeRight: function () {
		$(this).parent().carousel('prev');
	},
	//Default is 75px, set to 0 for demo so any distance triggers swipe
	threshold: 0
});
