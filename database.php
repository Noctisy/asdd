<!-- Yusa Celiker -->
<?php

// $host = '127.0.0.1';
// $db   = 'drempel';
// $user = 'root';
// $pass = '';
// $charset = 'utf8mb4';

//class database aan gemaakt
class database{
  // class met allemaal private variables aangemaakt (property)
  private $host;
  private $database;
  private $user;
  private $pass;
  private $charset;
  private $pdo;

  const ADMIN = 1; // moet overeen komen met values in de db!
  const USER = 2;

  public function __construct($host, $user, $pass, $database, $charset){
    $this->host = $host;
    $this->user = $Gebruikersnaam;
    $this->pass = $Wachtwoord;
    $this->database = $database;
    $this->charset = $charset;

    try {
        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
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

  private function create_or_update_medewerker($voorletters, $voorvoegsels, $Achternaam, $Gebruikersnaam, $Wachtwoord){

    // try{
    //       // begin een database transaction
    //       $this->pdo->beginTransaction();
    //
    //       $medewerker_id = $this->create_or_update_medewerker($voorletters, $voorvoegsels, $Achternaam, $Gebruikersnaam, $Wachtwoord);
    //       $this->create_or_update_medewerker($voorletters, $voorvoegsels, $Achternaam, $Gebruikersnaam, $Wachtwoord);
    //             // commit
    //             $this->pdo->commit();
    //
    //             header("location:login.php");
    //             exit();
    //
    //           }catch(Exception $e){
    //             // undo db changes in geval van error
    //             $this->pdo->rollback();
    //             throw $e;
    //           }


    $query = "INSERT INTO account
          (id, voorletters, voorvoegsels, Achternaam, Gebruikersnaam, Wachtwoord)
          VALUES
          (NULL, :voorletters, :voorvoegsels, :Achternaam, :Gebruikersnaam, :Wachtwoord)";

    // prepared statement -> statement zit een statement object in (nog geen data!)
    $statement = $this->pdo->prepare($query);

    // password hashen
    //$hashed_password =  password_hash($Wachtwoord, PASSWORD_DEFAULT);

    // execute de statement (deze maakt de db changes)
    $statement->execute([
    'voorletters'=>$voorletters,
    'voorvoegsels'=>$voorvoegsels,
    'Achternaam'=>$Achternaam,
    'Gebruikersnaam'=>$Gebruikersnaam,
    'Wachtwoord'=>$hashed_password
  ]);

    // haalt de laatst toegevoegde id op uit de db
    $medewerker_id = $this->pdo->lastInsertId();
    return $medewerker_id;
  }


  private function create_or_update_artikel( $fabriek_id, $product, $type, $inkoopprijs, $verkooprprijs){
    // table person vullen
    $query = "INSERT INTO person
          (id, fabriek_id, product, type, inkoopprijs, verkooprprijs)
          VALUES
          (NULL, :fabriek_id, :product, :type, :inkoopprijs, :verkooprprijs)";

    // returned een statmenet object
    $statement = $this->pdo->prepare($query);

    // execute prepared statement
    $statement->execute([
    'fabriek_id'=>$fabriek_id,
    'product'=>$product,
    'type'=>$type,
    'inkoopprijs'=>$inkoopprijs,
    'verkooprprijs'=>$verkooprprijs,
  ]);
}

// public function create_or_update_user($uname, $fname, $mname, $lname, $pass, $email){
//
//     try{
//       // begin een database transaction
//       $this->pdo->beginTransaction();
//
//       $account_id = $this->create_or_update_account($uname, $email, $pass);
//
//       $this->create_or_update_persoon($fname, $mname, $lname, $account_id);
//
//       // commit
//       $this->pdo->commit();
//
//       header("location:login.php");
//       exit();
//
//     }catch(Exception $e){
//       // undo db changes in geval van error
//       $this->pdo->rollback();
//       throw $e;
//     }
//   }
// }

  public function authenticate_user($Gebruikersnaam, $Wachtwoord){
    // hoe logt te user in? email of username of allebei? = username
    // haal de user op uit account a.d.h.v. de username
    // als database match, dan haal je het password (query with pdo)
    // $hashed_password = password uit db (matchen met $pass)
    // alle alle data overeen komt, dan kun je redirecten naar een interface
    // stel geen match -> username and/or password incorrect message

    // echo hi $_SESSION['username']; htmlspecialchars()

    // maak een statement object op basis van de mysql query en sla deze op in $stmt
    $query = "SELECT Wachtwoord FROM medewerker WHERE Gebruikersnaam = :Gebruikersnaam";
    $stmt = $this->pdo->prepare($query);

    // prepared statement object will be executed.
    $stmt->execute(['Gebruikersnaam' => $Gebruikersnaam]); //-> araay
    $result = $stmt->fetch(); // returned een array

    // haalt de hashed password value op uit de db dataset
    // $hashed_password = $result['Wachtwoord'];

    $authenticated_user = false;

//$hashed_passwordpassword_verify
    if ($Gebruikersnaam && password_verify ($pass, $Wachtwoord)){
      $authenticated_user = true;
        header('location: welkom.php'); // todo: fixme, create page
        exit();
    } else {
        echo "invalid username and/or password";
    }

    if($authenticated_user){
      // include date in title of log file -> error_log_8_10_2020.txt
      error_log("datetime, ip address, username - has succesfully logged in",3, error_log.txt);// login datetime, ip address, usernameaction and whether its succesfull
    }else{
      error_log("Invalid login",3);
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
