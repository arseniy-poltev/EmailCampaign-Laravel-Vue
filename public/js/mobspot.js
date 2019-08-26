/* coded by lucagarbin.it */

function set_mittente(val){
	if(val == 'checked')
		$('#mittente_personalizzato').show()
	else
		$('#mittente_personalizzato').hide()
}

$(document).ready(function(){
	if($.fn.royalSlider){
		$.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
		$('#home-slider').royalSlider({
			arrowsNav: false,
			transitionSpeed: 1000,
			arrowsNavAutoHide: true,
			fadeinLoadedSlide: false,
			controlNavigationSpacing: 0,
			controlNavigation: 'bullets',
			imageScaleMode: 'fill',
			imageAlignCenter:true,
			blockLoop: true,
			loop: true,
			loopRewind: true,
			numImagesToPreload: 6,
			transitionType: 'fade',
			keyboardNavEnabled: true,
			autoScaleSlider: true,
			autoScaleSliderWidth: 950,
			autoScaleSliderHeight: 301,
			block: {
				delay: 0
			},
			autoPlay: {
				enabled: true,
				delay: 5000,
				stopAtAction: false,
				pauseOnHover:false
			}
		});	
	}

	if($.fn.selectize)
		$('form select').selectize({create: true});

	$( "input.datepicker" ).datepicker();
	
	$('table.elenco-campagne .bt-dettaglio').on('click',function(){
		var bt = $(this),
			c = $(this).closest('td').find('.dettaglio')
		
		if(c.is(':visible')){
			bt.text('Dettaglio')
			c.hide()
		}else{
			bt.text('Chiudi dettaglio')
			c.show()
		}
		
	})
	
	$('#faq .question').on('click',function(){
		var c = $(this).closest('.item'),
			t = c.find('.text');
			
		if(!t.is(':visible')){
			t.fadeIn()
		}else{
			t.fadeOut()
		}
	})
	
//	$('.box-question').on('click',function(){
//		var w = window.open('', '', 'width=300,height=380,resizeable,scrollbars');
//		w.document.write($('#text-question').html());
//		w.document.close();
//	})
	
	
})

$(window).load(function(){
})