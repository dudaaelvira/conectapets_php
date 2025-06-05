<?php

function maiorNumero($numero1,$numero2){
    echo "Os números escolhidos foram: $numero1 e $numero2";
    echo '<br>';
    if ($numero1 < $numero2) {
        echo "O $numero2 é o maior número!";
        echo '<br>';
    }
    elseif($numero1 > $numero2) {
        echo "O $numero1 é o maior número!";
        echo '<br>';
    }
    else {
        echo "O $numero1 é igual ao $numero2";
        echo '<br>';
    }
        

}
maiorNumero(14,28);
maiorNumero(28,14);
maiorNumero(10,10);





$primeiroNumero = 10;
echo $primeiroNumero;
echo '<br>';

function soma($numeroA,$numeroB){
    echo "numeros: $numeroA, $numeroB";
    echo '<br>';
    $resultado = $numeroA + $numeroB;
    echo "O resultado da soma é: $resultado";
    echo '<br>';
}
soma(10,20);
soma(13,26);

function funcaoDuda() {
 echo 'duda';
 echo '<br>';
}

funcaoDuda();


 function funcaoTeste() {
    echo 'oi pepe';
    echo '<br>'; 
    
 }

funcaoTeste();
funcaoTeste();
funcaoTeste();
funcaoDuda();
?>


