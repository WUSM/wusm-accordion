jQuery(document).ready(function($) {
	if($('.accordion-header')[0]) {
		$('.accordion-header').each(function() {
			$(this).html($(this).html() + "<span class='d1'>|</span><span class='d2'>|</span>");
		});

		$('.accordion-header').click(function() {
            $('.accordion-header').removeClass('open');
            $('.accordion-body-text').slideUp('fast');
            $('.d1').css('top','14px');
			var $this = $(this);
            if ($this.next('.accordion-body-text').is(':hidden')) {
                $this.next('.accordion-body-text').slideDown('fast');
                $this.addClass('open');
                $this.find('.d1').animate({ top: 200 });
            }
		});

		$('.expand-all').click(function() {
            if ( $(this).html() === 'Expand all' ) {
                $(this).html('Collapse all');
                $('.accordion-body-text').slideDown('fast');
                $('.accordion-body-text').addClass('open');
                $('.d1').animate({ top: 200 });
            } else {
                $(this).html('Expand all');
                $('.accordion-body-text').slideUp('fast');
                $('.accordion-body-text').removeClass('open');
                $('.d1').animate({ top: 14 });

            }
		});
	}
});