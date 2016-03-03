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

function requisicao(tipo){

    if(ajax.readyState == 4){

        if(ajax.status == 200){
            var resposta = ((tipo == 'texto') ? ajax.responseText : ajax.responseXML);

            inclui_html(resposta);
        }
    }
}

function aciona_ajax(tipo, url){

    ajaxRequest();
    ajax.onreadystatechange = function() {
    requisicao(tipo)
    }
    ajax.open('GET', url);
    ajax.send(null);
}