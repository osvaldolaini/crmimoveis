var App_emails = function () {
    /*Delete parcel não paga */
    let btn_send = function(){
        $(document).on('click','.btn-send', function(){

            var table = $(this).data('table')
            var id = $(this).data('id')

            //console.log(table)
            //console.log(id)

            Swal.fire({
                title: 'Você realmente quer enviar o email?',
                text: "Não será possível reverter esta ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                cancelButtonText: `Não`,
                confirmButtonText: 'Sim'
            }).then((result) => {
                if (result.value===true) {
                    $.ajax({
                        //busca eventos
                        url: APP_URL + '/send-news',
                        dataType: 'json',
                        method:'POST',
                        data:{table:table,id:id},
                        success: function (response) {
                            console.log(response)
                            if(response.success == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sucesso!',
                                    text: response.message,
                                })
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro!',
                                    html: response.message,
                                })
                            }
                        },
                        error:function(response){
                            console.log(response)
                        }
                    })
                }
            })
        })
    }


    return{
      init: function(){
        btn_send()
      }
    }
  }()

  jQuery(document).ready(function(){
    App_emails.init();
  })
