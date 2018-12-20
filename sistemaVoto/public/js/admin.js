$(document).ready(function (){
    inicializarVariavesContador();

   $(document).on('click', 'button', function () {
       inicializarVariavesContador();
   });

   $(document).on('click', 'a', function () {
       inicializarVariavesContador();
   });

   $("a").click(function() {
       inicializarVariavesContador();
   });

    $('.select2').select2({
        language: "pt-BR"
    });

    $("#txtIdPesquisaArvore").autocomplete({
        source: $("#BASE_URL").val() + 'ptl/sistema/pesquisaArvoreAjax',
        minLength: 2,
        select: function(event, ui) {
            $('#txtPesquisaArvore').val(ui.item.value);
            redirecionar($("#BASE_URL").val()+ui.item.id);
        },
        search: function(event, ui) {
            $("#loadingItens").show();
        },
        response: function(event, ui) {
            $("#loadingItens").hide();
        }
    });

    $("#carregando").hide();
    $("#searchRegister").hide();

    $("#botao_pesquisa").click( function (){
        $("#searchRegister").toggle('fast');
    });

    //dialog para validacao de formularios
    $("#dialog_validacao").dialog({
        autoOpen: false,
        width: 420,
        height: 200,
        modal: true,
        buttons: {
            "Ok": function() {
                $(this).dialog("close");
            }
        },
        close: function(event, ui) {
            controlaBotoesUpload();
        }
    });

    //dialog para confirmacao de operacoes
    $('#dialog_confirmacao').dialog({
        autoOpen: false,
        resizable: false,
        height:168,
        width:420,
        modal : true,

    });

    defineMascarasDeCampos();
    //verificaPesquisaAtiva();

    //teste de capsLock em campos de senha
    $(document).find("input[type='password']").each(function() {
        capsAlert($(this));
    });
});

function inicializarVariavesContador(){
    mkTime =  Date.now();
    if (typeof(Storage) !== "undefined") {
        localStorage.setItem("MILISEG_ULTIMA_ATU_SESSAO", mkTime);
        localStorage.setItem("LOGOUT_TODAS_AS_ABAS",0);
    }
}

function defineMascarasDeCampos() {

    //mascara padrao para data com calendario
    $(".campo_data").mask("99/99/9999");

    $(".campo_data").datepicker({
        changeYear: true,
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });

    $(".campo_data").change(function() {
        $(this).datepicker("option", "dateFormat", "dd/mm/yy" );
    });
    $(".campo_data").datepicker();

    //mascara padrao para data e hora
    $(".campo_data_hora").mask("99/99/9999 99:99:99");

    //mascara padrao para hora simples
    $(".campo_hora_simples").mask("99:99");

    //mascara padrao para hora completa
    $(".campo_hora_completa").mask("99:99:99");

    //marcara padrao para valores reais
    $(".campo_decimal").priceFormat({
        prefix: "",
        centsSeparator: ",",
        thousandsSeparator: "."
    });

    //marcara padrao para numeros inteiros
    $(".campo_inteiro").keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    //mascara padrão para campo alfanumérico
    $(".campo_alfanumerico").keyup(function () {
        this.value = this.value.replace(/[^a-z_\-0-9\.]/g, '');
    });

    //mascara padrao para cep
    $(".campo_cep").mask("99999-999");

     //mascara padrao para cpf
    $(".campo_cpf").mask("999.999.999-99");

     //mascara padrao para cnpj
    $(".campo_cnpj").mask("99.99.999/9999-99");
}


/* Cores alternadas - tabelas*/
function overHighLight(entrada){

    $("#linha_"+entrada).addClass('high_lights');
}

function outHighLight(entrada){
    $(entrada).removeClass('high_lights');
}

/* Colore a linha selecionada*/
function colorRowSelected(i){
    //caso exista alguma linha selecionada ele desmarca
    $(actualSelectedLine).removeClass("editing");
    //para deixar a linha selecionada para indicar que esta sendo editada
    actualSelectedLine = "#linha_"+i;
    $(actualSelectedLine).addClass("editing");
}


function abrirPopup(URL, width, height) {
    if (!width)
        var width = 700;
    if (!height)
        var height = 300;

    var left = 99;
    var top = 99;
    window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+
        ', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=yes, fullscreen=no');
}


