(function ($) {
	/**
	*  Implements Main Menu Button event listener for expanding main menu block.
	*/
	Drupal.behaviors.crowdfunMainMenuBtn = {
		attach: function (context, settings) {
      $('#block-crf-main-crf-main', context).once('main-menu-btn', function () {
        // Add show login overlay event handler
        $('#main-menu').click(function(e) {
        	$('.menu', '#block-crf-main-crf-main').fadeToggle(100);
        	e.preventDefault();
        });
      });
    }
  };

})(jQuery);