jQuery(document).ready(function($) {
	if($('.question')[0]) {
		$('.question').each(function() {
			$(this).html($(this).html() + "<span class='d1'>|</span><span class='d2'>|</span>");
		});

		$('.question').on('click', function() {
			var $this = $(this);
			$this.toggleClass('open');
			( $this.find(".d1").css('top') === '29px' ) ? $this.find(".d1").animate({ top: 200}) : $this.find(".d1").animate({ top: 29});
			$this.next('.answer').slideToggle();
		});
	}
});