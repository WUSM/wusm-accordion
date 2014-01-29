jQuery(document).ready(function($) {
	if($('.accordion-header')[0]) {
		$('.accordion-header').each(function() {
			$(this).html($(this).html() + "<div class='d'><span class='d1'></span><span class='d2'></span></div>");
		});

		$('.accordion-header').click(function() {
			$('.open').find('.d1').animate({ top: 0 });
			$('.open').next('.accordion-body-text').slideUp('fast');
			$('.open').removeClass('open');
			var $this = $(this);
			if ($this.next('.accordion-body-text').is(':hidden')) {
				$this.find('.d1').animate({ top: 50 });
				$this.next('.accordion-body-text').slideDown('fast');
				$this.addClass('open');
			}
		});

		$('.expand-all').click(function() {
			if ( $(this).html() === 'Expand all' ) {
				$(this).html('Collapse all');
				$('.accordion-body-text').slideDown('fast');
				$('.accordion-body-text').addClass('open');
				$('.d1').animate({ top: 50 });
			} else {
				$(this).html('Expand all');
				$('.accordion-body-text').slideUp('fast');
				$('.accordion-body-text').removeClass('open');
				$('.d1').animate({ top: 0 });
			}
		});
	}
});