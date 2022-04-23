<?php
    require_once("conexao/config.php");
    #iniciar a variavel de sessao
    session_start();
    //logar
    if( isset($_POST['logar']) ){
            $user     = $_POST['email'];
            $password = $_POST['senha'];
        
            $sql = "select idpessoa,email,senha,tipo from PESSOA ";
            $sql .= "where email = '{$user}' and senha = '{$password}'";
            $execute = mysqli_query($conn,$sql);
            if( !$execute ){
                die("Erro no banco de dados" . mysqli_connect_error() );
            }
            //puxar os dados do banco e checar se conferem ou se falta preencher algum campo
            $informacao = mysqli_fetch_assoc($execute);
            if( empty($informacao) ){
                    $msg = "LOgin sem SucesSo";
            }else{
                 #criar uma variavel de sessao
                $_SESSION["user"] = $informacao['idpessoa'];
                
                switch($informacao['tipo']){
                    case 1 :
                        header("Location:ADM/adm.php");
                        break;
                    case 2 :
                        header("Location:pag-03.php");
                        break;
                    case 3 :
                        header("Location:pag-02.php");
                        break;   
                }
            }
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabalho de Conclusão de Curso</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/pag1.css?version=12">
</head>
<body background="imagens/fundo.jpg">
        <div class="container">
            <div id="formulario">
            <form action="" class="form-horizontal form" method="post">
            
            <h2> <img src="imagens/logo2.png" class="img-responsive m"> Pré-Matricula</h2>

                <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input class="form-control" type="text" name="email" placeholder="Nome completo">
                        </div>
                </div>

                <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <input class="form-control" type="password" name="senha" placeholder="Numero de incrição">
                        </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3 baixo">
                        <button  type="submit" class="btn btn-primary btn-sm btn-block" name="logar">Entrar</button>
                    </div>
                </div>
                <?php if( isset($msg) ) { ?>
                    <p style=""><?php echo "<h3 style='color:red;text-align:center'>".$msg."</h3>"; ?></p>
                <?php } ?> 
            </form>
            </div>

        </div>

<!-- java script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>