function fecharPopup() {
    window.close();
    if (window.opener && !window.opener.closed) {
        window.opener.location.href = window.opener.location.toString();
    }
}

function confirmaExclusao(url, nome) {

    $("#dialog_confirmacao").text('Confirma a exclusão ' + nome + ' ?');
    $("#dialog_confirmacao").dialog("open");

    var botoes = [{
               text: "Confirmar",
               class:"button_text",
               click: function() {
                  document.location = url;
                  $(this).dialog("close");
               }
            },
            {
               text: "Cancelar",
               click: function() {
                  $(this).dialog("close");
               }
            }];
    $("#dialog_confirmacao").dialog( "option", "buttons", botoes);
    $("div[role=dialog] button:contains('Cancelar')").css("color", "red");
    $("div[role=dialog] button:contains('Confirmar')").css("color", "green");

}

function confirmaOperacao(url,operacao) {
    $("#dialog_confirmacao").text(operacao);
    $("#dialog_confirmacao").dialog("open");

    var botoes = [{
               text: "Confirmar",
               click: function() {
                  document.location = url;
                  $(this).dialog("close");
               }
            },
            {
               text: "Cancelar",
               click: function() {
                  $(this).dialog("close");
               }
            }];

    $("#dialog_confirmacao").dialog( "option", "buttons", botoes);
    $("div[role=dialog] button:contains('Cancelar')").css("color", "red");
    $("div[role=dialog] button:contains('Confirmar')").css("color", "green");
    $("div[role=dialog_confirmacao] button:contains('Cancelar')").css("color", "green");
}

/**
 * Mostra uma dialog de confirmação e executa uma ação com
 * SendData ao confirmar.
 *
 * @param string idDiv
 * @param string url
 * @param string texto
 * @return void
 **/
function confirmaAcao(idDiv, url, texto) {
    $("#dialog_confirmacao").text(texto);
    $("#dialog_confirmacao").dialog("open");

    var botoes = [{
               text: "Confirmar",
               click: function() {
                  sendData(idDiv, url);
                  $(this).dialog("close");
               }
            },
            {
               text: "Cancelar",
               click: function() {
                  $(this).dialog("close");
               }
            }];

    $("#dialog_confirmacao").dialog( "option", "buttons", botoes);
    $("div[role=dialog] button:contains('Cancelar')").css("color", "red");
    $("div[role=dialog] button:contains('Confirmar')").css("color", "green");
    $("div[role=dialog_confirmacao] button:contains('Cancelar')").css("color", "green");
}


/**
 * Permite a digitacao apenas de numeros inteiros
 */
function somenteNumero(campo) {
    var digits="0123456789";
    var campo_temp;
    for (var i=0;i<campo.value.length;i++) {
        campo_temp=campo.value.substring(i,i+1)
        if (digits.indexOf(campo_temp)==-1){
            campo.value = campo.value.substring(0,i);
        }
    }
}



/**
 * Envia dados ao server por ajax ($_POST e $_FILES) utilizando
 * o plugin jquery.upload
 *
 * idDiv  - elemento com os dados a serem enviados ao server (container)
 * action - modulo/controller/metodo/
 */
function sendData(idDiv, action) {
    inicializarVariavesContador();
    desabilitaBotoesDivEnvio(idDiv);
    $('#dialog_validacao').html("Aguarde...");
    $('#dialog_validacao').dialog("open");

    $('#dialog_validacao').parent().removeClass("ui-state-error");

    var actionLogado = $("#BASE_URL").val() + "ptl/sistema/isLogado";
    $.post(actionLogado, function(data) {
        if(data == '0'){
            $("#dialog_validacao").dialog(
            {
                width: 470,
                height: 230,
                text: "Ok",
                click: function() {
                    redirecionar($("#BASE_URL").val());
                }
            });
            $("#dialog_validacao" ).bind("dialogclose", function(event, ui) {
                redirecionar($("#BASE_URL").val());
            });

            $('#dialog_validacao').html(' <span class="message_field">Você não está mais autenticado. Seu tempo de inatividade excedeu o limite permitido.</span>');
            $('#dialog_validacao').parent().addClass("ui-state-error");
            $('#dialog_validacao').dialog("open");

        }else{
            action = $("#BASE_URL").val() + action;

            $("#" + idDiv).upload(action, function(data) {
                mostrarRetorno(data);
                habilitaBotoesDivEnvio(idDiv);
            }, "html");
        }
    });
}

