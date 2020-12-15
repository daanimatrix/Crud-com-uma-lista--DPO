<?php


Class Pessoa {

    //
    private $pdo;



    //CONSTRUTOR 
    public function __construct($bancodedado, $host, $user ,$passw){

        $this->pdo = new PDO("mysql:dbname=".$bancodedado.";host=".$host,$user,$passw);

        try {
            $this->pdo = new PDO("mysql:dbname=".$bancodedado.";host=".$host,$user,$passw);

            } catch (PDOException $e) {
                echo "Erro com banco de dados: ".$e->getMessage();
            }
            catch(Exception $e){
                echo "Erro generico: ".$e->getMessage();
            }
}



   //METODO BUSCAR DADOS ( Para buscar os dados e mostrar no campo direito da lista dos cadastrados )
   public function buscarDados(){
        $res = array(); //se caso a variavel res não tem nada, em vez de retorna um erro, ele retorna vazio com o tipo array() 
        $cmd = $this->pdo->query("SELECT * FROM usuarios ORDER BY nome"); //Em vez de usar o parametro prepare() melhor usar o query que é mais direto
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }



    //METODO CADASTRAR PESSOAS
    public function cadastrarPessoas($nome,$email, $senha,$cel,$sit){


        //Antes de cadastrar verificar se já tem o email 

        $cmd = $this->pdo->prepare("SELECT idusuario from usuarios WHERE email = :e");
        $cmd->bindValue(":e",$email);
        $cmd->execute();

        //ele vai verificar se o cmd tem mais que um 
        if($cmd->rowCount() > 0) 
            {
                    return false;
            }
        //se o email não foi encontrado vai fazer o cadastro
        else{ 
        $cmd = $this->pdo->prepare("INSERT INTO usuarios(nome,email,senha,cel,sit) VALUES (:n, :e, :s, :c, :si) ");

        $cmd->bindValue(":n",$nome); 
        $cmd->bindValue(":e",$email); 
        $cmd->bindValue(":s",md5($senha)); 
        $cmd->bindValue(":c",$cel); 
        $cmd->bindValue(":si",$sit); 
        $cmd->execute();
        return true;
        }
    }

        //METODO DE EXCLUIR 

        public function excluirPessoa($id){
            $cmd = $this->pdo->prepare("DELETE FROM usuarios WHERE idusuario = :id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
        }

        //METODO BUSCAR DADOS DE UMA PESSOA
        public function buscarDadosPessoa($id){

            $res =  array(); //se caso não venha dados, ele não da erro 
            $cmd = $this->pdo->prepare("SELECT * FROM usuarios where idusuario = :id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);
            return $res;

        }



        //METODO ATUALIZAR DADOS NO BANCO DE DADOS
        public function atualizarDados($id_upd,$nome,$email,$senha,$celular,$ativo){


            
            $cmd = $this->pdo->prepare("UPDATE usuarios SET nome = :n, email = :e, senha = :s, cel = :c, sit = :a WHERE idusuario = :id");
            $cmd->bindValue(":n",$nome);
            $cmd->bindValue(":e",$email);
            $cmd->bindValue(":s",md5($senha));
            $cmd->bindValue(":c",$celular);
            $cmd->bindValue(":a",$ativo);
            $cmd->bindValue(":id",$id_upd);
            $cmd->execute();
           

        
    }
}
?>