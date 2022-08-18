function buscaCep(obj){
    var cep = $(obj).val();
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        limpaFormularioCep('...');
        if (validacep.test(cep)) {
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    $('.city').val(dados.localidade);
                    $('.address').val(dados.logradouro);
                    $('.district').val(dados.bairro);
                    $('.uf').val(dados.uf);
                } else {
                    limpaFormularioCep('');
                    alert("CEP não encontrado.");
                }
            });
        } else {
            limpaFormularioCep();
            alert("Formato de CEP inválido.");
        }
    }
}

// Buscador de CEP
function limpaFormularioCep( value='') {
    $('.city').val(value);
    $('.address').val(value);
    $('.district').val(value);
    $('.uf').val(value);
}