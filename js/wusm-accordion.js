jQuery(document).ready(function($) {
	if($('.accordion-header')[0]) {
		$('.accordion-header').each(function() {
			$(this).html($(this).html() + "<div class='d'><span class='d1'></span><span class='d2'></span></div>");
		});

		$('.accordion-header').click(function() {
			$('.open-accordion').find('.d1').animate({ top: 0 });
			$('.open-accordion').next('.accordion-body-text').slideUp('fast');
			$('.open-accordion').removeClass('open-accordion');
			var $this = $(this);
			if ($this.next('.accordion-body-text').is(':hidden')) {
				$this.find('.d1').animate({ top: 100 });
				$this.next('.accordion-body-text').slideDown('fast');
				$this.addClass('open-accordion');
			}
		});

		$('.expand-all').click(function() {
			if ( $(this).html() === 'Expand all' ) {
				$(this).html('Collapse all');
				$('.accordion-body-text').slideDown('fast');
				$('.accordion-body-text').addClass('open-accordion');
				$('.d1').animate({ top: 100 });
			} else {
				$(this).html('Expand all');
				$('.accordion-body-text').slideUp('fast');
				$('.accordion-body-text').removeClass('open-accordion');
				$('.d1').animate({ top: 0 });
			}
		});
	}
});