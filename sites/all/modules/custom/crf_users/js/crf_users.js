(function ($) {
	/**
	*  Implements User Login Button event listener for expanding user login form.
	*/
	Drupal.behaviors.crowdfunUserLoginBtn = {
    attach: function (context, settings) {
      $('#user-login-btn', context).once('user-login-btn', function () {
        // Add show login overlay event handler
        $('a[href="/user/login"]').click(function(event){
          $('.modal-overlay', '#block-crf-users-crf-user-login').fadeToggle(100);
          event.preventDefault();
        });

        // Add close event handler (make close buttons smarter)
        $('.close','#block-crf-users-crf-user-login').click(function(e){
          $(this).closest('.modal-overlay').fadeToggle(100);
          e.preventDefault();
        });

      });
    }
  };
	Drupal.behaviors.crowdfunUserLinks = {
		attach: function (context, settings) {
			// Toggle the visibility of the campaign view sections
			$('section.section').hide();
			$('#liked').show();

			$('a','.user-links').click(function(e) {
				var section = $('section.section');
				var target = $(this).attr('href');

				$('a','.user-links').removeClass('active');
				$(this).addClass('active');

				section.hide();
				$(target).show();

				e.preventDefault();
			});

		}
	};
})(jQuery);
