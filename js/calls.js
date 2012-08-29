function sendFeedback() {
	$.post('http://www.slaff.net/libs/php/doFeedback.php', 
		$('#feedbackForm').serialize(), function(data) {	
			var datamsg = data.split('!');
			$('#message-area').hide();
			if (datamsg[0] != 'Ошибка') {			
				// messages
				$('#message-area').removeClass('error');
				$('#message-area').addClass('success').show('slow');			
			} else {
				$('#message-area').removeClass('success');
				$('#message-area').addClass('error').show('slow');
			}
		$('#message-area').html(data).show('slow');
	});
}
 
// Use jQuery via $j(...)
$(document).ready(function(){
	// fancybox
	//$("p.attachment a").fancybox();
	//$("a.fancy").fancybox();
	
	$("p.attachment a").fancybox({
		      	'autoDimensions'	: true,
						'transitionIn'		: 'none',
						'transitionOut'		: 'none',
						'overlayOpacity'	: 0.8,
						'overlayColor'		: '#000'
	});
	$("a.fancy").fancybox({
		      	'autoDimensions'	: true,
						'transitionIn'		: 'none',
						'transitionOut'		: 'none',
						'overlayOpacity'	: 0.8,
						'overlayColor'		: '#000'
	});
	
		
	
	$(".avatar").load(function() {
		$(this).wrap(function(){
			return '<span class="' + $(this).attr('class') + '" style="background:url(' + $(this).attr('src') + ') no-repeat center center; width: ' + $(this).width() + 'px; height: ' + $(this).height() + 'px;" />';
		});
	$(this).css("opacity","0");
	});	
	
});