<?php

class Login
{
  /*Deklaracija  objekata kase pomocu kljucne reci private,tako da budu sakriveni od ostatka koda , ali da budu dostupni u metodama ( funkcijama) klase
  */

  
  private $_id;
  private $_username;
  private $_password;
  private $_passcript;

  private $_errors;
  private $_access;
  private $_login;
  private $_token;

  // Specijalna metoda konstruktor koja sluzi za podesavanje osobina objekta klase 
  public function __construct()
  {
  
    $this->_errors = array();
    $this->_login  = isset($_POST['login'])? 1 : 0;
    $this->_access = 0;
    @$this->_token  = $_POST['token'];

    @$this->_id       = 0;
    @$this->_username = ($this->_login)? $this->filter($_POST['username']) : $_SESSION['username'];
    @$this->_password = ($this->_login)? $this->filter($_POST['password']) : '';
    @$this->_passcript  = ($this->_login)? $this->salt_password($this->_password) : $_SESSION['password'];
  }

  public function isLoggedIn()
  {
    ($this->_login)? $this->verifyPost() : $this->verifySession();

    return $this->_access;
  }

  public function filter($var)
  {
    return (preg_replace('/[^a-zA-Z0-9]/','',$var));
  }

  public function verifyPost()
  {
    try
    {
      if(!$this->isTokenValid())
         throw new Exception('Invalid Form Submission');

      if(!$this->isDataValid())
         throw new Exception('Invalid Form Data');

      if(!$this->verifyDatabase())
         throw new Exception('Invalid Username/Password');

    $this->_access = 1;
    $this->registerSession();
    }
    catch(Exception $e)
    {
      $this->_errors[] = $e->getMessage();
    }
  }

  public function verifySession()
  {
    if($this->sessionExist() && $this->verifyDatabase())
       $this->_access = 1;
  }

  
  // Provera korisnika u bazi podataka
  public function verifyDatabase()
  {
    // parametri konekcije
   $host = 'localhost';
   $dbname = 'code_crew';
   $username = 'root';
   $password ='';  
   $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
      // PDO konekcija na bazu podataka
      $this->pdo = new PDO("mysql:host=$host;dbname=$dbname",$username, $password,$opt);
   
        // Kreiranje zasebnog pripremnog upitnog objekta 
      $stm=$this->pdo->prepare("SELECT id FROM users WHERE username =? AND password =?");
      $stm->execute(array($this->_username,$this->_passcript));

      // rezutat upita ,u ovom slucaju asocijativni niz 
      $login = $stm->fetchAll();
     
     if($login == true)
        {
        return true;
        } 
      else 
        { 
          return false;
        }

}


  // validacija unetih podataka kroz forme ( username i password )
  public function isDataValid()
  {
    //provera da li je u username sacinjen od slova i brojeva i da li mu je duzina izmedju 5 i 12 karaktera,slicno i za password
    return (preg_match('/^[a-zA-Z0-9]{5,12}$/',$this->_username) && preg_match('/^[a-zA-Z0-9]{5,20}$/',$this->_password))? 1 : 0;
  }



  public function isTokenValid()
  {
    return (!isset($_SESSION['token']) || $this->_token != $_SESSION['token'])? 0 : 1;
  }



  public function registerSession()
  {
    $_SESSION['ID'] = $this->_id;
    $_SESSION['username'] = $this->_username;
    $_SESSION['password'] = $this->_passcript;
  }


  // Metoda koja proverava postojanje sesije
  public function sessionExist()
  {
    return (isset($_SESSION['username']) && isset($_SESSION['password']))? 1 : 0;
  }



  public function showErrors()
  {
    $greska = $this->_errors;
    return $greska;
  }

   /* Metoda salt_password kriptuje sifru korisnika i tako kriptovanu je upisuje u bazu. U ovom slucaju ovu metodu koristimo da bih proverili sifru korisnika koji se loguje.
      Metoda koristi SHA1(Secure Hash Algorithm) i MD5(Message-Digest Algorithm) funkcije za kriptovanje 
  */
    public function salt_password($password){

    $salt = "CodeCrewTeamAlpha";
    $dodatak = "CeatedByAs";

    $new_pass = sha1($salt) . md5($password) . sha1($dodatak);

    return $new_pass;
  }


}
?>
