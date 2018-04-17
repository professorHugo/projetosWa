<?php
  include("../admin/config/conn.php");
  include("../admin/config/functions.php");
  include('../admin/PHPMailer/class.phpmailer.php');

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $celular = $_POST['celular'];
  $mensagem = $_POST['mensagem'];

  if($_POST['nome'] == ""){
    Erro("Campo Nome é obrigatório.");
  }

  if($_POST['email'] == ""){
    Erro("Campo E-mail é obrigatório.");
  }else if(!ValidaEmail($_POST['email'])){
    Erro("Campo E-mail é inválido.");
  }

  if($_POST['telefone'] == ""){
    Erro("Campo Telefone é obrigatório.");
  }

  if($_POST['mensagem'] == ""){
    Erro("Campo Mensagem é obrigatório.");
  }

  $corpo_email = ' <html>
                    <head>
                      <meta charset="utf-8">
                      <title>Template de E-mail</title>
                      <style media="screen">
                        body {
                          font-family: sans-serif;
                          font-size: 16px;
                        }
                        .container {
                          width: 50%;
                          margin-left: 2em;
                        }
                        h2 {
                          text-align: center;
                        }
                        p {
                          margin-top: 20px;
                        }
                        .label {
                          font-weight: bold;
                          margin-bottom: 4px;
                        }
                        .message {
                          width: 100%;
                        }
                      </style>
                    </head>
                    <body>
                      <div class="container">
                        <h2>Formulário de contato</h2>
                        <p>
                          <span class="label">Nome:</span>
                           '.$nome.'
                        </p>
                        <p>
                          <span class="label">E-mail:</span>
                           '.$email.'
                        </p>
                        <p>
                          <span class="label">Telefone:</span>
                           '.$telefone.'
                        </p>
                        <p>
                          <span class="label">Celular:</span>
                           '.$celular.'
                        </p>
                        <p class="message">
                          <div class="label">Mensagem:</div>
                          '.$mensagem.'
                        </p>
                      </div>
                    </body>
                  </html>';
  $mail = new PHPMailer();

  $mail->IsSMTP();
  $mail->Host = 'smtp.bitpix.com.br';
  $mail->Sender = 'mailer@bitpix.com.br';
  $mail->SMTPAuth = true;
  $mail->Port = 587;
  $mail->Username = 'mailer@bitpix.com.br';
  $mail->Password = 'Bitpix22445';

  $mail->From = $email;
  $mail->FromName = $nome;

  $mail->AddAddress('contato@campovel.com.br', 'Contato Campovel');
  $mail->AddAddress('nei.campos@hotmail.com', 'Contato Campovel');
  $mail->addCustomHeader("BCC: adriano@bitpix.com.br");

  $mail->IsHTML(true);
  $mail->CharSet='UTF-8';

  $mail->Subject = "Novo e-mail de ".$nome.", ".$email;
  $mail->Body = $corpo_email;
  $mail->AltBody = $corpo_email;

  $enviado = $mail->Send();

  $mail->ClearAllRecipients();
  $mail->ClearAttachments();

  if($enviado) {
    // echo "<div class='alert alert-success container' role='alert' style='margin-bottom:-30px;margin-top:1rem;max-width:100%;'>
    //         <button type='button' class='close' data-dismiss='alert'>&times;</button>
    //         Mensagem enviada com sucesso!
    //       </div>";
    echo 1;
  } else {
    // echo "<div class='alert alert-danger container' role='alert' style='margin-bottom:-30px;margin-top:1rem;max-width:100%;'>
    //         <button type='button' class='close' data-dismiss='alert'>&times;</button>
    //         Não foi possível enviar a mensagem.
    //       </div>";
    echo 0;
  }
?>
