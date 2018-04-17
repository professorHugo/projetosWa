<?php
if (isset($_GET['get'])) {
    list($param1, $param2, $param3, $param4, $param5, $param6) = explode('/', $_GET['get']);
    $uri = explode('?', $_SERVER['REQUEST_URI']);
    if (isset($uri[1]) && $uri[1]) {
        parse_str($uri[1], $_GET);
    }
}

$base = 'http://www.campovel.com.br/';
$host = 'www.campovel.com.br';

switch ($param1) {
	case '':
		$include = 'home.php';
		$title = 'Campovel Automóveis';
		$keywords = "";
		$description= "";
	break;
	case 'atendimento':
		$include = 'atendimento.php';
		$title = 'Atendimento - Campovel Automóveis';
		$keywords = "";
		$description= "";
	break;
  case 'institucional':
		$include = 'institucional.php';
		$title = 'Institucional - Campovel Automóveis';
		$keywords = "";
		$description= "";
	break;
  case 'lojas':
		$include = 'lojas.php';
		$title = 'Lojas - Campovel Automóveis';
		$keywords = "";
		$description= "";
	break;
  case 'resultado-busca':
		$include = 'resultado-busca.php';
		$title = 'Resultado da Busca - Campovel Automóveis';
		$keywords = "";
		$description= "";
	break;
  case 'veiculo':
		$include = 'veiculo.php';
    if (isset($_GET['id'])) {
      $veiculo_id = (int)$_GET['id'];
      $_veiculo = mysql_fetch_assoc(mysql_query("SELECT v.*, md.nome AS modeloNome, mc.nome AS marcaNome FROM veiculos AS v INNER JOIN modelos AS md ON v.nome = md.id INNER JOIN marcas AS mc ON v.marca = mc.id WHERE v.id = $veiculo_id"));
      $title = $_veiculo['marcaNome'].' '.$_veiculo['modeloNome'].' '.$_veiculo['versao'];
      $description = $_veiculo['marcaNome'].' '.$_veiculo['modeloNome'].' '.$_veiculo['versao'];
    } else {
      $title = 'Veículo - Campovel Automóveis';
      $keywords = "";
      $description= "";
    }
	break;
  case 'veiculos':
		$include = 'veiculos.php';
		$title = 'Veículos - Campovel Automóveis';
		$keywords = "";
		$description= "";
	break;
  case 'estoque':
		$include = 'estoque.php';
		$title = 'Estoque de Veículos - Campovel Automóveis';
		$keywords = "";
		$description= "";
	break;
}
