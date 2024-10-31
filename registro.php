<!-- Desenvolvido dia 19/08/2019 Rodrigo Henning -->
<!-- enviar email para divisão responsável_________________________ -->
<?php

$autorizaEmail="";

$nome="Anônimo";
$cpf="";
$telefone="";
$endereco="";
$cidade="";

$nomeDenunciado="";
$apelidoDenunciado="";
$endeDenunciado="";
$complementoDenunciado="";
$cidadeDenunciado="";
$cep="";

$degradacao01="";
$degradacao02="";
$degradacao03="";
$degradacao04="";
$degradaçãoEspecificada="";

$narrativa="";
$anexo="NÃO";

if (isset($_POST['indentificacao'])) {
	
	if ($_POST['indentificacao']==1) {
		$tipoDenunciante="Denunciante Identificado";
		
		//PESSOAIS DO DENUNCIANTE
		$nome=$_POST['nome'];
		$cpf=$_POST['cpf']; 	
		$email=$_POST['email'];
		$telefone=$_POST['telefone'];
		$endereco=$_POST['endereco'];
		$cidade=$_POST['cidade'];
			if (isset($_POST['cep'])) {
				$cep=$_POST['cep'];
			}

 		//DADOS DO DENUNCIADO   	
		$nomeDenunciado=$_POST['nomeDenunciado'];
			if (isset($_POST['apelidoDenunciado'])) {
				$apelidoDenunciado=$_POST['apelidoDenunciado'];
			}
			if (isset($_POST['endeDenunciado'])) {
				$endeDenunciado=$_POST['endeDenunciado']; 
			}
			if (isset($_POST['complementoDenunciado'])) {
				$complementoDenunciado=$_POST['complementoDenunciado'];
			}			
		$cidadeDenunciado=$_POST['cidadeDenunciado'];	
		
		//TIPO DE DEGRADAÇÃO AMBIENTAL
			if (isset($_POST['queima'])) {
	          $degradacao01="Queimada";
	        }if (isset($_POST['desmate'])) {
	          $degradacao02="Desmatamento Ilegal";
	        }if (isset($_POST['agua'])) {
	          $degradacao03="Obstrução de Curso d´água ";
	        }if (isset($_POST['fauna'])) {
	          $degradacao04="Danos a Fauna ";
	        }if (isset($_POST['Especificar'])==1) {
	          $degradaçãoEspecificada=$_POST['degradaçãoEspecificada'];
	        }

	    //NARRATIVA DA DENÚNCIA
        $narrativa=$_POST['narrativa'];  

        //INDÍCIOS DA SUPOSTA IRREGULARIDADE
		    if (!empty($_FILES['arquivo']['name'])) {
		        $arquivo=$_FILES["arquivo"]; 
		        $anexo="SIM";         
		    } 
		$autorizaEmail="OK";      

	}elseif ($_POST['indentificacao']==2) {
		  $tipoDenunciante="Denunciante Anônimo"; 

		//PESSOAIS DO DENUNCIANTE
		$email=$_POST['email'];

 		//DADOS DO DENUNCIADO   	
		$nomeDenunciado=$_POST['nomeDenunciado'];
			if (isset($_POST['apelidoDenunciado'])) {
				$apelidoDenunciado=$_POST['apelidoDenunciado'];
			}
			if (isset($_POST['endeDenunciado'])) {
				$endeDenunciado=$_POST['endeDenunciado']; 
			}
			if (isset($_POST['complementoDenunciado'])) {
				$complementoDenunciado=$_POST['complementoDenunciado'];
			}			
		$cidadeDenunciado=$_POST['cidadeDenunciado'];	
		
		//TIPO DE DEGRADAÇÃO AMBIENTAL
			if (isset($_POST['queima'])) {
	          $degradacao01="Queimada";
	        }if (isset($_POST['desmate'])) {
	          $degradacao02="Desmatamento Ilegal";
	        }if (isset($_POST['agua'])) {
	          $degradacao03="Obstrução de Curso d´água ";
	        }if (isset($_POST['fauna'])) {
	          $degradacao04="Danos a Fauna ";
	        }

	    //NARRATIVA DA DENÚNCIA
        $narrativa=$_POST['narrativa'];  

        //INDÍCIOS DA SUPOSTA IRREGULARIDADE
		    if (!empty($_FILES['arquivo']['name'])) {		    	
		        $arquivo=$_FILES["arquivo"];
		        $anexo="SIM";       
		    } 

		$autorizaEmail="OK";    
	}	
}


$redireciona="sucesso.php";

