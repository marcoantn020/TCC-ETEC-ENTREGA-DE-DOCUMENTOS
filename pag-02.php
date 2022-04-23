<?php   //conexão/função de upload de imagem
        require_once("conexao/config.php");
        require_once("funcoes/funcao.php");

        session_start();
        //teste de segurança
        if( !isset($_SESSION["user"])){
            header("Location:pag-01.php");
        }else{
            $idpessoa = $_SESSION['user'];
        }
      
 //_____________________________________________________________________________-
          //selecionar dados do curso 
          $dados = "select idcurso,nome_curso from CURSO ;";
          $query = mysqli_query($conn,$dados);
          if(!$query){ die("Erro no banco".mysqli_error($conn));}
//-----------------------------------------------------------------------------
        //query
        if( isset($_POST['enviar'])){
            //função 
            $foto1 = salvarImagem($_FILES['rgf']);
            $foto2 = salvarImagem($_FILES['rgv']);
            $foto3 = salvarImagem($_FILES['cpf']);
            $foto4 = salvarImagem($_FILES['cd']);
            $foto5 = salvarImagem($_FILES['cdc']);
            $foto6 = salvarImagem($_FILES['cnhf']);
            $foto7 = salvarImagem($_FILES['cnhv']);
            $foto8 = salvarImagem($_FILES['historico']);
            
            //$msg1 = $foto1[0]; mostrar erros caso precise

            $rgf       = $foto1[1];
            $rgv       = $foto2[1];
            $cpf       = $foto3[1];
            $cd        = $foto4[1];
            $cdc       = $foto5[1];
            $cnhf      = $foto6[1];
            $cnhv      = $foto7[1];
            $historico = $foto8[1];
            $idcurso   = $_POST['idcurso'];

            $sql  = "INSERT INTO `DOCUMENTO`(`iddocumento`, `id_pessoa`, `status`, `rg_frente`, `rg_verso`, `cpf`, `cnh_frente`, ";
            $sql .="`cnh_verso`, `certidao_nascimento`, `certidao_casamento`, `historico_escolar`, `data_envio`) ";
            $sql .= "VALUES (null, {$idpessoa} ,null,'{$rgf}','{$rgv}','{$cpf}','{$cd}','{$cdc}','{$cnhf}','{$cnhv}','{$historico}',null);";

            $execute = mysqli_query($conn,$sql);
            if(!$execute){ die("erro no banco". mysqli_error($conn));}

            //atualizar tabela pessoa
            $update    = "UPDATE `PESSOA` SET `id_curso`={$idcurso} WHERE idpessoa = {$idpessoa} ";
            $atualizar = mysqli_query($conn,$update);
            if(!$atualizar){ die("Erro no banco.".mysqli_error($conn));}
            
           header("Location:close.php");
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabalho de Conclusão de Curso</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="_css/pag-2.css?version=12">
</head>
<body>
    <div class="container-fluid">
        <hr>
        <div class="container">
            <h2 id="cor">Envio de Documentos</h2>
            <p class="text-center">Lembramos que é nescessário apresentar os originais no dia de efetivar a matricula.</p>
                <form action="pag-02.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                                <span class="input-group col-sm-8 col-sm-offset-2 fonte-w">Selecione o Curso </span>  
                            <div class="input-group col-sm-8 col-sm-offset-2 ">          
                                <select name="idcurso">
                                    <?php while($row = mysqli_fetch_assoc($query)){ ?>
                                        <option value="<?php echo $row['idcurso']?>"> <?php echo utf8_encode($row['nome_curso'])?> </option> 
                                    <?php }?>
                                </select>            
                                
                            </div>   
                        </div>
<!--_______________________________________________________________________________________________________-->
                        <div class="form-group">
                                <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> RG-frente </span>  
                            <div class="input-group col-sm-8 col-sm-offset-2 "> 
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">            
                                    <input class="form-control" type="file" name="rgf">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div>
                        <?php if(isset($msg)){ echo $msg; } ?>
<!-- ________________________________________________________________________________________________ -->
                        <div class="form-group">
                            <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> RG-verso </span>
                            <div class="input-group col-sm-8 col-sm-offset-2 ">   
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">           
                                    <input class="form-control" type="file" name="rgv">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div>     
                        <?php if(isset($msg)){ echo $msg; } ?>                 
<!-- ________________________________________________________________________________________________ -->
                        <div class="form-group">
                            <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> CPF </span>
                            <div class="input-group col-sm-8 col-sm-offset-2 "> 
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">              
                                    <input class="form-control" type="file" name="cpf">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div>
                        <?php if(isset($msg)){ echo $msg; } ?>
<!-- ________________________________________________________________________________________________ -->
                        <div class="form-group">
                            <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> Certidão de Nascimento </span>
                            <div class="input-group col-sm-8 col-sm-offset-2 ">  
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">              
                                    <input class="form-control" type="file" name="cd">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div>
                        <?php if(isset($msg)){ echo $msg; } ?>
<!-- ________________________________________________________________________________________________ -->
                        <div class="form-group">
                            <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> Certidão de casamento </span>
                            <div class="input-group col-sm-8 col-sm-offset-2 ">  
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">            
                                    <input class="form-control" type="file" name="cdc">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div>
                        <?php if(isset($msg)){ echo $msg; } ?>
<!-- ________________________________________________________________________________________________ -->
                        <div class="form-group">
                            <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> CNH-frente </span>
                            <div class="input-group col-sm-8 col-sm-offset-2 ">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">                 
                                    <input class="form-control" type="file" name="cnhf">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div>
                        <?php if(isset($msg)){ echo $msg; } ?>
<!-- ________________________________________________________________________________________________ -->
                        <div class="form-group">
                            <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> CNH-verso </span>
                            <div class="input-group col-sm-8 col-sm-offset-2 "> 
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">              
                                    <input class="form-control" type="file" name="cnhv">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div>
                        <?php if(isset($msg)){ echo $msg; } ?>                                                                                      
<!-- ________________________________________________________________________________________________ -->
                        <div class="form-group">
                            <span class="input-group col-sm-8 col-sm-offset-2 fonte-w"> Historico Escolar </span>
                            <div class="input-group col-sm-8 col-sm-offset-2 "> 
                                    <input type="hidden" name="MAX_FILE_SIZE" value="6000000">              
                                    <input class="form-control" type="file" name="historico">                
                                <span class="input-group-addon btn"><img src="imagens/ajuda.png" class="img-resp"></span>
                            </div>   
                        </div> 
                        <?php if(isset($msg)){ echo $msg; } ?>
<!--___________________________________________________________________________________________________________-->                        
                        <div class="form-group b">
                            <div class="col-sm-8 col-sm-offset-2 baixo">
                                <button  type="submit" class="btn btn-primary btn-sm btn-block color" name="enviar">Enviar</button>
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