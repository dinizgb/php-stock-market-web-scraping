<?php
/*
	Project: PHP stock market web scraping
  	Author: Gabriel Diniz
  	Version: 1.0
*/
require_once( __DIR__ . '/simple_html_dom.php' );

$stock = file_get_html('https://br.advfn.com/mundo/brasil');

$ibov_value = $stock->find('span#quoteElementPiece1',0)->plaintext;
$ibov_index = $stock->find('span#quoteElementPiece2',0)->plaintext;
$ibov_format_value = $ibov_value . ' ' . $ibov_index;

$currencies = $stock->find('div#forex_pairs',0);
echo '<br>';
$dolar = $currencies->find('tr', 1)->plaintext;
$dolar_separated = explode("USD BRL", $dolar);
if(strpos($dolar_separated[1],"+") !== false){
    $dolar_value_separated = explode("+", $dolar_separated[1]);
    $dolar_format_value = $dolar_value_separated[0] . ' +' . $dolar_value_separated[1];
}
elseif(strpos($dolar_separated[1],"-") !== false){
    $dolar_value_separated = explode("-", $dolar_separated[1]);
    $dolar_format_value = $dolar_value_separated[0] . ' -' . $dolar_value_separated[1];
}

echo '<br>';

//EURO
$euro = $currencies->find('tr', 2)->plaintext;
$euro_separated = explode("EUR BRL", $euro);
if(strpos($euro_separated[1],"+") !== false){
    $euro_value_separated = explode("+", $euro_separated[1]);
    $euro_format_value = $euro_value_separated[0] . ' +' . $euro_value_separated[1];
}
elseif(strpos($euro_separated[1],"-") !== false){
    $euro_value_separated = explode("-", $euro_separated[1]);
    $euro_format_value = $euro_value_separated[0] . ' -' . $euro_value_separated[1];
}

//LIBRA
$gbp = $currencies->find('tr', 4)->plaintext;
$gbp_separated = explode("GBP BRL", $gbp);
if(strpos($gbp_separated[1],"+") !== false){
    $gbp_value_separated = explode("+", $gbp_separated[1]);
    $gbp_format_value = $gbp_value_separated[0] . ' +' . $gbp_value_separated[1];
}
elseif(strpos($gbp_separated[1],"-") !== false){
    $gbp_value_separated = explode("-", $gbp_separated[1]);
    $gbp_format_value = $gbp_value_separated[0] . ' -' . $gbp_value_separated[1];
}
?>

<html>
<head>
<style>
.flex-container {
  display: flex;
  background-color: #fff;
}

.flex-container > div {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
  margin: 0 10px;
  padding: 20px 0;
  flex: 1;
  text-align: center;
  font-size: 18px;
}
</style>
</head>
<body>
<h1>Stocks with PHP Simple HTML Parser</h1>

<div class="flex-container">
  <div>
  	Ibov<br>
    <?php echo $ibov_format_value; ?>
  </div>
  
  <div>
  	Dolar<br>
    <?php echo $dolar_format_value; ?>
  </div>
  
  <div>
  	Euro<br>
    <?php echo $euro_format_value; ?>
  </div>  
  
   <div>
  	GPB<br>
    <?php echo $gbp_format_value; ?>
  </div>
  
</div>

<p>Code by <a href="https://github.com/dinizgb">@dinizgb</a> .</p>

</body>
</html>