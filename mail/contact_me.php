<?php
date_default_timezone_set('Etc/GMT+3');

require 'PHPMailer/PHPMailerAutoload.php';

$email = new PHPMailer();
$email2 = new PHPMailer();

if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
   echo "Parametros insuficientes.";
   return false;
}
   
$nome		= strip_tags(htmlspecialchars($_POST['name']));
$emailReciver		= strip_tags(htmlspecialchars($_POST['email']));
$fone		= strip_tags(htmlspecialchars($_POST['phone']));
$mensagem	= strip_tags(htmlspecialchars($_POST['message']));

$table = "
<div><b>Nome: </b>{$nome}</div>
<div><b>E-mail: </b>{$emailReciver}</div>
<div><b>Telefone: </b>{$fone}</div>
<div><b>Mensagem: </b>{$mensagem}</div>";

include "email.php";
include "retorno_contato.php";

$email->CharSet = 'UTF-8';
$email->setFrom('contato@ghostairsoft.com.br', 'Contato Site');
$email->addAddress( 'contato@ghostairsoft.com.br' );
$email->Subject   = '[G.H.O.S.T] - Formulário de recrutamento';
$email->Body      = $html;
$email->AltBody = '[G.H.O.S.T.] - Formulário de recrutamento';

$email->Send();

$email2->CharSet = 'UTF-8';
$email2->setFrom('contato@ghostairsoft.com.br', 'Contato Site');
$email2->addAddress( $emailReciver );
$email2->Subject   = '[G.H.O.S.T] - Formulário de recrutamento';
$email2->Body      = $html2;
$email2->AltBody = '[G.H.O.S.T.] - Formulário de recrutamento';
$email2->addAttachment('../downloads/01-Estatuto G.H.O.S.T..docx', 'Estatuto G.H.O.S.T..docx', 'base64', 'docx');

$email2->Send();
return true

?>