/**
 * Envia dados ao server por ajax ($_POST e $_FILES) utilizando
 * o plugin jquery.upload
 *
 * idDiv  - elemento com os dados a serem enviados ao server (container)
 * action - modulo/controller/metodo/
 */
function sendDataEtapa(idDiv, action, passo) {
    inicializarVariavesContador();
    desabilitaBotoesDivEnvio(idDiv);
    $('#dialog_validacao').html("Aguarde...");
    $('#dialog_validacao').dialog("open");

    $('#dialog_validacao').parent().removeClass("ui-state-error");

    var actionLogado = $("#BASE_URL").val() + "ptl/sistema/isLogado";
    $.post(actionLogado, function(data) {
        if(data == '0'){
            $("#dialog_validacao").dialog(
            {
                width: 470,
                height: 230,
                text: "Ok",
                click: function() {
                    redirecionar($("#BASE_URL").val());
                }
            });
            $("#dialog_validacao" ).bind("dialogclose", function(event, ui) {
                redirecionar($("#BASE_URL").val());
            });

            $('#dialog_validacao').html('<span class="message_field">Você não está mais autenticado. Seu tempo de inatividade excedeu o limite permitido.</span>');
            $('#dialog_validacao').parent().addClass("ui-state-error");
            $('#dialog_validacao').dialog("open");

        }else{
            action = $("#BASE_URL").val() + action;
            var f = $('<input name="etapa" type="hidden" value="' + passo + '" />');
            $("#" + idDiv).append(f);
            $("#" + idDiv).upload(action, function(data) {
                f[0].remove();
                mostrarRetorno(data);
                habilitaBotoesDivEnvio(idDiv);
            }, "html");
        }
    });
}

/**
 * Desabilita os botoes da div que contem os dados enviados
 * ao acionar o sendData, por motivos de seguranca.
 **/
function desabilitaBotoesDivEnvio(idDiv) {
    $('#' + idDiv).find('button').attr("disabled", "disabled");
    //$('#' + idDiv).find('button').attr("style", "background-color: #ddebe3");

}

/**
 * Habilita os botoes da div de dados enviados, apos vir o retorno do servidor.
 */
function habilitaBotoesDivEnvio(idDiv) {
    $('#' + idDiv).find('button').removeAttr("disabled");
    //$('#' + idDiv).find('button').attr("style", "background-color: white");
}


/*
 * Navega por todos botoes de upload verificando se atingiu o limite
 * permitido de arquivos. Caso antingiu, o botao ref. ao campo de upload
 * é desabilitado.
 */
function controlaBotoesUpload() {
     $('.MultiFile-wrap').each(function() {
        var totAllowed = $(this).find('input:file:first').attr('maxlength');
        var totAdd     = $(this).find('.MultiFile-label').size();

        if(totAdd >= totAllowed) {
            $(this).find('input:file:first').MultiFile('disableEmpty');
        }
     });
}


function redirecionar(redirect) {
    $('#carregando_mensagem').html("Carregando");
    $('#carregando').show();
    document.location = redirect;
}


/**
 * Mostra o retorno enviado pelo server
 *
 * html - codigo html enviado pelo servidor
 */
function mostrarRetorno(html) {
    $('#dialog_validacao').parent().removeClass("ui-state-error");
    var ocorrencia   = '';
    var data         = '';

    try {
        //se o server enviou a resposta em json, converte-se html to json
        data       = jQuery.parseJSON(html);
        ocorrencia = data.ocorrencia;

        if(data.autoRedirect == true) {
           $('#dialog_validacao').dialog("close");
           document.location = data.redirect
           return;
        }

        $("#dialog_validacao").dialog({
            width: 420,
            height: 200,
            text: "Ok",
            click: function() {
                redirecionar(data.redirect);
            }
        });
        $("#dialog_validacao" ).bind("dialogclose", function(event, ui) {
            redirecionar(data.redirect);
        });
        redirecionar(data.redirect);

    } catch(e) {
        //se o server enviou a resposta em html, apenas exibe o retorno.
        ocorrencia = html;
        //encontrarCamposDestaque(ocorrencia);
        $("#dialog_validacao").dialog({
            width: 500,
            height: 300
        });

        var operacaoComSucesso = ocorrencia.substr(0, 6);
        if(operacaoComSucesso == '{true}') {
           ocorrencia = ocorrencia.substr(6, ocorrencia.length)
        } else {
            $('#dialog_validacao').parent().addClass("ui-state-error");
        }
    }

    $('#dialog_validacao').html(ocorrencia);
    $('#dialog_validacao').dialog("open");
}


