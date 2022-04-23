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
        if( isset($_GET['idaluno'])){
            $id_do_aluno = $_GET['idaluno'];
        }
        //pegar nome da pessoa
        $sqlp     = "select idpessoa,nome from PESSOA where idpessoa = {$id_do_aluno} ";
        $query    = mysqli_query($conn,$sqlp);
        if(!$query){die("erro na consulta".mysqli_error($conn));}
        $nome = mysqli_fetch_assoc($query);
        //query do documento
        $sql      = "SELECT `iddocumento`, `id_pessoa`, `status`, `rg_frente`, `rg_verso`, `cpf`, `cnh_frente`, `cnh_verso`, ";
        $sql     .= "`certidao_nascimento`, `certidao_casamento`, `historico_escolar`, `data_envio` FROM `DOCUMENTO` ";
        $sql     .= "WHERE id_pessoa = {$id_do_aluno} ;";
        $consulta = mysqli_query($conn,$sql);
        if(!$consulta){ die("erro no banco".mysqli_error($conn));}
        //dados da tabela documento
        $linha = mysqli_fetch_assoc($consulta);
        //pegar dados errados e jogar na tela de da pagina 5

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabalho de Conclusão de Curso</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/pag-5.css?version=12">
    <style>
        .a:hover     {text-decoration: none; color: white}
        .a           {color: white}
    </style>
</head>
<body>
    <div class="container-fluid">
        <hr>
        <div class="container">
            <div class="block-inline">
                    <a class="a" href="pag-03.php"><div class="btn btn-primary btn-sm col-sm-2">Home</div></a>
                    <a class="a" href="pdf.php?aluno=<?php echo $nome['idpessoa']?>"><div class="btn btn-primary btn-sm col-sm-2 col-md-offset-3">imprimir </div></a>
                    <a class="a" href="pag-04.php?codigo=<?php echo $_SESSION['curso']?>"><div class="btn btn-warning btn-sm col-sm-2 pull-right"> Voltar</div></a>
            </div>

            <h2>Documentos</h2>
            <p style="text-align:center;font-size:14pt"><?php echo $nome['nome']?></p>

           <a href='pag-06.php?codAluno=<?php echo $id_do_aluno?>'><button class="btn btn-danger btn-sm">
           Dados Errados
           </button></a>

          <div class="document col-sm-12">
            <div class="row">
                <div class="col-md-5 col-sm-10 files">
                 <span>Rg frente</span> 
                 <img src="<?php echo $linha['rg_frente']?>" class="img-responsive">
                </div>
                <div class="col-md-5 col-sm-10 files">
                <span>Rg verso</span>
                 <img src="<?php echo $linha['rg_verso']?>" class="img-responsive">
                </div>
          </div>
          <!-- __________________________________________- -->
          <div class="row">
                <div class="col-md-5 col-sm-10 files">
                <span>CPF</span>
                 <img src="<?php echo $linha['cpf']?>" class="img-responsive">
                </div>
                <div class="col-md-5 col-sm-10 files">
                <span>CNH frente</span>
                 <img src="<?php echo $linha['cnh_frente']?>" class="img-responsive">
                </div>
          </div>
          <!-- __________________________________________- -->
          <div class="row">
                <div class="col-md-5 col-sm-10 files">
                <span>CNH verso</span>
                 <img src="<?php echo $linha['cnh_verso']?>" class="img-responsive">
                </div>
                <div class="col-md-5 col-sm-10 files">
                <span>Certidão de Nascimento</span>
                 <img src="<?php echo $linha['certidao_nascimento']?>" class="img-responsive">
                </div>
          </div>
          <!-- __________________________________________- -->
          <div class="row">
                <div class="col-md-5 col-sm-10 files">
                <span>Certidão de Casamento</span>
                 <img src="<?php echo $linha['certidao_casamento']?>" class="img-responsive">
                </div>
                <div class="col-md-5 col-sm-10 files">
                <span>Histórico Escolar</span>
                 <img src="<?php echo $linha['historico_escolar']?>" class="img-responsive">
                </div>
          </div>
          <!-- __________________________________________- -->
            </form>

        </div>
        <hr>
    </div>    
<!-- java script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>
<?php  mysqli_close($conn);  ?>