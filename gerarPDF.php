<?php
        require_once("conexao/config.php");
     
        session_start();
        //teste de segurançã
        if( !isset($_SESSION["user"])){
            header("Location:pag-01.php");
        }else{
            $idpessoa = $_SESSION['user'];
        }
        //verfica codigo da url do aluno
        if( isset($_GET['DOC'])){
            $id_do_aluno = $_GET['DOC'];
        }

        //query 
        $sql      = "SELECT `iddocumento`, `id_pessoa`, `status`, `rg_frente`, `rg_verso`, `cpf`, `cnh_frente`, `cnh_verso`, "; 
        $sql     .= "`certidao_nascimento`, `certidao_casamento`, `historico_escolar`, `data_envio` FROM `DOCUMENTO` ";
        $sql     .= "WHERE id_pessoa = {$id_do_aluno} ;";
        $consulta = mysqli_query($conn,$sql);
        if(!$consulta){ die("erro no banco".mysqli_error($conn));}
        //dados da tabela documento

        $linha = mysqli_fetch_assoc($consulta);

        //buscar a class
        require_once("fpdf181/fpdf.php");
        //estanciando
        $pdf = new FPDF();
        //inicia o documento PDF com orientação P-retrato(picture) ou L -Paisagem(landscape)
        $pdf->AddPage();
        //nome do arquivo ao ser gerado ou gera o nome do arquivo com o local a ser salvo
        $arquivo = "documentos_pdf.pdf";
        //definindo formatações do PDF
        $tipo_pdf = "D";
        /*
        Gerar como:
        I : Envia o arquivo para o navegador. visualizado de PDF é usado se disponivel
        D : Enviar para o navegador e forçar um download como nome especificado
        F : Salva o arquivo local como o nome dado por nome(pode incluir caminho)
        S : Retorna o documento como string
        DEFAULT : o valor padrão é "I"
        */
        $pdf->Image($linha['rg_frente'] , 15 ,10, 80 , 50, '');
        $pdf->Image($linha['rg_verso'] , 115 ,10, 80 , 50, '');
        $pdf->Image($linha['cpf'] , 60 ,70, 80 , 50, '');
        $pdf->Image($linha['cnh_frente'] , 15 ,130, 80 , 50, '');
        $pdf->Image($linha['cnh_verso'] , 115 ,130, 80 , 50, '');
        //pagina 2
        $pdf->AddPage();
        $pdf->Image($linha['certidao_nascimento'] , 10 ,5, 190 , 285, '');
        //pag 3
        $pdf->AddPage();
        $pdf->Image($linha['certidao_casamento'] , 10 ,5, 190 , 285, '');
        //pag 4
        $pdf->AddPage();
        $pdf->Image($linha['historico_escolar'] , 10 ,5, 190 , 285, '');

        //fechando o arquivo
       $pdf->OutPut($arquivo,$tipo_pdf);
       

?>