<?php
        require_once("conexao/config.php");

        session_start();
        //teste de segurançã
        if( !isset($_SESSION["user"])){
            header("Location:pag-01.php");
        
        }
        //----------------------------------------
        $sql = "select idcurso,nome_curso,modulo,tempo_duracao from CURSO ;";
        $execute = mysqli_query($conn,$sql);
        if (!$execute ){ die("Erro no banco".mysqli_error($conn)); }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabalho de Conclusão de Curso</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/pag-3.css?version=12">
    <style>
        .a:hover     {text-decoration: none; color: white}
        .a           {color: white}
    
    </style>
</head>
<body>
    <div class="container-fluid">
        <hr>
        <div class="container">
            <div class="block-inline baixo">
                    <a class="a" href="pag-03.php"><div class="btn btn-primary btn-sm col-sm-2"> Home</div></a>
                    <div class="btn btn-primary btn-sm col-sm-2 col-md-offset-3">hora </div>
                    <a class="a" href="close.php"><div class="btn btn-danger btn-sm col-sm-2 pull-right"> Sair</div></a> 
            </div>

            <table class="table col-sm-6 table-striped table-bordered table-hover">
                <thead  class="info">
                    <tr>
                        <td nowrap="none" class="text text-center">Nome do Curso</td>
                        <td nowrap="none" class="text text-center">Tempo Duração</td>
                        <td nowrap="none" class="text text-center"> Módulos</td>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = mysqli_fetch_assoc($execute)){?>

                    <tr>
                    <td nowrap="none"> <a href="pag-04.php?codigo=<?php echo $row['idcurso']?>"><?php echo utf8_encode($row['nome_curso']) ?></a> </td>
                    <td nowrap="none"> <?php echo "<center>".utf8_encode($row['tempo_duracao'])."</center>"; ?></td>
                    <td nowrap="none"> <?php echo "<center>".utf8_encode($row['modulo'])."</center>" ?> </td>

                    </tr>

                <?php }?>
                </tbody id="b">
            </table>
            
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