/**
* Funcao para marca todos checkboxes com a classe cb
*/
function setAllChecks(elemento) {
    if (elemento.checked) {
        $('.cb').attr('checked', true);
    } else {
        $('.cb').attr('checked', false);
    }
}


/**
 * Abre uma dialog padrao, para exibicao de mensagem ou de um formulario.
 *
 * acaoView   - acao que carregara a view
 * idDialog   - id da dialog (div)
 * largura    - largura da dialog
 * altura     - altura da dialog
 * titulo     - titulo da dialog
 * acaoSalvar - (parametro opcional) acao que sera executada ao clicar no botao
 * idDiv      - (parametro opcional) div que contera os campos a serem
 *               enviados ao clicar no botao
 */
function abrirDialog(acaoView, idDialog, largura, altura,
                     titulo, acaoSalvar, idDiv) {

    var acaoView = $("#BASE_URL").val() + acaoView;

    $('#' + idDialog).dialog({width: largura, height: altura,
                              title: titulo, modal: true,
                              hide: "fade", show: "drop"});

    $('#' + idDialog).html('Carregando...');
    $('#' + idDialog).dialog('open');

    $.post(acaoView, function (data){

        if(acaoSalvar && idDiv) {
            $('#' + idDialog).dialog({buttons: {
                "Salvar": function() {
                    sendData(idDiv, acaoSalvar);
                },
                "Cancelar": function() {
                    $('#' + idDialog).dialog("close");
                }
            }});
        } else {
            $('#' + idDialog).dialog({buttons: {
                "Fechar": function() {
                    $('#' + idDialog).dialog("close");
                }
             }});
        }

        //Estilizar cores
        $("div[role=dialog] button:contains('Salvar')").css("color", "green");
        $("div[role=dialog] button:contains('Cancelar')").css("color", "red");

        $('#' + idDialog).html(data);
        defineMascarasDeCampos();

    });
}

/**
 * Conta quantos caracteres possui o campo
 */
function contaCaracteres(campo, limite, mostraContador) {
    var tamanho = campo.value.length;
    if(tamanho > limite)
        campo.value = campo.value.substring(0, limite);
    else{
        $("#txtLabelContador").html('Caractere(s) restante(s): ');
        $("#txtContador").html(limite - tamanho);
        $("#txtContadorValue").val(limite - tamanho);
    }

    if(mostraContador)
        $(campo).siblings('span:last').html('Catactere(s) restante(s): <b>' + tamanho + '</b>/' + limite + '.');
}

function limparArvorePesquisa() {
    document.getElementById('txtIdPesquisaArvore').value = '';
}
function limparInput(input,type) {
    input.value = '';
    input.setAttribute("type", type);
}

/**
 * Alerta se o usuário pressionar Caps Lock no campo
 * @param {type} campo
 * @returns {undefined}
 */
function capsAlert(campo) {
    $(campo).keypress(function(e) {
        var is_shift_pressed = false;
        if (e.shiftKey) {
            is_shift_pressed = e.shiftKey;
        }
        else if (e.modifiers) {
            is_shift_pressed = !!(e.modifiers & 4);
        }
        if (((e.which >= 65 && e.which <= 90) && !is_shift_pressed) || ((e.which >= 97 && e.which <= 122) && is_shift_pressed)) {
            avisaCaps(campo);
        }
        else {
            escondeCaps(campo);
        }
    });

    // Se o campo nao contiver valor na saida esconde o aviso
    $(campo).blur(function(e) {
        var valor = $(campo).val();
        if (valor=='')
            escondeCaps(campo);
    });
}

/**
 * Exibe aviso de caps lock
 * @param {type} campo
 * @returns {Boolean}
 */
