(function ($) {

	/**
	*  Implements User Login Button event listener for expanding user login form.
	*/
	Drupal.behaviors.crowdfunCampaigns = {
    attach: function (context, settings) {
    	$('#surface', context).once('crowdfunCampaigns', function() {
    		var surface = $('#surface');
				var progressContribution = $('.contribution','.progress');

				Number.prototype.formatMoney = function(c, d, t){
					var n = this,
					    c = isNaN(c = Math.abs(c)) ? 2 : c,
					    d = d == undefined ? "." : d,
					    t = t == undefined ? "," : t,
					    s = n < 0 ? "-" : "",
					    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
					    j = (j = i.length) > 3 ? j % 3 : 0;

				   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
				};

				if (surface.length) {
					var perks = {};
					var selection;
					var selectedFields;
					var contribution;

					surface.css('background-image', settings.crf_campaign.surfaceImagePath);
					surface.css('height', surface.width() * settings.crf_campaign.surfaceImageRatio);

					surface.selectable({
						delay: 0,
						filter: 'td.field.open',
						cancel: 'td.field.closed',
						stop: function( event, ui ) {
							var elem = $(event.originalEvent.target);
							var position = elem.offset();

							selection = [];
							selectedFields = $('td.ui-selected', '#surface').length;
							contribution = 0;

							// Process field specific values
							$('.ui-selected').each(function() {
								// Add all the cpf to get a correct total
								contribution += parseFloat( $(this).data('cpf') );
								// Build the selection array with x and y coords
								selection.push( [ $(this).data('col-id'), $(this).data('row-id') ] );
							});

							// Populate fields in popover for display
							$('.amount','#popover').html(selectedFields);
							$('.value span','#popover').html( Math.round(contribution * 100) / 100 );

							$('.infobox').hide();

							// Show popover at center of last selected field
							$('#popover').css({
								'top': position.top + ( elem.height() / 2 ) ,
								'left': position.left + ( elem.width() / 2 ),
								'margin-top': -($('#popover').height() + 10),
							}).show();

							var goal = settings.crf_campaign.campaignGoal;
							var extra = Math.round(contribution / goal * 100);

							progressContribution.css('width', extra + '%' );

						}

					});

					// This click handler handles clicks on the closed fields
					// and shows the infobox
					$('td.field.closed', '#surface').click(function(event) {
						$('.infobox').hide();
						$('#popover').hide();

						var elem = $(this);
						var nid = elem.data('nid');
						var cpf = elem.data('cpf');
						var position = elem.offset();

						var amount = $('td[data-nid="' + $(this).data('nid') + '"]', '#surface').length;
						var total = amount * cpf;

						total = total.formatMoney(2, ',', '.');

						$('.amount','.infobox[data-nid="' + nid + '"]').text(amount);
						$('.value span','.infobox[data-nid="' + nid + '"]').text(total);

						$('.infobox[data-nid="' + nid + '"]').css({
							'top': position.top + ( elem.height() / 2 ) ,
							'left': position.left + ( elem.width() / 2 ),
							'margin-top': -($('.infobox[data-nid="' + nid + '"]').height() + 10),
						}).fadeIn(100);

					});

					// Highlight fields on mousover
					$('td.field.closed', '#surface').mouseover(function() {
						$('td.highlighted', '#surface').removeClass('highlighted');
						$('td[data-nid="' + $(this).data('nid') + '"]', '#surface').addClass('highlighted');
					});

					// Remove highlihgting on mouse out
					$('td.field.closed', '#surface').mouseout(function(event) {
						$('td.highlighted', '#surface').removeClass('highlighted');
					});

					$('input.quantity','.perk').change(function() {
						var quantity = parseInt(this.value);
						var nid = parseInt( $(this).parents('.perk').data('nid') );

						perks[nid] = {
							nid: nid,
							quantity: quantity
						};

					});

					$('.perk.add').click(function(){
						$('a:last-child','.campaign-links').click();
					});

					// Submit handler on popover buy button to open checkout modal window
					$('.form-submit.buy-now').click(function(event) {
						var fields;

						if (selection != null){
							fields = JSON.stringify(selection);
						}

						$.ajax({
							url: '/checkout/' + settings.crf_campaign.campaignId + '/json',
							type: 'POST',
							data: {
								selection: fields,
								perks: JSON.stringify(perks),
							},
						})
						.done(function(data) {
							var markup = JSON.parse(data);
							// Print the form in the checkout modal window
							$('#payment-method-wrapper').html(markup);
							$('#payment-method-wrapper').prepend('<a href="" class="close">close</a>')

							// Close checkout with x
							$('.close', '#payment-method-wrapper').click(function(event) {
								$('#checkout').hide();
								event.preventDefault();
							});

							$('#checkout').fadeToggle(100);

							// Toggle the state of the submit button
							$('input','.form-item-terms-of-service').click(function(event){
								if ( $(this).is( ":checked" ) ) {
									$('.form-submit','#checkout').toggleClass('disabled');
								} else {
									$('.form-submit','#checkout').toggleClass('disabled');
								}
							});

						});

						event.preventDefault();
					});

					// Close infobox with x
					$('.infobox').each(function() {
						$('.close').click(function(e) {
							$('.infobox').hide();
							$(this).parents('.infobox').hide();
							e.preventDefault();
						});
					});

					// Close popover with x
					$('.close', '#popover').click(function(e) {
						$('#popover').hide();
						e.preventDefault();
					});

					// Close the checkout with escape button
					$(document).keyup(function(event) {
						if (event.keyCode == 27) {
					  	$('#popover').hide();
					  	$('.infobox').hide();
					  	$('.modal-overlay').hide();
					  }
					});

					// Make sure height is set correct when initiating the page
					$(document).ready(function(){
						surface.css('height', surface.width() * settings.crf_campaign.surfaceImageRatio);
					});

					// Make sure height is set correct when resizing the screen
					$(window).resize(function () {
						surface.css('height', surface.width() * settings.crf_campaign.surfaceImageRatio);
					});

					// Toggle the visibility of the campaign view sections
					$('section.section').hide();
					$('#campaign').show();

					var pageHeight = $('.campaign-full').height();
					$('.campaign-full').css('min-height', pageHeight);

					$('a','.campaign-links').click(function(e) {
						var section = $('section.section');
						var target = $(this).attr('href');

						$('a','.campaign-links').removeClass('active');
						$(this).addClass('active');

						section.hide();
						$(target).show();

						e.preventDefault();
					});

				}
    	});

		}
  };

})(jQuery);
