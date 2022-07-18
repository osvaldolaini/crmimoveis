var App_cadastros = function () {
    /*Selecion pacotes de rebocador e inseri os valores */
    let selectSecoes = function(){
        $(document).on('change', '#orgmil_id', function () {
            let orgmil = $(this).val()
            let url = $(this).data("url")
            $.ajax({
                url:url,
                method:'GET',
                data:{orgmil:orgmil},
                cache: false,
                success: function(response){
                    $('#secao_id').html('');
                    console.log(response.data)
                    if (response.success == true) {
                        $('#secao_id').append(
                            '<option value="">Selecione...</option>'
                        )
                        response.data.forEach(secao => {
                            $('#secao_id').append(
                                '<option value="'+secao.id+'" >'+secao.name+'</option>'
                            )
                        })
                    }else{
                        $('#secao_id').append(
                            '<option value="">'+response.message+'</option>'
                        )
                    }
                },
                error: function(response){
                    //console.log(response.responseJSON)
                }
            })
        })
    }
    /*Selecion aeronave e busca pacotes de rebocador*/
    let selectSubsecoes = function(){
        $(document).on('change', '#secao_id', function () {
            let secao = $(this).val()
            let url = $(this).data("url")
            $.ajax({
                url:url,
                method:'GET',
                data:{secao:secao},
                cache: false,
                success: function(response){
                    $('#subsecao_id').html('');
                    console.log(response.data)
                    if (response.success == true) {
                        $('#subsecao_id').append(
                            '<option value="">Selecione...</option>'
                        )
                        response.data.forEach(subsecao => {
                            $('#subsecao_id').append(
                                '<option value="'+subsecao.id+'" >'+subsecao.name+'</option>'
                            )
                        })
                    }else{
                        $('#subsecao_id').append(
                            '<option value="">'+response.message+'</option>'
                        )
                    }
                },
                error: function(response){
                    //console.log(response.responseJSON)
                }
            })
        })
    }

    return{
        init: function(){
            selectSecoes()
            selectSubsecoes()
        }
    }
}()
jQuery(document).ready(function(){
    App_cadastros.init()
})
