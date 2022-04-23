<?php
        require_once("conexao/config.php");
        require_once("funcoes/funcao.php");

        session_start();
        //teste de segurançã
        if( !isset($_SESSION["user"])){
            header("Location:pag-01.php");
        }
        //codigo do documento
        if( isset($_GET['codAluno'])){
            $codAluno = $_GET['codAluno'];
        }
        //query documentos
        $sql      = "select idpessoa,nome,email from PESSOA ";
        $sql     .= "WHERE idpessoa = {$codAluno} ;";
        $doc      = mysqli_query($conn,$sql);
        if(!$doc){ die("Erro no banco".mysqli_error($conn));}
        $dados    = mysqli_fetch_assoc($doc);
        //enviar email
        if(isset($_POST['enviar'])){
             $msg = "<script>alert('E-mail enviado com sucesso.')</script>". 
             "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=pag-04.php'>";       
        }else{
            $msg = "Erro no envio";
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabalho de Conclusão de Curso</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/pag-6.css">
    <style>
        .a:hover     {text-decoration: none; color: white}
        .a           {color: white}
    </style>
</head>
<body>
    <div class="container-fluid">
    <?php include_once("cabecalho.php");?>
        <hr>
        <div class="container">
            <div class="block-inline">
                    <a class="a" href="pag-03.php"><div class="btn btn-primary btn-sm col-sm-2"> Home</div></a>
                    <div class="btn btn-primary btn-sm col-sm-2 col-md-offset-3">hora </div>
                    <a class="a" href="close.php"><div class="btn btn-danger btn-sm col-sm-2 pull-right"> Sair</div></a>
            </div>

            <h3>Erro no documento</h3>

          <div class="document col-sm-12">
            <p class="text-danger text-center">Atenção em caso de erro nos documentos é de suma importância avisar o candidato do curso que deve trazer os documentos em que ocorreu o erro quando vier efetivar a matricula já que só é permitido o envio dos documentos uma única vez.</p>
            <!-- _______________________________________________________________________ -->
            <form action="" method="post" >
                <div class="form-group">
                    <div class="col-md-10 col-sm-10">
                        <textarea name="msg" cols="120" rows="10" class="form-control" placeholder="Descreva o erro encontrado"></textarea>
                    </div>  

                    
                    <div class="row baixo">
                        <div class="col-md-7 col-sm-10 col-md-offset-0">
                                <label class="padding">Enviar</label>
                        </div>
                    </div>

                    <div class="row baixo">
                        <div class="col-md-7 col-sm-10 col-md-offset-0">
                           <input type="text" name="nome" class="form-control" value=<?php echo $dados['nome']?> readonly="true"><br/>
                            <input type="email" name="email" class="form-control" value=<?php echo $dados['email']?> readonly="true" >
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary pull-right" type="submit" name="enviar">Enviar</button>
                <?php echo $msg; ?>
            </form>
            
        </div>
        <hr/>
    </div>    
<!-- java script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>
<?php 
    mysqli_close($conn);
?>