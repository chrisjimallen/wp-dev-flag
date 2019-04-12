(function ($) {
	'use strict';

	/**
	 * The badge markup & CSS is generated in this file, based on the wp_dev_flag_options object passed to the script via the wp_localize_script() call.
	 * The values are recalculated when the window is resized, in order to maintain consistent positioning.
	 */

	$(document).ready(
		function () {

			var $html = '<div class="' + ((wp_dev_flag_options.custom_class) ? wp_dev_flag_options.custom_class + ' ' : '') + 'wp-dev-flag ' + wp_dev_flag_options.horizontal + ' ' + wp_dev_flag_options.vertical + '">' + wp_dev_flag_options.message + '</div>'

			$('body').prepend($html)

			var $wp_dev_flag = $('.wp-dev-flag')
			var $wp_admin_bar = $('#wpadminbar')
			var $space = 20;

			$(window).resize(
				function () {

					$('.wp-dev-flag').css(
						{
							'display': 'inline-block',
							'width': 'auto',
							'font-family': '\'Courier New\', Courier, monospace',
							'font-size': '12pt',
							'font-weight': '900',
							'padding': '.1125rem .75rem',
							'border-radius': '3px',
							'background': wp_dev_flag_options.bg_colour,
							'color': wp_dev_flag_options.text_colour,
							'position': 'fixed',
							'z-index': '99999'
						}
					)

					$('.wp-dev-flag.left').css(
						{
							'border-radius': '0 0 3px 3px',
							'-webkit-transform': 'rotate(-90deg)',
							'-webkit-transform-origin': 'top left',
							'left': 0,
						}
					)

					$('.wp-dev-flag.right').css(
						{
							'border-radius': '0 0 3px 3px',
							'-webkit-transform': 'rotate(90deg)',
							'-webkit-transform-origin': 'top right',
							'right': 0,
						}
					)

					$('.wp-dev-flag.top').css(
						{
							'top': ($wp_dev_flag.outerWidth() + $wp_admin_bar.outerHeight() + $space)
						}
					)

					$('.wp-dev-flag.middle').css(
						{
							'top': ($(window).height() / 2) + ($wp_dev_flag.outerWidth() / 2),
						}
					)

					$('.wp-dev-flag.bottom').css(
						{
							'bottom': 0
						}
					)

					$('.wp-dev-flag.bottom.right').css(
						{
							'bottom': 0
						}
					)

				}
			)

			$(window).trigger('resize')

		}
	);

})(jQuery)
