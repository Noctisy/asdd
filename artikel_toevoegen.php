<!-- Yusa Celiker -->
<?php

include 'database.php';
include 'helperfunctions.php';

if(isset($_POST['submit'])){

  // maak een array met alle name attributes
  $fields = [
    	"product",
      "type",
      "inkoopprijs",
      "verkooprprijs",
  ];

$obj = new HelperFunctions();
$no_error = $obj->has_provided_input_for_required_fields($fields);

  // in case of field values, proceed, execute insert
  if($no_error){
    $product = $_POST['product'];
    $type = $_POST['type'];
    $inkoopprijs = $_POST['inkoopprijs'];
    $verkooprprijs = $_POST['verkooprprijs'];

    $db = new database('localhost', 'root', '', 'drempel', 'utf8');
    $db->create_or_update_artikel($product, $type, $inkoopprijs, $verkooprprijs);
    }
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>artikel Registratie scherm</title>
  </head>

  <body>
  	<form method="post" action='artikel_toevoegen.php' method='post' accept-charset='UTF-8'>
      <fieldset >
        <legend>Artikel toevoegen</legend>
        <input type="text" name="product" placeholder="product" required/>
        <input type="text" name="type" placeholder="type"/>
      	<input type="text" name="inkoopprijs" placeholder="inkoopprijs"  required/>
      	<input type="text" name="verkooprprijs" placeholder="verkooprprijs" required/><br/>
        <input type="submit" name='submit' value"Sign up!"/>
      </fieldset>
    </form>
  </body>
</html>
