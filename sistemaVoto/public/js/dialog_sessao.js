$(document).ready(function() {
    $("#dialog_sessao").dialog({
        autoOpen: false,
        resizable: false,
        height: 200,
        width: 420,
        modal: false
    });
});

function renovarSessao(){    
    localStorage.setItem("FECHAR_DIALOGS_RENOV_SESSAO",1);
    var url = $("#BASE_URL").val() + 'ptl/sistema/principal';    
    redirecionar(url);    
}
    
function abrirDialogSessao() {
    $("#dialog_sessao").dialog("open");
    $("#dialog_sessao").dialog("option");
    var botao = [{
            text: "Renovar Sessão",
            click: function() {
                renovarSessao();                
            }
        }];
    $("#dialog_sessao").dialog("option", "buttons", botao);
}