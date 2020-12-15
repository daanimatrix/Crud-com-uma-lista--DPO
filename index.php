<?php
    require_once 'classe-pessoa.php';
    $p = new Pessoa("mafiscred1","localhost","root","");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php


    if(isset($_POST['nome']))
    {
        //CLICOU NO BOTÃO CADASTRAR OU EDITAR

        //---------------------- EDITAR ------------------------------
        if(isset($_GET['id_up']) && !empty($_GET['id_up']))
        {//Se tiver uma variavel id_up e ele não tiver vazia 

            $id_upd = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $celular = addslashes($_POST['celular']);
            $ativo = addslashes($_POST['ativo']);
    
            if(!empty($nome) && !empty($email) && !empty($senha) && !empty($celular) && !empty($ativo)) {//SE NÃO TIVER VAZIO ESSAS VARIAVEIS
                
              //EDITAR
               $p->atualizarDados($id_upd,$nome,$email, $senha,$celular,$ativo);
               header("location: index.php");
                
            }
            else
            { //se caso ele não cadasdrou 
                ?>
                    <div class="aviso">
                        <img src="aviso.jpg">
                        <h4>Preencha todos os campos</h4>
                    </div>
                <?php
            }

        }
        //---------------------- CADASTRAR ---------------------------
        else{
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $celular = addslashes($_POST['celular']);
            $ativo = addslashes($_POST['ativo']);

            if(!empty($nome) && !empty($email) && !empty($senha) && !empty($celular) && !empty($ativo)) {//SE NÃO TIVER VAZIO ESSAS VARIAVEIS
                //cadastrar
            if( !$p->cadastrarPessoas($nome,$email, $senha,$celular,$ativo)){
                ?>
                <div>
                    <img src="img/alerta.png">
                    <h4>Email ja esta cadastrado!</h4>
                </div>
            <?php
            }
            }
            else
            { //se caso ele não cadasdrou 
                ?>
                <div class="aviso">
                    <img src="aviso.png">
                    <img src="img/alerta.png">
                    <h4>Preencha todos os campos</h4>
                </div>
            <?php
            }
        }
    }


    ?>
    <?php
        if(isset($_GET['id_up'])){//Ele vai verificar se a pessoa clicou no botão editar
            $id_update = addslashes(($_GET['id_up']));
            $res=$p->buscarDadosPessoa($id_update);
        }
    ?>

    <section id="esquerda">
        <form method="POST">
            <h2>CADASTRAR PESSOA</h2>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"        value="<?php if(isset($res)){echo $res['nome'];} ?>">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"     value="<?php if(isset($res)){echo $res['email'];} ?>">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha"      value="<?php if(isset($res)){echo $res['senha'];} ?>">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular"  value="<?php if(isset($res)){echo $res['cel'];} ?>">
            <label for="ativo">Ativo</label>
            <input type="number" name="ativo" id="ativo"      value="<?php if(isset($res)){echo $res['sit'];} ?>">

            <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";} ?>">
        </form>
    </section>

    <section id="direita">
    <table>
            <!--Titulo-->
            <tr id="titulo">
                <td>NOME</td>
                <td>E-MAIL</td>
                <td >SENHA</td>
                <td>CEL</td>
                <td>ATIVO</td>
                <td colspan="2">CONTA</td>
            </tr>

            <!--Dados do cliente-->
    <?php
        $dados = $p->buscarDados();

        if(count($dados) > 0)//se contar os dados e for maior que zero, ele esta preenchido.
        {

        //esse array é mais para estilo matrix, um dentro do outro
            for ($i=0;$i< count($dados); $i++){
                echo "<tr>";
                    foreach($dados[$i] as $k => $v){
                        if($k != "idusuario"){//só vai mostrar se a variavel se for diferente de Id( ou seja não vai mostrar os Ids)
                            echo "<td>.$v.</td>";
                        }
                    }
                    ?>
                        <td>
                            
                            <a href="index.php?id_up=<?php echo $dados[$i]['idusuario'];?>">Editar</a>
                            <a href="index.php?idusuario=<?php echo $dados[$i]['idusuario'];?>">Excluir</a>
                        </td>
                    <?php
                    echo "</tr>";   

            }
                
        }
        else{//Se ele estiver vazio 
            ?>

     
            

         
        </table>

            <div class="centro">
                <img src="img/alerta.png">
                <h4> Ainda não ha pessoas cadastradas!</h4>
            </div>

            <?php
        }

        
    ?>
    </section>
</body>
</html>

<?php
    if(isset($_GET['idusuario']))
    {
        $id_pessoa = addslashes($_GET['idusuario']);
        $p->excluirPessoa($id_pessoa);
        header("location: index.php");

    }
?>