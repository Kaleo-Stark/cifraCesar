<?php
// ARRAY COM AS LETRAS DO ALFABETO 
$letras = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', ' ');

//###############( RECEBE OS DADOS POSTADOS )################
$mensagem = $_POST['fmensagem']; // ....... RECEBE A MENSAGEM A SER CRIPTOGRAFADA
$option   = $_POST['foption']; // ......... RECEBE SE DEVE CRIPTOGRAFAR OU DESCRIPTOGRAFAR
$chave    = $_POST['fchave']; // .......... RECEBE O VALOR DE QUANTAS LETRAS A FRENTE PARA CRIPTOGRAFAR
//###########################################################

//#########( PREPARA OS DADOS PARA A CRIPTOGRAFIA)###########
$mensagem = strtolower($mensagem); // ..... CONVERTE A MENSAGEM EM MINUSCULA
$mensagem = str_split($mensagem); // ...... QUEBRA A MENSAGEM EM ARRAY
$option   = strtolower($option); // ....... CONVERTE A OPCAO PARA MINUSCULA
$chave    = intval($chave); // ............ CONVERTE A CHAVE PARA INTEIRO
//###########################################################

// ############################### FUNÇÃO PARA CRIPTOGRAFAR #######################################
function criptografar($letras, $chave, $mensagem)
{
    $novaMensagem = array(); // .................................................... VARIAVEL QUE RECEBERA A MENSAGEM CRIPTOGRAFADA

    foreach ($mensagem as $indiceMensagem => $letraMensagem) { // .................. PERCORRE A MENSAGEM
        foreach ($letras as $indiceLetra => $letra) { // ........................... PERCORRE AS LETRAS
            if ($letra == $letraMensagem) { // ..................................... SE A LETRA DA MENSAGEM FOR IGUAL A LETRA DO ARRAY
                if ($indiceLetra == 26) { // ....................................... SE A LETRA DA MENSAGEM FOR ESPAÇO
                    $novaMensagem[] = " "; // ...................................... A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE O ESPAÇO
                } else if (($indiceLetra + $chave) > 25) { /* ...................... OU SE O INDICE MAIS A CHAVE FOR MAIOR QUE 25 
                                                                                     (QUANTIDADES DE LETRAS DO ALFABETO NO ARRAY) 
                                                                                     *OBS: O ARRAY COMEÇA COM INDICE 0                  */
                    $novaMensagem[] = $letras[(($indiceLetra + $chave) - 26)];/* ... A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE A LETRA
                                                                                     REFERENTE FAZENDO A SEGUINTE CONTA PARA SE OBTER O 
                                                                                     INDICE CERTO: 
                                                                                     ((INDICE DA LETRA DO ARRAY + CHAVE) - O TAMANHO DO ARRAY QUE É 26).*/
                } else { // ........................................................ SENÃO 
                    $novaMensagem[] = $letras[($indiceLetra + $chave)]; /* ......... A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE A LETRA
                                                                                     REFERENTE FAZENDO A SEGUINTE CONTA PARA SE OBTER O 
                                                                                     INDICE CERTO: (INDICE DA LETRA DO ARRAY + CHAVE)*/
                }
            }
        }
    }

    return $novaMensagem; // ....................................................... RETORNA O ARRAY COM A MENSAGEM CRIPTOGRAFADA
}
// ################################################################################################

// ############################### FUNÇÃO PARA DESCRIPTOGRAFAR ####################################
function descriptografar($letras, $chave, $mensagem)
{
    $novaMensagem = array(); // .................................................... VARIAVEL QUE RECEBERA A MENSAGEM DESCRIPTOGRAFADA

    foreach ($mensagem as $indiceMensagem => $letraMensagem) { // .................. PERCORRE A MENSAGEM
        foreach ($letras as $indiceLetra => $letra) { // ........................... PERCORRE AS LETRAS
            if ($letra == $letraMensagem) { // ..................................... SE A LETRA DA MENSAGEM FOR IGUAL A LETRA DO ARRAY
                if ($indiceLetra == 26) { // ....................................... SE A LETRA DA MENSAGEM FOR ESPAÇO
                    $novaMensagem[] = " "; // ...................................... A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE O ESPAÇO
                } else if (($indiceLetra - $chave) < 0) { // ....................... OU SE O INDICE MENOS A CHAVE FOR MENOR QUE 0
                    $novaMensagem[] = $letras[(26 - ($chave - $indiceLetra))]; /* .. A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE A LETRA
                                                                                     REFERENTE FAZENDO A SEGUINTE CONTA PARA SE OBTER O 
                                                                                     INDICE CERTO: 
                                                                                     (O TAMANHO DO ARRAY QUE É 26 - (CHAVE - INDICE DA LETRA DO ARRAY)).*/
                } else { // ........................................................ SENÃO
                    $novaMensagem[] = $letras[($indiceLetra - $chave)]; /* ......... A VARIAVEL DA MENSAGEM CRIPTOGRAFADA RECEBE A LETRA
                                                                                     REFERENTE FAZENDO A SEGUINTE CONTA PARA SE OBTER O 
                                                                                     INDICE CERTO: (INDICE DA LETRA DO ARRAY - CHAVE)*/
                }
            }
        }
    }

    return $novaMensagem; // ....................................................... RETORNA O ARRAY COM A MENSAGEM CRIPTOGRAFADA
}
// ################################################################################################

// #######################################( EXECUÇÃO )#############################################
if ($option == "criptografar" || $option == "c") { // ............. SE A OPÇÃO FOR CRIPTOGRAFAR
    $retorno = criptografar($letras, $chave, $mensagem); /* ....... EXECUTA A FUNÇÃO CRIPTOGRAFAR PASSANDO AS VARIAVEIS NECESSARIAS
                                                                    E ATRIBUINDO SEU RETORNO A UMA VARIAVEL*/
    $mensagem = implode('', $retorno); // ......................... CONVERTE O ARRAY DE RETORNO EM STRING

    echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>
            alert(' A mensagem criptografada é: $mensagem ');
            history.back();
          </SCRIPT>"; // .......................................... RETORNA UM ALERTA COM A MENSAGEM CRIPTOGRAFADA

} else if ($option == "descriptografar" || $option == "d") { // ... SE A OPÇÃO FOR DESCRIPTOGRAFAR
    $retorno = descriptografar($letras, $chave, $mensagem); /* .... EXECUTA A FUNÇÃO CRIPTOGRAFAR PASSANDO AS VARIAVEIS NECESSARIAS
                                                                    E ATRIBUINDO SEU RETORNO A UMA VARIAVEL*/
    $mensagem = implode('', $retorno); // ......................... CONVERTE O ARRAY DE RETORNO EM STRING

    echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>
            alert(' A mensagem descriptografada é: $mensagem ');
            history.back();
          </SCRIPT>"; // .......................................... RETORNA UM ALERTA COM A MENSAGEM DESCRIPTOGRAFADA
}
// ################################################################################################