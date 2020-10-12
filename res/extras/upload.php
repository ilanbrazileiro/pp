<?php 

 
    $arquivo_tmp = $_FILES[ 'file' ][ 'tmp_name' ];
    $nome = $_FILES[ 'file' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = 'img/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            echo '/res/extras/'.$destino;
            //echo $_SERVER['SERVER_NAME'].'/questoes'.'/res/extras/'.$destino;
        } 
        else {
                
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
        }
    }
    else {
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
    }



/*
define('DS', DIRECTORY_SEPARATOR);
//Caminho absoluto do local que vai salvar as fotos
$pasta    = $_SERVER['SERVER_NAME'].DS.'questoes'.DS.'res'.DS.'extras'.DS.'img'.DS;

//URL que vai ser gerada
$pastaurl = $_SERVER['SERVER_NAME'].'/questoes'.'/res/extras/img';

$tmp_name = $_FILES['file']['tmp_name'];

//Pega o mimetype
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $tmp_name);
finfo_close($finfo);

//Só permite upload de imagens
if (strpos($mime, 'image/') === 0) {

   //Gera um nome que não se repete para imagem e adiciona a extensão conforme o mimetype
   $file = time() . '.' . str_replace('image/', '', $mime);

   $destino = $pasta.$file;

   if (move_uploaded_file($tmp_name, $destino)) {
       echo $pastaurl . $file;
   }
}
*/
?>