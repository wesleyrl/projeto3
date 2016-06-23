
//Cadastra clliente
$(window).load(function() {
    var form = $('form[name="form_pessoa"]');
    var action = 'insert.php';
    var retornoValidation = $('#returnCadastro');
    
    function retorno(retorno){
           bootbox.dialog({
                title: "Aquarde...",
                message: retorno
           });
           retornoValidation.html('<div class="col-lg-5 col-lg-offset-4"><img src="images/loading.gif"> Aquarde.....</div>');
            $(function(){
            window.location.reload(5);
            });
           
     }
      form.submit(function() {  
      $.post(action,$(this).serialize(),retorno);
      
             return false;
        
     
    });
});


