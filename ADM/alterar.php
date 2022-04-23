<?php
 require_once("../conexao/config.php");

    session_start();
      //teste de segurançã
      if( !isset($_SESSION["user"])){
          header("Location:../pag-01.php");
      }
      //consulta no banco
      $sql = "select idpessoa,nome,telefone,email,tipo,senha from PESSOA ";
      if( isset($_GET['codigo']) ){
            $id   = $_GET['codigo'];
            $sql .= "Where idpessoa = {$id} ";
      }
      $res = mysqli_query($conn,$sql);
      if( !$res){ 
          die("Erro no banco!");
      }
      //mostrar os dados 
      $dados = mysqli_fetch_assoc($res);
      //alterar os dados
      if( isset($_POST['alterar']) ){
        $id       = $_POST['id'];
        $name     = $_POST['nome'];
        $phone    = $_POST['telefone'];
        $email    = $_POST['email'];
        $type     = $_POST['tipo'];
        $password = $_POST['senha'];

        $alterar  = "update PESSOA set nome='{$name}', telefone='{$phone}', email='{$email}', tipo='{$type}', ";
        $alterar .= "senha='{$password}' where idpessoa={$id} ";
        $modify   = mysqli_query($conn,$alterar);
        if( !$modify){
               die('Mensagem de erro:' .mysqli_error( $conn ));
        }else{
            echo "<script>alert('Dados alterados com sucesso.')</script>". 
            "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=adm.php'>";
        }
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabalho de Conclusão de Curso</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/">
    <style>
        div.container{width: 60%}
        .top {margin-top: 100px}
        span {font-weight: bolder; font-size:15pt}
        .b   {text-decoration: none}
        .a:hover{text-decoration: none; color: white}
        .a {color: white}
    </style>
</head>
<body>
    <div class="container-fluid">

       <?php //require_once("cabecalho.php"); ?> 
        <hr>
        <div class="container">
            
            <div class="block-inline">
                <a class="a" href="adm.php"><div class="btn btn-primary btn-sm col-sm-2"> Home </div></a>
                <div class="btn col-sm-2 col-md-offset-3 b"> <span>Alterar Cadastro</span></div>
                <a class="a" href="sair.php"><div class="btn btn-danger btn-sm col-sm-2 pull-right">Sair</div></a>
            </div>

            <h3 class="text-center top"></h3>

            <form class="form-horizontal" method='post'>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="nome">Nome</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="nome" value="<?php echo $dados['nome']; ?>" name="nome">
                        </div>   
                    </div>
 <!--___________________________________________________________________________________________________________-->                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="Telefone">Telefone</label>
                        <div class="col-sm-10">
                            <input class="form-control"  type="text" id="Telefone" value="<?php echo $dados['telefone']; ?>" name="telefone">
                        </div>    
                    </div>
 <!--___________________________________________________________________________________________________________-->                   
                    <div class="form-group">
                            <label class="col-sm-2 control-label" for="email">E-mail</label>
                            <div class="col-sm-10">
                                <input class="form-control"  type="email" id="email" value="<?php echo $dados['email']; ?>" name="email">
                            </div>    
                        </div>       
<!--___________________________________________________________________________________________________________-->                   
                    <div class="form-group">
                            <label class="col-sm-2 control-label" for="adm">Tipo</label>
                            <div class="col-sm-10">
                                    <div class="form-check col-sm-3">
                                        <input class="form-check-input position-static" type="radio" name="tipo" value="1"> &nbsp;---- ADM ----
                                    </div>
                                    <!--___________________-->
                                     <div class="form-check col-sm-3">
                                        <input class="form-check-input position-static" type="radio" name="tipo" value="2"> &nbsp;---- Usuario ----
                                    </div>     
                                        <!--___________________-->
                                     <div class="form-check col-sm-3">
                                        <input class="form-check-input position-static" type="radio" name="tipo" value="3"> &nbsp;---- Aluno ----
                                    </div>                             
                            </div>    
                        </div> 
<!--___________________________________________________________________________________________________________-->                   
                    <div class="form-group">
                            <label class="col-sm-2 control-label" for="senha">Senha</label>
                            <div class="col-sm-10">
                                <input class="form-control"  type="password" id="email" value="<?php echo $dados['senha']; ?>" name="senha">
                            </div>    
                        </div>  
<!--___________________________________________________________________________________________________________-->  
                        <!-- input para pegar o id do banco nao aparece no site -->
                        <input type="hidden" name="id" value="<?php echo $dados['idpessoa']; ?>">

<!--____________________________________________________________________________________________________________-->
                    <div class="for-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
                        </div>
                    </div> 
                </form>
        </div>

        <hr>
        
    </div>    
<!-- java script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>
<?php 
    mysqli_close($conn);
?>