function avisaCaps(campo) {
    var msg = "<br/>A tecla Caps Lock está ligada.";
    var idSpan = "aviso_"+campo.attr('id');

    //remove para impedir elemento duplicado
    escondeCaps(campo);

    //cria um novo elemento
    var avisoCampo = $('<span />')
            .addClass('aviso')
            .html(msg)
            .attr('id',idSpan)
            .attr('name', idSpan);

    //insere o elemento após o campo (com quebra de linha)
    $(avisoCampo).insertAfter(campo);
    return true;

}

/**
 * Esconde o aviso para o campo
 * @param {type} campo
 * @returns {Boolean}
 */
function escondeCaps(campo) {
    var idSpan = "aviso_"+campo.attr('id');

    // remove o elemento
    $("#"+idSpan).remove();
    return true;
}

/*
 * Torna read-only todos componentes de uma div:
 * inputs (text, checkbox, radio), selects e textareas
 */
function divReadOnly(idDiv) {

    //input date como text
    $("#" + idDiv + " input.campo_data").each(function(){
        var v  = $(this).val();
        var n  = $(this).attr('name');
        var id = $(this).attr('id');
        var s  = $(this).attr('size');
        $(this).replaceWith('<input id="'+id+'" size="'+s+'" type="text" value="'+v+'" name="'+n+'" />');
    });

    //input text e input checkbox como read-only
    $("#" + idDiv + " input").attr('readonly', 'readonly');
    $("#" + idDiv + " input").attr('class', 'disabled_input');
    $("#" + idDiv + " input").click(function() {
        return false;
    });

    //input radio como read-only
    $('#' + idDiv + ' input[type = "radio"]').change(function () {
        this.checked = false;
    });

    //textarea como read-only
    $("#" + idDiv + " textarea").attr('readonly', 'readonly');
    $("#" + idDiv + " textarea").attr('class', 'disabled_input');

    //select como read-only
    $("#" + idDiv + " select").each(function(){
        var val   = $(this).val();
        var id    = $(this).attr('id');
        var width = $(this).css('width');
        var name  = $(this).children('[selected=selected]').text().replace(/[\ \n\r\t]{2,}/g, '');
        if($(this).val() === '')
            name = 'Não Informado(a)';
        $(this).replaceWith(
            '<input id="' + id + '" name="' + id + '" type="hidden" value="' + val + '" />' +
            '<input style="width: ' + width + ';" type="text" value="' + name + '" class="disabled_input" disabled="disabled" />');
    });

    //ocultando links
    $("#" + idDiv + " a").attr('class', 'hidden');
}

/**
 * Valida todos campos de data presentes na div informada
 *
 * @param   string idDiv
 * @returns boolean
 */
function validarDataPesquisa(idDiv) {
    var valorAtual  = '';
    var dataComErro = '';

    $('#' + idDiv  + ' .campo_data').each(function(index) {
        valorAtual = this.value;
        if( (valorAtual != '') && (validarData(valorAtual) == false)) {
            dataComErro = valorAtual;
            return false;
        }
    });

    if(dataComErro != '') {
        $('#dialog_validacao').parent().addClass("ui-state-error");
        $('#dialog_validacao').html("Data Inválida: " + valorAtual);
        $('#dialog_validacao').dialog("open");
        return false;
    } else {
        return true;
    }
}

/**
 * Funcao generica para validacao de data. Entrada em formato brasileiro
 * dd/mm/aaaa
 *
 * @param   string data - dd/mm/aaaa
 * @returns boolean
 */
function validarData(data) {
    data = data.replace(/[^0-9\/]/g, "");
    var partes = data.split("/");

    if (partes.length != 3)
        return false;

    var dia = partes[0];
    var mes = partes[1];
    var ano = partes[2];

    if (isNaN(dia) || isNaN(mes) || isNaN(ano))
        return false;

    if (mes > 12 || mes < 1 || ano < 1 || dia < 1)
        return false;

    if (mes == 2) {
        maiorDia = (((!(ano % 4)) && (ano % 100)) || (!(ano % 400))) ? 29 : 28;
        if (dia > maiorDia)
            return false;
    } else {
        if (mes == 4 || mes == 6 || mes == 9 || mes == 11) {
            if (dia > 30)
                return false;
        } else {
            if (dia > 31)
                return false;
        }
    }
    return true;
}

/**
 * Verifica se existe pesquisa padrao
 * ativa na tela atual
 */
