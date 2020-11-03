<!-- Yusa Celiker -->
<?php

class database{
  // class met allemaal private variables aangemaakt (property)
  private $host;
  private $db;
  private $user;
  private $pass;
  private $charset;
  private $pdo;

  const ADMIN = 1; // moet overeen komen met values in de db!
  const USER = 2;

  public function __construct($host, $user, $pass, $db, $charset){
    $this->host = $host;
    $this->user = $user;
    $this->pass = $pass;
    $this->charset = $charset;

    try {
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        echo $e->getMessage();
        throw $e;
        // throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
  }

  public function create_or_update_medewerker($voorletters, $voorvoegsels, $achternaam, $gebruikersnaam, $wachtwoord){
    echo 'party';
    $query = "INSERT INTO medewerker
          (id, voorletters, voorvoegsels, achternaam, gebruikersnaam, wachtwoord)
          VALUES
          (NULL, :voorletters, :voorvoegsels, :achternaam, :gebruikersnaam, :wachtwoord)";

    // prepared statement -> statement zit een statement object in (nog geen data!)
    $statement = $this->pdo->prepare($query);

    // password hashen
    $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

    // execute de statement (deze maakt de db changes)
    $statement->execute([
    'voorletters'=>$voorletters,
    'voorvoegsels'=>$voorvoegsels,
    'achternaam'=>$achternaam,
    'gebruikersnaam'=>$gebruikersnaam,
    'wachtwoord'=>$hash
  ]);

    // haalt de laatst toegevoegde id op uit de db
    $medewerker_id = $this->pdo->lastInsertId();
    return $medewerker_id;
  }



//   public function create_or_update_artikel( $fabriek_id, $product, $type, $inkoopprijs, $verkooprprijs){
//     // table person vullen
//     $query = "INSERT INTO person
//           (id, fabriek_id, product, type, inkoopprijs, verkooprprijs)
//           VALUES
//           (NULL, :fabriek_id, :product, :type, :inkoopprijs, :verkooprprijs)";
//
//     // returned een statmenet object
//     $statement = $this->pdo->prepare($query);
//
//     // execute prepared statement
//     $statement->execute([
//     'fabriek_id'=>$fabriek_id,
//     'product'=>$product,
//     'type'=>$type,
//     'inkoopprijs'=>$inkoopprijs,
//     'verkooprprijs'=>$verkooprprijs,
//   ]);
// }

  public function authenticate_user($gebruikersnaam, $wachtwoord){
    // hoe logt te user in? email of username of allebei? = username
    // haal de user op uit account a.d.h.v. de username
    // als database match, dan haal je het password (query with pdo)
    // $hashed_password = password uit db (matchen met $pass)
    // alle alle data overeen komt, dan kun je redirecten naar een interface
    // stel geen match -> username and/or password incorrect message

    // echo hi $_SESSION['username']; htmlspecialchars()

    // maak een statement object op basis van de mysql query en sla deze op in $stmt
    $query = "SELECT gebruikersnaam, wachtwoord FROM medewerker WHERE gebruikersnaam = :gebruikersnaam";
    $stmt = $this->pdo->prepare($query);

    // prepared statement object will be executed.
    $stmt->execute(['gebruikersnaam' => $gebruikersnaam]); //-> araay
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // returned een array

    // haalt de hashed password value op uit de db dataset
    // $hashed_password = $result['Wachtwoord'];
// print_r($result['wachtwoord']);
if(is_array($result) && count($result) > 0){ //fixme
  // //$hashed_passwordpassword_verify
  // // print_r( password_verify($wachtwoord, $result['wachtwoord']));
  //   echo $result['wachtwoord'];
  //       $hash = $result['wachtwoord'];
  //       var_dump(password_verify($wachtwoord, $hash));
  $hashed_password = $result['wachtwoord'];

  if(password_verify($wachtwoord, $hashed_password)){
    echo 'yay';
  }else{
    echo ' invalid';
  }
      // if ($gebruikersnaam && password_verify($wachtwoord, $hashed_password)){//&& password_verify($wachtwoord, $hash)
      //   echo 'bye';
      //   $authenticated_user = true;
      //
      //   session_start();
      //     // slaat userdata in sessie veriable
      //     $_SESSION['gebruikersnaam'] = $gebruikersnaam;
      //     $_SESSION['loggedin'] = true;
      //     header("location: welkom.php");
      //     exit();
      // } else {
      //     echo "invalid username and/or password";
      // }

      // if($authenticated_user){
      //   // include date in title of log file -> error_log_8_10_2020.txt
      //   error_log("datetime, ip address, username - has succesfully logged in",3, error_log.txt);// login datetime, ip address, usernameaction and whether its succesfull
      // }else{
      //   error_log("Invalid login",3);
      // }

}



  //   try{
  //     // begin een database transaction
  //     $this->pdo->beginTransaction();
  //
  //     $this->create_or_update_account($uname, $pass);
  //
  //     // commit
  //     $this->pdo->commit();
  //     exit();
  //
  //   }catch(Exception $e){
  //     // undo db changes in geval van error
  //     $this->pdo->rollback();
  //     throw $e;
  //
  // }
}
}
 ?>
