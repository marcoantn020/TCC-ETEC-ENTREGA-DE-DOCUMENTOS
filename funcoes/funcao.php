<?php
//pegar extensao do arquivo
    function pegarExtensao($x){
        return strrchr($x,".");
    }
//gerar codigo unico
    function gerarCodigo(){
        $codigo         = "23456789ABCDEFGHijklmnopqrS0";
        $tamanho        = 30;
        $cod            = "";
        $resultado      = "";
    
        for($i = 0; $i < $tamanho; $i++){
            $cod  = substr($codigo,rand(0,23),1);
            $resultado .= $cod;
        }
    
        date_default_timezone_set('America/Sao_Paulo');//data da região em que estou
        $data = getdate(); //criar objeto data
        $codigo_data  = $data['year']."_".$data['yday'];
        $codigo_data .= $data['hours'].$data['minutes'].$data['seconds'];
    
        return "foto_".$codigo_data."_".$resultado;
    }

//tratamento de erros
    function erros ($numeroDoErro){
        $array_erros = array(
            UPLOAD_ERR_OK => "Sem erro.",
            UPLOAD_ERR_INI_SIZE => "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
            UPLOAD_ERR_FORM_SIZE => "O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML",
            UPLOAD_ERR_PARTIAL => "O upload do arquivo foi feito parcialmente.",
            UPLOAD_ERR_NO_FILE => "Nenhum arquivo foi enviado.",
            UPLOAD_ERR_NO_TMP_DIR => "Pasta temporária ausente.",
            UPLOAD_ERR_CANT_WRITE => "Falha em escrever o arquivo em disco.",
            UPLOAD_ERR_EXTENSION => "Uma extensão do PHP interrompeu o upload do arquivo."
        );
        return $array_erros[$numeroDoErro];
    }

    function salvarImagem($imagem){
                //verificando
                    $arquivo_temporario  = $imagem['tmp_name'];
                    $nome_original       = basename($imagem['name']);
                    $nome_novo           = gerarCodigo() . pegarExtensao($nome_original);
                    $diretorio           = "documentos".DIRECTORY_SEPARATOR.$nome_novo;
    
                //mover arquivos da pasta temporaria
                    if(move_uploaded_file($arquivo_temporario,$diretorio)){
                       return array("Dados cadastrados com sucesso",$diretorio );
                    }else{
                        return array(erros($imagem['error']),"" );  
                    }
                    return $msg;
    }
//função para gerar email
    function enviarEmail($dados){
        //dados do formulario
        $nome_usuario   = $dados['nome'];
        $email_usuario  = $dados['email'];
        $texto_mensagem = $dados['msg'];
        //variaveis de envio
        $destino        = $dados['email'];
        $remetente      = "etec@etec.com.br";
        $assunto        = "Erros no documento!";
        //montar msg
        $mensagem       = "Olá ".$nome_usuario."verificamos uma irregularidade."."<br/>";
        $mensagem      .=  "Atenção no dia da matricula apresentar o documento(s) que apresentaram erro: "."<br/>";
        $mensagem      .= $texto_mensagem ."<br/>";
        $mensagem      .= "Atenciosamente Etec Antônio Devisate.";
        //enviar a mensagem
        return mail($destino,$assunto,$texto_mensagem,$remetente);

    }
?>