function verificaPesquisaAtiva() {
    var pesq = $("#pesquisaAtiva").val();

    if ((pesq!="") && (pesq != undefined))
        $('#botao_pesquisa').click();

}

/**
 * Encontrar campos de destaque para preenchimento obrigatório
 *
 * Localiza os campos usando a classe especificada
 * pelo nome do campo na validação e muda a cor de
 * fundo para destacar
 *
 * @param {type} texto
 * @returns {undefined}
 */
function encontrarCamposDestaque(texto) {
    if (texto.match(/<(\w+)((?:\s+\w+(?:\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|[^>\s]+))?)*)\s*(\/?)>/)) {
        var classeCampo = '.message_field';
        var elementos   = $(texto);
        var lista       = $(classeCampo, elementos);

        //Remove bordas previamente preenchidas antes de validar
        $("[class='errorClass']").removeClass('errorClass');
        $("[class='textRed']").removeClass('textRed');

        $(lista).each(function(){
            textoCampo = $(this).text();
            var elemento = $("label:contains('"+textoCampo+"')" );
            var nomeCampo = elemento.attr('for');
            elemento.addClass("textRed");
            $("#"+nomeCampo).parent().wrap("<div class='errorClass'></div>");
        });
    }
}


/**
 * Abre um novo dialog para que executa a função em parâmetro no caso de confirmação.
 * @param  String acao     chama o conteúdo do dialog
 * @param  String idDialog id da div onde o modal será inserido
 * @param  Integer largura
 * @param  Integer altura
 * @param  String titulo
 * @param  Function func   função a ser executada em caso de confirmação
 * @return Null
 */
function abrirDialogCustom(acao, idDialog, largura, altura, titulo, func){
    var acao = $("#BASE_URL").val() + acao;
    $('#' + idDialog).dialog({width: largura, height: altura,
                              title: titulo, modal: true,
                              hide: "fade", show: "drop"});
    $('#' + idDialog).html('Carregando...');
    $('#' + idDialog).dialog('open');
    $.post(acao, function(data){
        $('#' + idDialog).dialog({buttons: {
            'Selecionar': function() {
                func();
                $('#' + idDialog).dialog("close");
            },
            "Cancelar": function() {
                $('#' + idDialog).dialog("close");
            }
        }});
        //Estilizar cores
        $("div[role=dialog] button:contains('Confirmar')").css("color", "green");
        $("div[role=dialog] button:contains('Cancelar')").css("color", "red");
        $('#' + idDialog).html(data);
    });
}

/**
 * Select remoto
 * @param String idSelect           - ID do select
 * @param String URL                - URL da função de pesquisa
 * @param String placeholder        - Mensagem de instrução para pesquisa
 * @param String minimumInputLength - Quantidade mínima de caracteres para pesquisar
 * @param function callback         - Função para ser executada "onchange".
 *                                    O retorno do callback será enviado como parâmetro ao servidor.
  */
function selectRemote(idSelect, URL, placeHolder, minimumInputLength, callback) {

    $("#"+idSelect).select2({
        placeholder: placeHolder,
        minimumInputLength: minimumInputLength,
        language: "pt-BR",
        dropdownAutoWidth : true,
        width: 'auto',
        ajax: {
            url: URL,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                    return {
                        pesquisa: params.term,
                        parametros: !callback ? false : callback()
                    };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function(obj) {
                        return { id: obj.id, text: obj.descricao };
                    })
                };
            },
        },
        cache: true
    });
}

/**
 * Select remoto com entrada e saída de objetos JSON.
 * @param mixed  element          - HTMLElement ou Seletor CSS do select.
 * @param string acao             - URL da função de pesquisa.
 * @param string placeholder      - Mensagem de instrução para pesquisa.
 * @param integer min             - Quantidade mínima de caracteres antes de pesquisar.
 * @param mixed inputData         - Objeto contendo dados a serem enviador para o servidor.
 *                                  Pode ser uma função cujo objeto retornado será enviado.
 * @param function outputCallback - Uma função para ser executada ao se selecionar um item.
 **/
