/**
 * Dicionario de palavras para internacionaliza��o
 * 
 * @author Rogerio Campodonico Bene <rogeriobene@unipampa.edu.br>
 * @copyright NTIC Unipampa 2017
 *
 */

var idioma;

$(document).ready(function () {
    
    //Identifica linguagem do navegador
    idioma = $("#USER_LANG").val().split("-");
    idioma = idioma[0];
    
    //alert(idioma);

    if(idioma === ""){ 
        // caso nao esteja setado pelo usuario pega do navegador
        idioma = navigator.language || navigator.userLanguage;
        idioma = idioma.split("-");
        idioma = idioma[0];
    }
        
    //Carrega dicion�rio    
    if(idioma === 'es')
        $.i18n.load(es);
    
    //Copia valor para tag i18n
    $('[i18n]').each(function (index) {
        var texto;
        texto = $(this).text();
        $(this).attr('i18n',texto);
    });

    //Realiza tradu��o
    realizaMultiTraducao();

});

/**
 * Realiza a troca de idioma
 * @param string idioma
 */
function trocaIdioma(novoIdioma){
    
    // descarrega dicionario
    $.i18n.unload();

    //Carrega dicion�rio
    if(novoIdioma === "es")
        $.i18n.load(es);
    
    idioma = novoIdioma;
    
    //Realiza tradu��o
    realizaMultiTraducao();
    
    //seta idioma na session
    setaIdiomaSession(idioma);
}

/**
 * Realiza tradu��o dos elementos da pagina
 * @returns {undefined}
 */
function realizaMultiTraducao() {

    $('[i18n]').each(function (index) {
        var asterisco = false;
        var doisPontos = false;
        var texto;

        if (idioma === 'pt') {
            texto = $(this).attr('i18n');
            $(this).text(texto);

        } else {
            texto = $(this).attr('i18n');
            texto = texto.trim();

            //Verifica existencia de asterisco
            if (texto.charAt(0) === "*") {
                asterisco = true;
                texto = texto.substring(1, texto.length);
            }
            //Verifica existencia de dois pontos
            if (texto.charAt(texto.length - 1) == ":") {
                doisPontos = true;
                texto = texto.substring(0, texto.length - 1);
            }

            //Realiza tradu��o
            texto = $.i18n._(texto.trim());

            //Concatena caracteres adicionais
            if (asterisco) {
                texto = "*" + texto;
            }
            if (doisPontos) {
                texto += ":";
            }

            //Atribui tradu��o
            $(this).text(texto);
        }
    });
}

/**
 * Realiza tradu��o de um unico elemento da pagina
 * @returns {undefined}
 */
function realizaTraducao(campo) {
    
    $(campo + " [i18n]").each(function (index) {

        var asterisco = false;
        var doisPontos = false;
        var texto;

        if (idioma === 'pt') {
            texto = $(this).attr('i18n');
            $(this).text(texto);

        } else {
            texto = $(this).attr('i18n');
            texto = texto.trim();

            //Verifica existencia de asterisco
            if (texto.charAt(0) === "*") {
                asterisco = true;
                texto = texto.substring(1, texto.length);
            }
            //Verifica existencia de dois pontos
            if (texto.charAt(texto.length - 1) == ":") {
                doisPontos = true;
                texto = texto.substring(0, texto.length - 1);
            }

            //Realiza tradu��o
            texto = $.i18n._(texto.trim());

            //Concatena caracteres adicionais
            if (asterisco) {
                texto = "*" + texto;
            }
            if (doisPontos) {
                texto += ":";
            }

            //Atribui tradu��o
            $(this).text(texto);
        }
    });
}

/**
 * Function para setar idioma na sess�o.
 * @param {type} idioma
 * @returns {undefined}
 */
function setaIdiomaSession(idioma){
    var URL = $("#BASE_URL").val();

    console.log(idioma);

    $.post(URL+'ptl/sistema/setaIdiomaSessionAjax/', {idioma: idioma});
}