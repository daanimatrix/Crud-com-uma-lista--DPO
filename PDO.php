<?php


session_start();

$localhost = "localhost";
$user = "root";
$passw = "";
$bancodedado = "mafiscred1";

global $pdo;

//PDO
try{
        // orientada a objetos com pdo 
        $pdo = new PDO("mysql:dbname=".$bancodedado."; host=".$localhost,$user,$passw);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //VAI MOSTRAR TODA A LISTA DO USUARIOS QUE ESTA NA LISTA sql
        //$sql = $pdo->query("SELECT * FROM usuarios");
        // $sql->execute();  

}catch(PDOException $erro){

    echo "ERRO com banco de dados: ".$erro->getMessage();
    exit;

}catch(Exceptio $erro){
    echo "ERRO genericos: ".$erro->getMessage();
    exit;
}

//------------------------------ INSERIR ------------------------------------

//$res =$pdo->prepare("INSERT INTO usuarios(nome,email,senha,cel,sit) VALUE(:n,:e,:s,:c,:i)");

/*
// Tipo 1 de colocar valor // bindValue : pode colocar o valor direto na base 
$res->bindValue(":n","Silas");
$res->bindValue(":e","Silas@hotmail.com");
$res->bindValue(":s",md5("12345"));
$res->bindValue(":c","98888-3333");
$res->bindValue(":i","1");
$res->execute();
*/

/* Tipo 2 de colocar valor(exemplo): // bindparam : pode colocar o valor só com a variavel 
$res->bindparam(":n","$nome"); 
$res->bindparam(":e","$email"); 
$res->bindparam(":s","$senha"); 
$res->bindparam(":c","$cel"); 
$res->bindparam(":si","$sit"); 

$nome= Silas;
$email = Silas@hotmail.com;
$senha = 12345;
$cel = 99999-3333;
$sit = 1;
$res->execute();

*/

// Tipo 3 de colocar o valor : Ele vai colocar igual o codigo do Mysql
// $pdo->query("INSERT INTO usuarios(nome,email,senha,cel,sit) VALUE('Silas','silas@hotmail.com','12345','98888-3333','1')");


//--------------------------------  DELETE E UPDATE --------------------------------
/*
//DELETE
Tipo 1 
$res = $pdo->prepare("DELETE from usuarios where idusuario = :id"); //Esse é o comando 
$id = 7;
$res->bindValue(":id",$id);
$res->execute();
*/

//Tipo 2
//$res = $pdo->query("DELETE from usuarios where idusuario = '3'"); //Ele vai colocar igual o codigo do Mysql

/*
//UPDATE
//Tipo 1
$update = $pdo->prepare("UPDATE usuarios SET email = :e WHERE = :id"); //
$update->bindValue(":e","teste@hotmail.com");
$update->bindValue(":id", 2);
$update->execute();

//Tipo 2
$update = $pdo->query("UPDATE usuario set email= 'Teste@hotmail.com' where  = '3'"); //Ele vai colocar igual o codigo do Mysql
*/

/*
//--------------------------------  SELECT -------------------------------------------

$cmd = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :id");//preparando o comando com mysql
$cmd->bindValue(":id",1); //jogando o valor 4 para o id
$cmd->execute(); //executando 

//fetch : ele vai fatiar em um unico registro 
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

//fetchAll : ele vai fatiar em varios pedaço aquele dado ( array )
//$cmd->fetchAll();

foreach ($resultado as $key => $value) {
   
    echo $key.":".$value."<br>";
}

//print_r($resultado);

*/

?>