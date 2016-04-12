var ajax;
function ajaxRequest(){
    ajax = null;

    if(window.XMLHttpRequest){

        ajax = new XMLHttpRequest();

    }else if(window.ActiveXObject){

        try{
            ajax = ActiveXObject('Microsoft2.XMLHTTP');
        }
        catch(e){
            ajax = ActiveXObject('Microsoft.XMLHTTP');

        }
    }
}

function requisicao(tipo, tag, id){


    if(ajax.readyState == 4){
        if(ajax.status == 200){

            var resposta = ((tipo == 'texto') ? ajax.responseText : ajax.responseXML);

            inclui_html(resposta, tag, id);
        }
    }
}

function aciona_ajax(tipo, url, metodo, tag, id){
/*alert(tipo + tag + id);*/
    ajaxRequest();
    ajax.onreadystatechange = function() {
    requisicao(tipo, tag, id)
    }
    ajax.open("post", url);
    ajax.send(metodo);
}