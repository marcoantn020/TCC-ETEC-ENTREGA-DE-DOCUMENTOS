<?php
        require_once("conexao/config.php");

        session_start();
        //teste de segurançã
        if( !isset($_SESSION["user"])){
            header("Location:pag-01.php");
        
        }
        //testar codigo do curso
        if(isset($_GET["codigo"])){
             $id = $_GET["codigo"]; 
             $_SESSION['curso'] = $id;
            }
        else{
             header("Location:pag-03.php"); 
            }
         
        //query curso
        $sql     = "select idcurso,nome_curso from CURSO ";
        $sql    .= "WHERE idcurso = {$id} ;";
        $execute = mysqli_query($conn,$sql);
        if (!$execute ){ die("Erro no banco".mysqli_error($conn)); }
         //dados
        $dados = mysqli_fetch_assoc($execute);
        //query pessoa
        $sqlp  = "select idpessoa, nome, id_curso from PESSOA where id_curso = {$id} and tipo='3' ";
        $query = mysqli_query($conn,$sqlp);
        if(!$query){ die("Erro na consulta. ".mysqli_error($conn));}
        //dados2 pessoa
       
            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabalho de Conclusão de Curso</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/pag-4.css">
    <style>
        .a:hover     {text-decoration: none; color: red}
        .a           {color: blue;text-align:center}
        .center      {text-align:center}
    </style>
</head>
<body>
    <div class="container-fluid">
        <hr>
        <div class="container">
            <div class="block-inline">
                    <a class="a" href="pag-03.php"><div class="btn btn-primary btn-sm col-sm-2"> Home</div></a>
                    <div class="btn btn-primary btn-sm col-sm-2 col-md-offset-3">hora </div>
                    <a class="a" href="close.php"><div class="btn btn-danger btn-sm col-sm-2 pull-right"> Sair</div></a>
            </div>

            <table class="table col-sm-6 col-sm-offset-2 c table-striped table-bordered table-hover">
                <thead  class="info">
                    <tr>
                        <td colspan="3" class="text-center font color">
                            <?php 
                                echo utf8_encode($dados['nome_curso']);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="font center">Alunos</td>
                        <td class="font center">Documentos</td>
                        <td class="font center">Pré-Visualizar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while( $dados2 = mysqli_fetch_assoc($query)){?>
                        <tr>
                            <td><?php echo $dados2['nome']?></td>
                            <td class="center"> <a href="gerarPDF.php?DOC=<?php echo $dados2['idpessoa']?>" class="a">Documentos</a> </td>
                            <td class="center"><a class="a" href="pag-05.php?idaluno=<?php echo $dados2['idpessoa']?>"> Visualizar - <img src="imagens/lupa.png"></a> </td>
                        </tr>
                     <?php }?>
                    <!-- _______________________________________ -->                   
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
<?php   mysqli_close($conn);?>