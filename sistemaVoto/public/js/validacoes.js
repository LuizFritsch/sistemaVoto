/**
 * Neste arquivo podem ser incluidas funcoes de validacao gerais, como:
 * e-mail, cnpj, cpf, cep, entre outras.
 */


/**
 * Verifica se o email passado È valido - passar o campo.
 **/
function validaEmail(campo_email) {
    //Checando se o endere√ßo e-mail n√£o esta vazio
    if(campo_email=="") {
        return false;
    }
    //Checando se o endere√ßo de e-mail √© v√°lido
    if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(campo_email.value))) {
        return false;
    }
    return true;
}


/**
 * Verifica se o cnpj passado È valido
 */
function validaCNPJ(valor) {
    if (valor == '') {
        return false;
    }

    CNPJ = valor;
    erro = new String;
    if (CNPJ == "00.000.000/0000-00") {
        return false;
    }

    var nonNumbers = /\D/;
    if (nonNumbers.test(CNPJ))
        erro += "A verificacao de CNPJ suporta apenas numeros! \n\n";

    var a = [];

    var b = new Number;
    var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
    for (i=0; i<12; i++) {
        a[i] = CNPJ.charAt(i);
        b += a[i] * c[i+1];
    }

    if ((x = b % 11) < 2) {
        a[12] = 0
    } else {
        a[12] = 11-x
    }

    b = 0;
    for (y=0; y<13; y++) {
        b += (a[y] * c[y]);
    }

    if ((x = b % 11) < 2) {
        a[13] = 0;
    } else {
        a[13] = 11-x;
    }

    if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])) {
        erro +="CNPJ Inv·lido";
    }

    if (erro.length > 0) {
        return false;
    }

    return true;
}