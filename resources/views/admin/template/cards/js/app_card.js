var Ticket = function () {
	const BASE_URL = $('meta[name="app_url"]').attr('content')
	/*Funções internas */
	function updateElem(event, ui) {
		let rel = $(this).attr("rel")
		$("#" + rel).val([parseInt($(this).width(), 10), parseInt($(this).height(), 10), ui.position.left, ui.position.top].join("|"))
	}
	var opts = {
		containment: "parent",
		stop: function(e, ui) {
			updateElem.apply(this, [e, ui]);
		}
	}

	/*Imagem do convite */
    function enviarArquivo(event){
        var data = new FormData();
        var request = new XMLHttpRequest();
        data.append('file', document.querySelector('#image_card').files[0])
        //Resposta em JSON
        request.responseType = 'json';
        // Caminho
        request.open('post', APP_URL + '/upload-card/'+event);
        request.setRequestHeader('x-csrf-token', CSRF_TOKEN);
        request.send(data);
    }
	/*Imagem do salão */
	let changeImageTicket = function(){
        $(document).on('change', '#image_card', function () {

            let idEvent =$('.save').data("id")
			var files = this.files
			if(files && files[0]){
                enviarArquivo(idEvent)
				var reader = new FileReader();
				reader.onload = function(e){
                    //$("#main").removeClass('d-none')
					setTimeout(function(){
                        //$("#main").addClass('d-none')
					$("#ticketImage").remove()
					$("#ticketHolder").append("<img class='form-control' id='ticketImage' src='#'>");
					$('#ticketImage').attr('src',e.target.result);
					},2000);
				};
				reader.readAsDataURL(files[0]);
			}
		})
	}
	/*Cor da fonte */
	let fontColor = function(){
		$(document).on('change', '[name=font_color]', function () {
			let fontColor = $(this).val()
			document.getElementById('ticketHolder').style.color = fontColor;
            $('input#font_color').val(fontColor);
		})
	}
	/*Tamanho da fonte */
	let fontSize = function(){
		$(document).on('change', '[name=font_size]', function () {
			let fSize = $(this).val()
			document.getElementById('ticketHolder').style.fontSize = fSize +'pt';
			document.getElementById('ticketHolder').style.lineHeight = fSize +'pt';
            $('input#font_size').val(fSize);
		})
	}
	/*Tamanho da fonte */

	let status = function(){
		$(document).on('change', '.ckb', function () {
			let id = $(this).attr('data-ckb')
			if( $(this).is(":checked") == false){
				$('#'+id).val("0");
				$('[data-check='+id+']').addClass('d-none')
			}else{
				$('#'+id).val("1");
				$('[data-check='+id+']').removeClass('d-none')
			}
		})
	}

	return{
		init: function(){
			$("span.itens").draggable(opts).resizable(opts)
			changeImageTicket()
			fontColor()
			fontSize()
			status()
		}
	  }
	}();

	jQuery(document).ready(function(){
	  Ticket.init();
	});