if ($autorizaEmail=="OK") {
	
// Inclui o arquivo class.phpmailer.php localizado na pasta class
require_once("email/class/class.phpmailer.php");

// Monta o HTML:
 $corpoEmail = '
<html>
 <head>
 </head>
 <body>
 <form name="">
 <b><h3>Atenção! Novo registro de denúncia realizado.</h3></b><br/>
 <strong></strong><br/>

 <form">
    <fieldset>
        <legend><strong>1. DADOS PESSOAIS DO DENUNCIANTE</strong></legend>  
        <div class="row-fluid">
        	<div class="span5">
                <label>Tipo: </label><span><b>'.$tipoDenunciante.'</b></span>
            </div><br>
            <div class="span5">
                <label>Nome Completo: </label><b>'.$nome.'</b><span></span>
            </div>
            <div class="span2">
                <label>CPF: </label><span><b>'.$cpf.'</b></span>
            </div>
            <div class="span3">
                <label>Email: </label><span><span><b>'.$email.'</b></span>
            </div>
            <div class="span2">
                <label>Telefone: </label><span><span><b>'.$telefone.'</b></span>
            </div>
            <div class="span6">
             <label>Endereço: </label><span><span><b>'.$endereco.'</b></span>
         	</div>
	         <div class="span3">
	            <label>Localidade: </label><span><b>'.$cidade.'</b></span>
	        </div>
	        <div class="span3">
	            <label>Cep: </label><span><b>'.$cep.'</b></span>
	        </div>
    	</div>
</fieldset><br>
<fieldset>
        <legend><strong>2. DADOS DO DENUNCIADO</strong></legend>  
        <div class="row-fluid">
            <div class="span5">
                <label for="">Nome: </label><span><b>'.$nomeDenunciado.'</b></span>
            </div>
            <div class="span2">
                <label for="">Apelido: </label><span><b>'.$apelidoDenunciado.'</b></span>
            </div>
            <div class="span3">
                <label for="">Endereço: </label><span><b>'.$endeDenunciado.'</b></span>
            </div>
            <div class="span2">
                <label>Complemento: </label><span><b>'.$complementoDenunciado.'</b></span>
            </div>
	        <div class="span6">
	             <label>Localidade: </label><span><b>'.$cidadeDenunciado.'</b></span>
	        </div>
    	</div>
</fieldset><br>
<fieldset>
        <legend><strong>3. TIPO DE DEGRADAÇÃO AMBIENTAL</strong></legend>  
        <div class="row-fluid">
            <div class="span5">
                <label>'.$degradacao01.'</label>
            </div>
            <div class="span2">
                <label>'.$degradacao02.'</label>
            </div>
            <div class="span3">
                <label>'.$degradacao03.'</label>
            </div>
            <div class="span2">
                <label>'.$degradacao04.'</label>
            </div>
            <div class="span6">
             	<label>'.$degradaçãoEspecificada.'</label>
        	</div>
   		</div>
</fieldset><br>

<fieldset>
        <legend><strong>3. TIPO DE DEGRADAÇÃO AMBIENTAL</strong></legend>  
        <div class="row-fluid">
            <div class="span5">
                <label>Descrição detalhada dos fatos ocorridos: </label><span><b>'.$narrativa.'</b></span>
            </div><br>
            <div class="span2">
                <label>Anexo: </label><span><b>'.$anexo.'</b></span>
            </div>
   		</div>
</fieldset>
 <br><br>
 <center><strong>
 &copy; 2020 Portal IMAC<br>
 www.imac.ac.gov.br
 </strong> </center><br/>
 </form>
 </body>
 </html>
';

// Inicia a classe PHPMailer
$mail = new PHPMailer(true);

// corrigir erro acentuação
$corpoEmail = utf8_decode($corpoEmail);
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->SMTPDebug = false;    // Debugar: 1 = erros e mensagens, 2 = mensagens apenas 

try {
     $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
     $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
     $mail->SMTPSecure = 'ssl';  //para gmail
     $mail->Port       = 465; //  Usar 587 porta SMTP
     $mail->Username = 'dapl.imac@gmail.com'; // Usuário do servidor SMTP (endereço de email)
     $mail->Password = 'IMAC##2022'; // Senha do servidor SMTP (senha do email usado)
 
     //Define o remetente
     // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
     $mail->SetFrom('dapl.imac@gmail.com', 'Portal IMAC - Divis&atilde;o de Atendimento e Processos'); //Seu e-mail
     $mail->AddReplyTo('dapl.imac@gmail.com', 'Portal IMAC - Divis&atilde;o de Atendimento e Processos'); //Seu e-mail
     $mail->Subject = utf8_decode('Registro de Denúncia!');//Assunto do e-mail
 
     //Define os destinatário(s)
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     $mail->AddAddress($email, 'Registro de Denúncia!');
     $mail->AddBCC('portal.imac@ac.gov.br', 'WebSite IMAC Registro de Denúncia!'); // Cópia Oculta
     // $mail->AddBCC('ivan.silva@ac.gov.br', 'WebSite IMAC Registro de Denúncia!'); // Cópia Oculta

     //Campos abaixo são opcionais 
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     //$mail->AddCC('no-reply@lemonagencia.com', 'Lemon'); // Copia
     //$mail->AddBCC('no-reply@lemonagencia.com', 'Copia - Administrador Lemon'); // Cópia Oculta
 
     //Define o corpo do email
     $mail->MsgHTML($corpoEmail); 

     //anexar docs
     if ($anexo=="SIM") {
     	$mail->AddAttachment($arquivo['tmp_name'], $arquivo['name']);
     }
   
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     //$mail->Send();    
     // echo "Mensagem enviada com sucesso</p>\n";

     //verifica se enviou com sucesso!
      if(!$mail->Send()) {
	   echo "Erro: " . $mail->ErrorInfo;
	  } else {
	   header('Location:'.$redireciona.'');
	   echo "<script>document.location='sucesso.php?'</script>";
	  }

    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer

	}

}


?>