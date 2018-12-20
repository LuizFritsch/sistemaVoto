$(document).ready(function(){        
  
  
  // Configuracao do zoom
  escalaZoom       = 0.05;
  var zoomCorrente = leZoom(); //le o zoom corrente do cookie
  setaZoom(zoomCorrente);  //seta o zoom da pagina na carga para o corrente
  
  // Configuracao do Contraste
  var contrasteAtual = leContraste();
  setaContraste(contrasteAtual);
  
  // Funcao para zerar o zoom  (jquery)
    $(".resetFont").click(function(){
        $('body').css('zoom','normal');        
        $('body').css('-moz-transform', 'none'); 
        $('body').css('-moz-transform-origin', '0 0');
        gravaZoom('1.0');
        return false;
    });
    
  // Funcao para aumentar o zoom (jquery)
    $(".increaseFont").click(function(){
        var currentZoom = leZoom(); //carrega zoom atual do cookie
        var currentZoomNum = parseFloat(currentZoom,10);
        var newZoom = currentZoomNum * (1 + escalaZoom);                               
       
        $('body').css('zoom',newZoom);
        $('body').css('-moz-transform', 'scale('+newZoom+')');
        $('body').css('-moz-transform-origin', '0 0');
        
        gravaZoom(newZoom); //grava o zoom novo no cookie
        return false;
    });
    
    // Funcao para diminuir o zoom (jquery)
    $(".decreaseFont").click(function(){
        var currentZoom = leZoom();
        var currentZoomNum = parseFloat(currentZoom, 10);
        var newZoom = currentZoomNum * (1 - escalaZoom);            
        
        $('body').css('zoom',newZoom);        
        $('body').css('-moz-transform', 'scale('+newZoom+')');
        $('body').css('-moz-transform-origin:', '0 0');
        
        gravaZoom(newZoom);
        return false;
    });    
    
    // Funcao para alternar o contraste
    $(".setContrast").click(function(){        
       var vlrContraste = leContraste();
       if (vlrContraste == 1) {
           vlrContraste = 0;          
       } else {
           vlrContraste = 1;           
       }       
       setaContraste(vlrContraste);
       location.reload(); //recarrega imagens
       return false;
           
    });
});

/**
 * Funcao para gravar o zoom em cookie do navegador
 * Recebe o parametro zoomLevel, grava no cookie e
 * retorna sempre true
 * 
 */
function gravaZoom(zoomLevel) {
    $.cookie("erp.zoomlevel", zoomLevel, { path: '/' });        
    return false;
}

/**
 * Funcao para ler o zoom de cookie do navegador
 * procura pelo parametro erp.zoomlevel e retorna 
 * seu valor
 */

function leZoom(){
    var nomeZoom = 'erp.zoomlevel';
    if ($.cookie(nomeZoom))
        return $.cookie(nomeZoom)
    else 
        return 1;    
}

/**
 * Funcao para setar o zoom para o valor especificado na carga 
 * da proxima requisicao de pagina
 */

function setaZoom(zoom) {
    
    if (zoom == null) 
        zoom='1.0';
    
    $('body').css('zoom',zoom);
    
    if ((zoom == 'normal') || (zoom == null)) {        
        $('body').css('-moz-transform','none');
        $('body').css('-moz-transform-origin', '0 0');
    } else { 
        $('body').css('-moz-transform', 'scale('+zoom+')');        
        $('body').css('-moz-transform-origin', '0 0');
    }
    return false;
}

/**
 * Funcao para ler o cookie de contraste
 */
function leContraste() {
    var nomeContraste = 'erp.contrast';
    if ($.cookie(nomeContraste))
        return $.cookie(nomeContraste)
    else 
        return 0;
}

/**
 * Funcao para gravar o cookie de contraste
 */

function setaContraste(contraste){
    $.cookie("erp.contrast", contraste, { path: '/' });  
    return false;    
}