//Funções carregam eventos de formulario.
window.onload = function () {

tinyMCE.init(
	{
		selector : '#conteudo',
		language : 'pt_BR',
		theme: 'modern',
                plugins: 'code image textcolor colorpicker link',
                toolbar: ['undo redo | styleselect | bold italic | link image | alignleft aligncenter alignright | code | forecolor backcolor'],
                menubar: false
	}); 

/*função para substituir os botoões de login ou cadastro*/
    if(document.getElementById('cad')){
    document.getElementById('cad').onclick = function () {
        if (document.getElementById('confirmPassword').getAttribute('class') == 'form-control esconde') {
            document.getElementById('form-login').setAttribute('action' , 'autenticacao/cadastro');
            document.getElementById('confirmPassword').setAttribute('class', 'form-control');
            document.getElementById('confirmPassword').setAttribute('required', 'required');
            document.getElementById('inputNome').setAttribute('class', 'form-control');
            document.getElementById('inputNome').setAttribute('required', 'required');
            document.getElementById('tit-login').innerHTML = 'Cadastro';
            this.innerHTML = 'Login';
        }else{
            document.getElementById('confirmPassword').setAttribute('class', 'form-control esconde');
            document.getElementById('confirmPassword').removeAttribute('required');
            document.getElementById('inputNome').setAttribute('class', 'form-control esconde');
            document.getElementById('inputNome').removeAttribute('required');
            document.getElementById('tit-login').innerHTML = 'Login';
            document.getElementById('form-login').setAttribute('action' , 'admin');
            this.innerHTML = 'Cadastrar Usuário';

        }
    }
}

/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
//Função que carrega formulario para inserção de nova categoria.
    document.getElementById('nova_categoria_link').onclick = function(){
        document.getElementById('inclui_nova_categoria').setAttribute('style', ' width: 50%;display: ');

    }

/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
//Função para atribuir evendo ao link de carregamento de midia

document.getElementById('carregar_imagem').onclick = function(){
    if(document.getElementById('biblioteca_img')){
        document.getElementById('biblioteca_img').remove();
    }

    if(document.getElementById('biblioteca_img_colecao')){
        document.getElementById('biblioteca_img_colecao').remove();
    }

    var url = this.getAttribute('data-url');
    lista_midia(url);
}
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/



document.getElementById('imagem').onchange = function(){
     var url = document.getElementById('imagem').getAttribute('data-url');
    load_img(url);

}

/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    //Função que dispara o ajax para .

    document.getElementById('btnIncluiCategoria').onclick = function(){
        var url = document.getElementById('novacategoria').getAttribute('data-url')+'/'+document.getElementById('novacategoria').value
        aciona_ajax('xml', url, null, "select", 'categoria');

    }
}

/* =============================================================================*/

//************************Funções de eventos*****************************

//Função de listagem xml
function inclui_html(resposta, tag, id){
/*alert(resposta)*/
var elementos = resposta.getElementsByTagName(id)[0].childNodes;
var cont = elementos.length;
if(tag == 'select'){

       for(var i = 0; i < cont; i++){
                document.getElementById(id).options[i]  = new Option(elementos[i].getAttribute('tag'), elementos[i].getAttribute('value'));
       }

       document.getElementById('inclui_nova_categoria').setAttribute('style', ' width: 50%;display: none');
       document.getElementById('novacategoria').value = '';
    }

    if(tag == 'img' || tag == 'img_colecao'){

      var id_container = 'biblioteca_'+tag;
      var contentSelecao = (tag == 'img') ? document.getElementById('modal-footer') : document.getElementById('selecao');
      var containerBiblioteca = document.createElement('article');
      containerBiblioteca.setAttribute('id', id_container);

       for(var i = 0; i < cont; i++){
            var src = elementos[i].getAttribute('src');
            var id_imgem = elementos[i].getAttribute('id')
            var figure = document.createElement('figure');
            figure.setAttribute("class", "thumbnail col-md-4");
            var radio = document.createElement('input');
            radio.setAttribute('type', 'radio');
            radio.setAttribute('name', 'selecao_imagem');
            radio.setAttribute('id', id_imgem);
            radio.setAttribute('onclick', 'imagemEnable(this)');
            radio.setAttribute('data-src', src);
            var img = document.createElement('img');
            img.setAttribute('src', src);

            figure.appendChild(radio);
            figure.appendChild(img);
            containerBiblioteca.appendChild(figure);
      }

      var clearfix = document.createElement('span');
      clearfix.setAttribute('class', 'clearfix');
      containerBiblioteca.appendChild(clearfix);
       contentSelecao.appendChild(containerBiblioteca);
    }
}

/*-----------------------------------------------------------------------------------------------------------------------------------------------------------*/
//função de listagem de midias.

function lista_midia(url){
   aciona_ajax('xml', url, null, 'img_colecao', 'media');
}

function load_img(url){
   var data = new FormData();
   data.append("imagem_input", document.getElementById('imagem').files[0]);
   aciona_ajax('xml', url, data, 'img', 'media');

}

function imagemEnable(el){
    id_enable = el.getAttribute('id');
    src_enable = el.getAttribute('data-src');
    document.getElementById('media').value = id_enable;
    if(document.getElementById('imagem_destacada_span')){
    document.getElementById('imagem_destacada_span').remove();
  }
    document.getElementById('imagem_destacada').setAttribute('src', src_enable);
}