function selectRemoteExtra(element, acao, placeHolder, min, inputData, outputCallback){
    $(element).select2({
        placeholder: placeHolder,
        minimumInputLength: min,
        language: "pt-BR",
        dropdownAutoWidth : true,
        width: 'auto',
        cache: true,
        ajax: {
            url: $('#BASE_URL').val() + acao,
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function(params){
                var d = {};
                if(typeof inputData == 'function')
                    d = inputData(params.term);
                else if(!inputData)
                    d = {};
                else
                    d = inputData;
                d.pesquisa = params.term;
                return d;
            },
            processResults: function(data){
                return {
                    results: $.map(data, function(obj){
                        return { id: obj.id, text: obj.descricao, outputData: obj };
                    })
                };
            }
        }
    });
    $(element).on("select2:select", function(e){ outputCallback(e.params.data.outputData); });
}

/**
 * Abre uma dialog de confirmação com os botões Sim e Não. Executa a função correspondente
 * ao botão clicado pelo usuário.
 *
 * @param String idDialog
 * @param String texto
 * @param Function funcTrue
 * @param Function funcFalse
 * @return void
 */
function abrirDialogCondicional(idDialog, texto, funcTrue, funcFalse){
    if(idDialog == false)
        idDialog = 'dialog_confirmacao';
    $('#' + idDialog).html(texto);
    $('#' + idDialog).dialog("open");
    var botoes = [
        { text: "Sim", click: function(){
            funcTrue();
            $('#' + idDialog).dialog("close");
        }},
        { text: "Não", click: function(){
            funcFalse();
            $('#' + idDialog).dialog("close");
        }}
    ];
    $('#' + idDialog).dialog("option", "buttons", botoes);
    $("div[role=dialog] button:contains('Sim')").css("color", "green");
    $("div[role=dialog] button:contains('Não')").css("color", "red");
}

function fomatarMilisegundosEmHoras(miliSegundos){
    segundos = parseInt(miliSegundos / 1000);
    var horas = 0;
    if(segundos >= 3600) {
        horas = parseInt(segundos / 3600);
        segundos = segundos - (horas * 3600);
        if (horas < 10) {
            horas = "0" + horas;
            horas = horas.substr(0, 2);
        }
    }
    var min    = parseInt(segundos / 60);
    // Calcula os segundos restantes
    var seg = segundos % 60;
    // Formata o número menor que dez, ex: 08, 07, ...
    if (min < 10) {
        min = "0" + min;
        min = min.substr(0, 2);
    }
    if (seg <= 9) {
        seg = "0" + seg;
    }
    if(horas > 0)
        return horas+':' + min + ':' + seg;
    else
        return min + ':' + seg;
}

function contadorSessao(){

    var segAberturaDialog = 60;
    if($("#TEMPO_SESSAO_TOTAL").val() == segAberturaDialog ) {
        segAberturaDialog = segAberturaDialog - 10;
    }
    if (typeof(Storage) !== "undefined") {
        frequencia = 500;
        msTimeStampAgora = Date.now();
        msTimeStampUltAtuSessao = localStorage.getItem("MILISEG_ULTIMA_ATU_SESSAO");
        msTotalSessao = $("#TEMPO_SESSAO_TOTAL").val() * 1000;
        msSessaoCorridos    = msTotalSessao - ( msTimeStampAgora  - msTimeStampUltAtuSessao);

        continuarLogado = localStorage.getItem("LOGOUT_TODAS_AS_ABAS");
        tempoAbrirDialog = parseInt(msSessaoCorridos / 1000);
        if( msSessaoCorridos >= 1 && continuarLogado != 1){
            if(tempoAbrirDialog == segAberturaDialog ){
                abrirDialogSessao();
            }
            if(tempoAbrirDialog ) {
                $("#div_tempo_sessao_dialog").html(fomatarMilisegundosEmHoras(msSessaoCorridos));
            }
            $("#div_tempo_sessao").html(fomatarMilisegundosEmHoras(msSessaoCorridos));
            $("#div_tempo_sessao").attr("title","Tempo restante de sessão.");
             setTimeout('contadorSessao()', frequencia);
        } else {
            redirecionar($("#BASE_URL").val() + "ptl/sistema/logout");
        }
   }
}


function logout(){
    if (typeof(Storage) !== "undefined") {
        localStorage.setItem("LOGOUT_TODAS_AS_ABAS",1);
    }
    redirecionar($("#BASE_URL").val() + "ptl/sistema/logout");
}

