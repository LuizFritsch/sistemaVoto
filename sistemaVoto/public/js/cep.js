function getEndereco() {
	// Se o campo CEP nï¿½o estiver vazio

        var cep = $('#txtCEP').val() + $('#txtCEPCod').val();
        
	if(cep!=""){
		//document.getElementById("load").style.display = 'block';
			/* 
					Para conectar no serviï¿½o e executar o json, precisamos usar a funï¿½ï¿½o
					getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
					dataTypes nï¿½o possibilitam esta interaï¿½ï¿½o entre domï¿½nios diferentes
					Estou chamando a url do serviï¿½o passando o parï¿½metro "formato=javascript" e o CEP digitado no formulï¿½rio
					http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
			*/
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+cep, function(){
					// o getScript dï¿½ um eval no script, entï¿½o ï¿½ sï¿½ ler!
					//Se o resultado for igual a 1
					if(resultadoCEP["resultado"] && resultadoCEP["bairro"] != ""){
							// troca o valor dos elementos
							$("#txtEnd").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
							$("#txtBairro").val(unescape(resultadoCEP["bairro"]));
							$("#txtCidade").val(unescape(resultadoCEP["cidade"]));
							$("#cmbUF").val(unescape(resultadoCEP["uf"]));							
							$("#txtNum").focus();
							
					}else{
							alert("Endereço não encontrado. Por favor, verifique o CEP ou digite seu endereço manualmente.");
							return false;
					}
			});                             
	}    
	
}