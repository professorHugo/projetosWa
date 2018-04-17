<?php
  include("../admin/config/conn.php");
  include("../admin/config/functions.php");

  $id = (int)$_GET['id'];
  $combustiveis = array(1=>"FLEX",2=>"GASOLINA",3=>"ÁLCOOL",4=>"DIESEL",5=>"GÁS NATURAL",6=>"ELÉTRICO");

  $dados = mysql_fetch_assoc(mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id WHERE v.id = $id"));

  if($dados) {
?>
  <style media="screen">
    .modalTable {
      margin: auto;
    }
    .modalTable td:first-child {
      text-align: right;
    }
    .modalTable td:last-child {
      text-align: left;
    }
    h4, h1 {
      font-weight: bold;
      margin-bottom: 1em;
      text-align: center;
    }
    .print {
      display: none;
    }
    .ficha_div {
      font-size: 1.5em;
      font-weight: bold;
      margin: auto;
      margin-bottom: 1em;
      text-align: center;
    }
  </style>

  <h1 class="remove"><?=mb_strtoupper($dados['marcaNome']." ".$dados['modeloNome']." ".$dados['versao'])?></h1>

  <div class="ficha_div remove">
    <span>Ano: </span>
    <span><?=$dados['anomod']?></span>
  </div>

  <div class="ficha_div remove">
    <span>Cor: </span>
    <span><?=$dados['cor']?></span>
  </div>

  <div class="ficha_div remove">
    <span><?=$combustiveis[$dados['combustivel']]?></span>
  </div>

  <div class="ficha_div remove">
    <span>Portas: </span>
    <span><?=$dados['portas']?></span>
  </div>

  <div class="ficha_div remove">
    <span>R$ <?=number_format($dados['preco'], 2, ',', '.')?></span>
  </div>

  <div class="ficha_div remove">
    <div>Opcionais: </div>
    <div class="opcionais"><?=str_replace(",", ", ", str_replace(" ,", ",", mb_strtoupper(trim($dados['acessorios']))))?></div>
  </div>

<?php } ?>