function confirmaAvaliacao(avalNova){
    var largura  = 500;
    var altura   = 320;
    var titulo   = "Enviar Avaliação";
    var idDialog = "dialog_avaliacao";
    var form     = $('input[name="hdnAvalOrigem"]').val();

    $('input:radio[name="rating2"]').filter('[value='+avalNova+']').attr('checked', true);
    $('#' + idDialog).dialog({width: largura, height: altura,
                              title: titulo, modal: true,
                              hide: "fade", show: "drop"});
    $('#' + idDialog).dialog('open');
    $('#' + idDialog).dialog({buttons: {
        "Enviar": function() {
            var retornarPara = window.location.href;
            retornarPara = retornarPara.split("#")[0];
            var novoAval = $('input[name="rating2"]:checked').val();
            var comentario = $('[name="comentarioDialog"]').val();
            $('input[name="retornarPara"]').val(retornarPara);
            $('input[name="rating"]').filter('[value='+novoAval+']').attr('checked', true);
            $('input[name="comentario"]').val(comentario);
            $('#' + idDialog).dialog("close");
            sendData("frm"+form, 'ptl/avaliacao/avaliar/');
        },
        "Cancelar": function() {
            var oldAval = $('input[name="hdnAval"]').val();
            if (oldAval == 0 )
                $('input[name="rating"]').attr('checked', false);
            else
                $('input[name="rating"]').filter('[value='+oldAval+']').attr('checked', true);
            $('#' + idDialog).dialog("close");
        }
    }});
    //Estilizar cores
    $("div[role=dialog] button:contains('Enviar')").css("color", "green");
    $("div[role=dialog] button:contains('Cancelar')").css("color", "red");
}

function excluirAvaliacao(item, origem){
    var retornarPara = window.location.href;
    $('input[name="retornarPara"]').val(retornarPara);

    $("#dialog_confirmacao").text('Confirma a exclusão da avaliação?');
    $("#dialog_confirmacao").dialog("open");

    var botoes = [{
                    text: "Confirmar",
                    class:"button_text",
                    click: function() {
                         sendData("frmExcluir", 'ptl/avaliacao/excluirAvaliacao/');
                         $(this).dialog("close");
                    }
                  },
                    {
                       text: "Cancelar",
                       click: function() {
                          $(this).dialog("close");
                       }
                    }];
    $("#dialog_confirmacao").dialog( "option", "buttons", botoes);
    $("div[role=dialog] button:contains('Cancelar')").css("color", "red");
    $("div[role=dialog] button:contains('Confirmar')").css("color", "green");

}

/**
 * Abre um novo dialog para que executa a função em parâmetro no caso de confirmação.
 * @param  String idDialog id da div onde o modal será inserido
 * @param  String titulo
 * @param  String texto
 * @param  Function funcRecusa função a ser executada em caso de recusa.
 * @param  Function funcAceita função a ser executada em caso de aceite.
 * @return Null
 */
function abrirDialogTermos(idDialog, titulo, texto, funcRecusa, funcAceita = false){

    funcAceita = funcAceita || function(){};

    $('#' + idDialog).dialog({
        modal: true, show: 'drop', hide: 'fade',
        closeOnEscape: false, title: titulo,
        open: function(event, ui){
            $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
        },
        buttons: {
            'Aceitar': function(){
                funcAceita();
                $('#' + idDialog).dialog("close");
            },
            "Recusar": function(){
                funcRecusa();
                $('#' + idDialog).dialog("close");
            }
        }
    });

    $('#' + idDialog).html(texto);
    $("div[role=dialog] button:contains('Aceitar')").css("color", "green");
    $("div[role=dialog] button:contains('Recusar')").css("color", "red");
    $('#' + idDialog).dialog('open');
}

/**
 * Abre uma nova dialog para mostragem de texto.
 * @param  String idDialog id da div onde o modal será inserido
 * @param  String titulo
 * @param  String texto
 * @return Null
 */
function abrirDialogSimples(idDialog, titulo, texto, largura, altura){
    $('#' + idDialog).dialog({
        modal: true, show: 'drop', hide: 'fade', width: largura,
        height: altura, closeOnEscape: false, title: titulo
    });
    if(texto)
        $('#' + idDialog).html(texto);
    $('#' + idDialog).dialog('open');
}
