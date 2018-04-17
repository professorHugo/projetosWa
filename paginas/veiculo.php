<?php /* VEICULOS.PHP FRONT END */ ?>
<?php
  if (!is_int($_GET['id'])) {
    $id = (int)$_GET['id'];
  }

  $veiculosDir = "./uploads/veiculos/";
  $veiculoQuery = "SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome, mc.id AS marcaId FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id WHERE v.id = $id";

  $veiculo = mysql_fetch_assoc(mysql_query($veiculoQuery));
  $veiculoArray = array(0=>$veiculo['id'], 1=>$veiculo['nome'], 2=>$veiculo['marca'], 4=>$veiculo['anomod'], 5=>$veiculo['preco'], 11=>$veiculo['loja'], 12=>$veiculo['usado']);
  // var_dump($veiculoArray);

  $combustiveis = array(1=>"FLEX",2=>"GASOLINA",3=>"ÁLCOOL",4=>"DIESEL",5=>"GÁS NATURAL",6=>"ELÉTRICO");
?>

<?php
//   if (isset($_POST['submitContato'])) {
//   /* DADOS DO INTERESSADO E MENSAGEM*/
//   $nome = $_POST['nome'];
//   $email = $_POST['email'];
//   $telefone = $_POST['telefone'];
//   $celular = $_POST['celular'];
//   $mensagem = $_POST['mensagem'];
//
//   /* DADOS DO VEICULO */
//   $veiculoId = $_POST['veiculoId'];
//   $veiculoNome = $_POST['veiculoNome'];
//   $veiculoMarca = $_POST['veiculoMarca'];
//   $veiculoPagina = $_POST['veiculoPagina'];
//
//   if($nome == ""){
//     Erro("Campo Nome é obrigatório.");
//   }
//
//   if($email == ""){
//     Erro("Campo E-mail é obrigatório.");
//   }else if(!ValidaEmail($_POST['email'])){
//     Erro("Campo E-mail é inválido.");
//   }
//
//   if($mensagem == ""){
//     Erro("Campo Mensagem é obrigatório.");
//   }
//
//   if($_POST['newsletter-checkbox']) {
//     $rs_news = mysql_query("SELECT email FROM newsletter WHERE email = '$email'");
//     if(mysql_num_rows($rs_news) == 0){
//       mysql_query("INSERT INTO newsletter(nome,email) VALUES('$nome','$email')");
//     }
//   }
//
//   if($_POST['whatsapp']) {
//     $prefereWhatsapp = "Prefere contato por Whatsapp.";
//   } else {
//     $prefereWhatsapp = "Não prefere contato por Whatsapp";
//   }
//
//   $corpo_email = '<!DOCTYPE html>
//                   <html>
//                     <head>
//                       <meta charset="utf-8">
//                       <title>Template de E-mail</title>
//                       <style media="screen">
//                         body {
//                           font-family: sans-serif;
//                           font-size: 16px;
//                         }
//                         .container {
//                           width: 50%;
//                           margin-left: 2em;
//                         }
//                         h2 {
//                           text-align: center;
//                         }
//                         p {
//                           margin-top: 20px;
//                         }
//                         .label {
//                           font-weight: bold;
//                           margin-bottom: 4px;
//                         }
//                         .message {
//                           width: 100%;
//                         }
//                       </style>
//                     </head>
//                     <body>
//                       <div class="container">
//                         <h2>Dados do Contato</h2>
//                         <p>
//                           <span class="label">Nome:</span>
//                            '.$nome.'
//                         </p>
//                         <p>
//                           <span class="label">E-mail:</span>
//                            '.$email.'
//                         </p>
//                         <p>
//                           <span class="label">Telefone:</span>
//                            '.$telefone.'
//                         </p>
//                         <p>
//                           <span class="label">Celular:</span>
//                            '.$celular.'
//                         </p>
//                         <p>
//                           <span class="label">Prefere whatsapp:</span>
//                           '.$prefereWhatsapp.'
//                         </p>
//                         <p class="message">
//                           <div class="label">Mensagem:</div>
//                           '.$mensagem.'
//                         </p>
//
//                         <h2>Dados do Veículo</h2>
//                         <p>
//                           <span class="label">ID:</span>
//                            '.$veiculoId.'
//                         </p>
//                         <p>
//                           <span class="label">Veículo:</span>
//                            '.$veiculoMarca." ".$veiculoNome.'
//                         </p>
//                         <p>
//                           <span class="label">Página:</span>
//                            '.$veiculoPagina.'
//                         </p>
//                       </div>
//                     </body>
//                   </html>';
//
//   $mail = new PHPMailer();
//
//   $mail->IsSMTP();
//   $mail->Host = 'smtp.bitpix.com.br';
//   $mail->Sender = 'mailer@bitpix.com.br';
//   $mail->SMTPAuth = true;
//   $mail->Port = 587;
//   $mail->Username = 'mailer@bitpix.com.br';
//   $mail->Password = 'Bitpix22445';
//
//   $mail->From = $email;
//   $mail->FromName = $nome;
//
//   $mail->AddAddress('matheus.luiz@bitpix.com.br', 'Matheus Luiz da Silva');
//
//   $mail->IsHTML(true);
//   $mail->CharSet='UTF-8';
//
//   $mail->Subject = "Novo contato de interesse sobre o veículo ".$veiculoMarca." ".$veiculoNome." ID No. ".$veiculoId;
//   $mail->Body = $corpo_email;
//   $mail->AltBody = $corpo_email;
//
//   $enviado = $mail->Send();
//
//   $mail->ClearAllRecipients();
//   $mail->ClearAttachments();
//
//   if($enviado) {
//     header('Location: ?id='.$veiculoId.'&enviado=1');
//     die();
//   } else {
//     header('Location: ?id='.$veiculoId.'&enviado=0');
//     die();
//   }
// }
?>

            <!-- </div>
        </div> -->
        <style media="screen">
          div.alert {
            display: none;
          }
        </style>
        <div class="CONTAINER">
            <div class="container carros">
                <h1><a style="color:inherit;" href="/veiculos/">Veículos</a><i class="fa fa-angle-right"></i> <a style="color:inherit;" href="/resultado-busca/?marca=<?=$veiculo['marcaId']?>&btnBuscar=1"><b><?=$veiculo['marcaNome']?></b></a><i class="fa fa-angle-right"></i><a style="color:inherit;" href="/veiculo/<?=formataURL($veiculo['marcaNome'])?>/<?=formataURL($veiculo['modeloNome']." ".$veiculo['versao'])?>/?id=<?=$veiculo['id']?>"><?=mb_strtoupper($veiculo['marcaNome']." ".$veiculo['modeloNome']." ".$veiculo['versao'])?></a></h1>
                <hr class="d_xs_none">
            </div>
        </div>

        <div class='alert alert-success container' role='alert'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          Mensagem enviada com sucesso!
        </div>

        <div class='alert alert-danger container' role='alert'>
          <button type='button' class='close' data-dismiss='alert'>&times;</button>
          Não foi possível enviar a mensagem.
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                  <?php
                    $fotos = array();
                    $fotosQuery = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id ORDER BY posicao ASC");

                    while ($foto = mysql_fetch_assoc($fotosQuery)) {
                      array_push($fotos, $foto);
                    }
                  ?>
                    <img src="<?php echo (isset($fotos[0]['imagem']) ? "{$veiculosDir}"."{$fotos[0]['imagem']}" : "img/sem-foto-lg.jpg")?>" alt="" class="img-responsive img-main">
                    <div class="row m_t_30" style="display:flex; flex-flow:row wrap;">
                      <?php for($i = 0; $i < sizeof($fotos); $i++) { ?>
                        <div class="col-xs-3"  style="margin-bottom:2em;">
                            <a href="<?=$fotos[$i]['id']?>" onclick="changeImg(<?=$i?>);return false;"><img <?php echo ($i == 0 ?  "style='border:2px solid #3e4095'" : ""); ?>src="<?=$veiculosDir.$fotos[$i]['imagem']?>" alt="Foto de <?=$veiculo['nome']?>" title="Foto de <?=$veiculo['nome']?>" class="img-responsive thumbs"></a>
                        </div>
                      <?php } ?>
                    </div>
                    </style>
                    <style media="screen">
                      body {
                        position: relative;
                      }
                      .img-main:hover {
                        /*transform: scale(1.2);*/
                      }
                    </style>
                    <script type="text/javascript">
                      var thumbs = document.getElementsByClassName('thumbs');
                      var prevThumbs = 0;

                      function changeImg(i) {
                        var imgMain = document.querySelector('.img-main');
                        var newSrc = thumbs[i].getAttribute('src');
                        imgMain.setAttribute('src', newSrc);
                        if (prevThumbs != i) {
                          thumbs[prevThumbs].setAttribute('style','border:0');
                        }
                        thumbs[i].setAttribute('style','border:2px solid #3e4095');
                        prevThumbs = i;
                      }
                    </script>
                </div>
                <div class="col-md-6">
                    <div class="title_car_sell m_md_t_30"><b><?=$veiculo['marcaNome']?> <?=$veiculo['modeloNome']." ".$veiculo['versao']?></b> - <?=$veiculo['anomod']?>
                        <span><?=$combustiveis[$veiculo['combustivel']]?> <?php if ($veiculo['portas'] != 0){ echo "- ".$veiculo['portas']." Portas"; }?></span>
                        <p><?=$veiculo['anofab']?> / <?=$veiculo['anomod']?></p>
                        <?php
                          if ($veiculo['placa'] != 'AAA-0000' && $veiculo['placa'] != '') {
                        ?>
                            <p>Final da Placa: <?=substr($veiculo['placa'], -1)?></p>
                        <?php } ?>
                        <p><?=$combustiveis[$veiculo['combustivel']]?></p>
                        <p><?=$veiculo['cor']?></p>
                        <h1 class="f_sm_size_30"><b>R$ <?=number_format($veiculo['preco'], 2, ',', '.')?></b></h1>
                        <?php if ($veiculo['km'] > 0): ?>
                        <p>Quilometragem: <?=$veiculo['km']?></p>
                        <?php endif; ?>
                        <p class="t_t_none"><b>Acessórios</b></p>
                        <p><?=str_replace(",", ", ", str_replace(" ,", ",", mb_strtoupper($veiculo['acessorios'])))?></p>
                        <ul class="list_contact car">
                          <?php
                            $unidade = $veiculo['loja'];
                            $lojasQuery = "SELECT * FROM lojas WHERE unidade = '$unidade'";
                            $loja = mysql_fetch_assoc(mysql_query($lojasQuery));
                          ?>
                            <li><a class="trans3"><i class="trans5 fa fa-phone"></i><b><span>Telefone da Loja</span><?=$loja['telefone']?></b></a></li>
                            <li><a class="trans3"><i class="trans5 fa fa-whatsapp"></i><b><span>Whatsapp da Loja</span> (15) 99639-9279</b></a></li>
                            <li style="display: none;"><a class="trans3"><b>(15) 99819-7732</b></a></li>
                            <li><a class="trans3"><i class="trans5 fa fa-map-marker"></i><b><span>Localização da loja</span><?=$loja['endereco']?>, <?=$loja['numero']?>, <?=$loja['cidade']?>-<?=$loja['uf']?> <?=$loja['cep']?></b></a></li>
                        </ul>
                    </div>
                    <h3 class="contato_interesse">Enviar Contato de interesse</h3>
                    <form name="contactForm" id="contact_form_car" action="ajax/send_mail_car.php" class="form-clean"  method="post">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <div class="col-sm-12">
                              <input type="text" class="form-control" name="nome" placeholder="*Nome:">
                              <input type="hidden" name="veiculoId" value="<?=$veiculo['id']?>">
                              <input type="hidden" name="veiculoNome" value="<?=$veiculo['modeloNome']." ".$veiculo['versao']?>">
                              <input type="hidden" name="veiculoMarca" value="<?=$veiculo['marcaNome']?>">
                              <?php
                                $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                              ?>
                              <input type="hidden" name="veiculoPagina" value="<?=$url?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-12">
                              <input type="email" class="form-control" name="email" placeholder="*E-mail:">
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input type="tel" class="form-control m_xs_t_10" name="telefone" placeholder="Telefone:">
                            </div>
                            <div class="col-sm-6">
                                <input type="tel" class="form-control m_xs_t_10" name="celular" placeholder="Celular:">
                            </div>
                        </div>
                        <textarea class="form-control" rows="5" name="mensagem" placeholder="Mensagem:"></textarea>
                      </div>
                      <div class="row">
                          <div class="col-md-4 col-xs-6">
                              <div>
                                  <div class="checkbox">
                                      <label class="checkbox_cars">
                                          <input type="checkbox" name="whatsapp" checked> <span>Prefiro contato <br />POR WHATSAPPP</span>
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-xs-6">
                              <div>
                                  <div class="checkbox">
                                      <label class="checkbox_cars">
                                          <input type="checkbox" name="newsletter-checkbox" checked> <span>Gostaria de <br />Receber notícias.</span>
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-xs-12">
                              <button type="submit" class="btn_search trans3 m_t_15">Enviar</button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        <?php /*?><div class="container">
            <div class="last_cars_add m_t_30">
                <h3>
                    ÚLTIMOS ADICIONADOS
                </h3>
                <!-- <a href="#">Ver mais <i class="fa fa-plus trans3"></i></a> -->
            </div>
            <hr class="d_xs_none">
            <div class="row m_b_50">
              <?php
                $veiculosDir = "./uploads/veiculos/";
                $destaques = array();
                $destaquesQuery = mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id ORDER BY v.id DESC LIMIT 0,4");

                while ($destaque = mysql_fetch_assoc($destaquesQuery)) {
                  array_push($destaques, $destaque);
                }

                foreach($destaques as $destaque) {
                  $id = $destaque['id'];
                  $fotosQuery = mysql_query("SELECT * FROM imagens WHERE id_referencia = $id AND posicao = 1");
                  $foto = mysql_fetch_assoc($fotosQuery);

                  if (mysql_num_rows($fotosQuery) <= 0) {
                    $src = "img/sem-foto.png";
                  } else {
                    $src = $veiculosDir.$foto['imagem'];
                  }
              ?>
                <div class="col-md-3">
                    <div class="box_car">
                        <a href="/veiculo/<?php echo formataURL($destaque['marcaNome']); ?>/<?php echo formataURL($destaque['modeloNome']." ".$destaque['versao']); ?>/?id=<?=$destaque['id']?>">
                        <style media="screen">
                          .pin_box_car {
                            height: 263px;
                            text-align: right;
                            display: flex;
                            flex-flow: column nowrap;
                            justify-content: center;
                            align-items: center;
                            width: 262.5px;
                          }
                          .pin_box_car img {
                            height: auto;
                          }
                        </style>
                            <div class="pin_box_car trans3">
                                <img src="<?=$src?>" alt="" class="img-responsive">
                                <span>Saiba <br /> Mais <i class="fa fa-plus"></i></span>
                            </div>
                            <span class="car_name"><?=$destaque['marcaNome']." ".$destaque['modeloNome']." ".$destaque['versao']?></span>
                            <h3>R$ <?=number_format($destaque['preco'],2,',','.')?></h3>
                            <span class="car_year"><?=$destaque['anofab']?> / <?=$destaque['anomod']?></span>
                            <div class="mask_box_car trans3"></div>
                        </a>
                    </div>
                </div>
              <?php } ?>
            </div>
        </div><?php */?>
