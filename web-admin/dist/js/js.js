//Funções carregam eventos de formulario.
window.onload = function () {
/*função para substituir os botoões de login ou cadastro*/
    if(document.getElementById('cad')){
    document.getElementById('cad').onclick = function () {
        if (document.getElementById('confirmPassword').getAttribute('class') == 'form-control esconde') {
            document.getElementById('confirmPassword').setAttribute('class', 'form-control');
            document.getElementById('confirmPassword').setAttribute('required', 'required');
            document.getElementById('tit-login').innerHTML = 'Cadastro';
            document.getElementById('form-login').setAttribute('action' , 'autenticacao/cadastro');

            this.innerHTML = 'Login';
        }else{
            document.getElementById('confirmPassword').setAttribute('class', 'form-control esconde');
            document.getElementById('confirmPassword').removeAttribute('required');
            document.getElementById('tit-login').innerHTML = 'Login';
            document.getElementById('form-login').setAttribute('action' , 'admin');
            this.innerHTML = 'Cadastrar Usuário';

        }
    }
}
//Função que carrega formulario para inserção de nova categoria.
    document.getElementById('nova_categoria_link').onclick = function(){
        document.getElementById('inclui_nova_categoria').setAttribute('style', ' width: 50%;display: ');

    }

    //Função que dispara o ajax para .

    document.getElementById('btnIncluiCategoria').onclick = function(){
        var url = document.getElementById('novacategoria').getAttribute('data-url')+'/'+document.getElementById('novacategoria').value
        aciona_ajax('xml', url);

    }
}
//form-control esconde

function inclui_html(resposta){

    var elementos = resposta.getElementsByTagName('categoria')[0].childNodes;
    var cont = elementos.length;

   for(var i = 0; i < cont; i++){
            document.getElementById('categoria').options[i]  = new Option(elementos[i].getAttribute('tag'), elementos[i].getAttribute('value'));
   }
   document.getElementById('inclui_nova_categoria').setAttribute('style', ' width: 50%;display: none');
   document.getElementById('novacategoria').value = '';
}
