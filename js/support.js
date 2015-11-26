var support = (function($, _window){
    var support = {};

    support.init = function(){
        // WRITE YOUR JS HERE
		
		$('.mainBlock').hover(
		  function() {			
			$(this).addClass('shadowBlock');
			$(this).children('.shadowBlockBottom').show();
		  }, function() {			
			$(this).removeClass('shadowBlock');
			$(this).children('.shadowBlockBottom').hide();
		  }
		);
		
		$(".warning_open").click(function(event) {
		event.stopPropagation();
			$(".warning_banner").show();
			$(".warning_open").hide();
			localStorage.wantWarning = 'yes';
		});
		
		$(".warning_close").click(function(event) {
		event.stopPropagation();
			$(".warning_banner").hide();
			$(".warning_open").show();
			localStorage.wantWarning = 'no';
		});
		
		$("#lk-mail").blur(function() {
			$("#lk-login").val($("#lk-mail").val());
		});
		
		$("#third_step_icon").click(function(event) {
		event.stopPropagation();
			$("#third_step_btn").click();
		});
		
        return this;
    };

    return support;
})(jQuery, window);
/**
 * Created by SKIff on 19.12.14.
 */
