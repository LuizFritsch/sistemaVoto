function getEndereco() {
	// Se o campo CEP n�o estiver vazio

        var cep = $('#txtCEP').val() + $('#txtCEPCod').val();
        
	if(cep!=""){
		//document.getElementById("load").style.display = 'block';
			/* 
					Para conectar no servi�o e executar o json, precisamos usar a fun��o
					getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
					dataTypes n�o possibilitam esta intera��o entre dom�nios diferentes
					Estou chamando a url do servi�o passando o par�metro "formato=javascript" e o CEP digitado no formul�rio
					http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
			*/
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
					// o getScript d� um eval no script, ent�o � s� ler!
					//Se o resultado for igual a 1
					if(resultadoCEP["resultado"] && resultadoCEP["bairro"] != ""){
							// troca o valor dos elementos
							$("#txtEnd").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
							$("#txtBairro").val(unescape(resultadoCEP["bairro"]));
							$("#txtCidade").val(unescape(resultadoCEP["cidade"]));
							$("#cmbUF").val(unescape(resultadoCEP["uf"]));							
							$("#txtNum").focus();
							
					}else{
							alert("Endere�o n�o encontrado. Por favor, verifique o CEP ou digite seu endere�o manualmente.");
							return false;
					}
			});                             
	}    
	
}