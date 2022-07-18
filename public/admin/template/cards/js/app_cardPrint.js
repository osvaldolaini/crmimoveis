var TicketPrint = function () {
	let preload = function() {
		$(window).on('load', function() {
            if ($('.preloader').length) {
                 $('.preloader').delay(100).fadeOut('slow', function() {
                    $(this).remove();
                });
            }
        });
	}

	let printTicket = function() {
		html2canvas(document.querySelector(".capture")).then(canvas => {
	    	$('#myCanvas').append(canvas)
	    	$('canvas').attr('id','canvas')
	    	var canvas = document.getElementById('canvas')
	        var fullQuality = canvas.toDataURL('image/jpeg', 1.0);
	        //var mediumQuality = canvas.toDataURL('image/jpeg', 0.5)
            //console.log(mediumQuality)
	        //var lowQuality = canvas.toDataURL('image/jpeg', 0.1);
			$('#myCanvas').addClass('d-none')
			$('.capture').addClass('d-none')

	        $.ajax({
	            url: APP_URL + '/crachas-download',
	            dataType: 'text',
	            data:{data:fullQuality},
	            type : "POST",
	            success: function(response){
	                window.location.href = APP_URL+'/crachas-printCard'
	            },
	            error: function(response){
	                //console.log(response)
	            }
	        })
		  //FUNÇÃO UPLOAD
	    });
	}

	return{
		init: function(){
			preload()
			printTicket()
		}
	  }
	}();

	jQuery(document).ready(function(){
	  TicketPrint.init();
	});
