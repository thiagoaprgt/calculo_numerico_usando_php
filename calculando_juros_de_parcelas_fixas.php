<?php

 /*

    Fórmula da Metodologia do Financiamento com Prestações Fixas

    p = valor da prestação
    j = juros
    n = meses 
    q = Valor financiado

    ( 1- (1+j)^(-n) ) / j -  q * p = 0

    Nesse caso o valor a ser achado é o j, juros.
    Entretando não há como isolar a variável, então se faz necessário
    o uso de cálculo númerico.
    Nesse exemplo eu usarei o método de Newton-Raphson, que consiste em uma
    aproximação polinomial. 
    
    Calculo númerico (metódo de Newto-Raphson) :

    Xn = novo valor do juros a ser encontrado

    Xn-1 = é o valor do juros atual que está sendo utilizado

    F(Xn-1) = é a função utilizada  = ( ( 1- (1+j)^(-n) ) / j ) - q * p

    F'(Xn-1) = é a derivada da função


    Xn = Xn-1 -  ( F(Xn-1) ) / F'(Xn-1) )

*/


function Calcular($valor_parcela, $valor_total, $parcelas, $casas_decimais = 2){
    
    // aqui o Xn será a variável $b e Xn-1 será a variável $a 

    

    $a = 0.001;

    $tentativas = 0;

    while($tentativas < 200) {

        //echo "Valor de a = " . $a . "<br>";
        
        // $fx é a função F(Xn-1)
        $fx = ( ( 1 - pow((1+$a), (-$parcelas)) ) / $a ) - ($valor_total / $valor_parcela);

        // $dfx é a derivada da função F(Xn-1)
        $dfx = ( $parcelas * $a * ( pow((1+$a), (-1-$parcelas)) ) + pow((1+$a), -$parcelas) - 1 ) / ( pow($a, 2) );

      
        $b = $a - ( $fx / $dfx );

        $a = $b;

        //echo "tentativa $tentativas o juros = " . $a . "<br><br><br>";

        $tentativas++;        

    }
    
    
    // usar a função round para controlar as casas decimais

    $a = round(100 * $a, $casas_decimais);

    return $a;
    
    
}


var_dump(Calcular(218.29, 1000, 5)); //Deve retornar float 2.99
var_dump(Calcular(161.79, 1500, 10)); //Deve retornar float 1.4
var_dump(Calcular(1122.5, 6800, 7)); //Deve retornar float 3.75


?>