jQuery(document).ready(function($) {
	if($('.accordion-header')[0]) {
		$('.accordion-header').each(function() {
			$(this).html($(this).html() + "<div class='d'><span class='d1'>|</span><span class='d2'>|</span></div>");
		});

		$('.accordion-header').click(function() {
            var $this = $(this);
            if ($this.next('.accordion-body-text').is(':hidden')) {
                $this.find('.d1').animate({ top: 40 });
                $this.next('.accordion-body-text').slideDown('fast');
                $this.addClass('open');
            } else {
                $('.d1').animate({ top: -1 });
                $('.accordion-header').removeClass('open');
                $('.accordion-body-text').slideUp('fast');
            }
		});

		$('.expand-all').click(function() {
            if ( $(this).html() === 'Expand all' ) {
                $(this).html('Collapse all');
                $('.accordion-body-text').slideDown('fast');
                $('.accordion-body-text').addClass('open');
                $('.d1').animate({ top: 40 });
            } else {
                $(this).html('Expand all');
                $('.accordion-body-text').slideUp('fast');
                $('.accordion-body-text').removeClass('open');
                $('.d1').animate({ top: -1 });

            }
		});
	}
});