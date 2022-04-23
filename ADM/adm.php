<?php
 require_once("../conexao/config.php");

    session_start();
      //teste de segurançã
      if( !isset($_SESSION["user"])){
          header("Location:../pag-01.php");
      }
      //listar os usuarios
      $sql = "select idpessoa,nome,telefone,email,tipo from PESSOA ";
      $res = mysqli_query($conn,$sql);
      if( !$res ){
            die("Erro na conexão");
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
        .top         {margin-top: 50px}
        .a:hover     {text-decoration: none; color: white}
        .a           {color: white}
        .tamanho     { height:400px}
    </style>
</head>
<body>
    <div class="container-fluid">

       <?php //require_once("cabecalho.php"); ?> 
        <hr>
        <div class="container">
            
            <div class="block-inline">
                <a class="a" href="adm.php"><div class="btn btn-primary btn-sm col-sm-2">Home</div></a> 
                <a href="cadastro.php" class="a"><div class="btn btn-primary btn-sm col-sm-2 col-md-offset-3"><b> Cadastro</b> </div></a>
                <a class="a" href="sair.php"><div class="btn btn-danger btn-sm col-sm-2 pull-right"> Sair</div></a> 
            </div>

            <h3 class="text-center top">Administradores</h3>
            <div class="table-responsive tamanho">
            <table class="table">
        
                    <tr>
                        <th>Nome</th>
                        <th>E_mail</th>
                        <th>Telefone</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                        <th>Ações</th>
                    </tr>
                    <?php while( $row = mysqli_fetch_assoc($res) ){ ?>
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['telefone']; ?></td>
                            <td><?php echo $row['tipo']?></td>
                            <td><a href="alterar.php?codigo=<?php echo $row['idpessoa'] ?>">Alterar</a></td>
                            <td><a href="excluir.php?codigo=<?php echo $row['idpessoa'] ?>">Excluir</a></td>
                        </tr>
                    <?php } ?>
                </table>
                </div>

        </div>

        <hr>
        
    </div>    
<!-- java script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>
<?php   mysqli_close($conn); ?>