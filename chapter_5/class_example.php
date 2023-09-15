<?php
$u = new User("Sergi","1234");
print_r($u);
$u->save_user();
$sergi_pass = $u->get_password();
echo "Revealing Sergi's password: $sergi_pass <br>";
User::utility("Gatito");
$u->shitty_feature = 10;
echo "Awful idea by PHP devs: $u->shitty_feature";
echo "This user belongs to the species: " . User::SPECIES . "<br>";
$adm = new Admin("Carlos", "strong_p455w04d");
print_r($adm); echo "<br>";


class User{
    const SPECIES = "HUMAN";
    public $user_name;
    private $password;
    protected $role = "User";
     
    function __construct($name, $pass){
        $this->user_name= $name;
        $this->password = $pass;
    }
    
    function save_user(){
        echo "Replace with code to save a user!! <br>";
    }
    
    function get_password(){
        return $this->password;
    }
    
    static function utility($input){
        echo "Processing input: $input <br>";
    }
    
    static function get_species(){
        return self::SPECIES;
    }
    
   
    
    function __destruct(){
        
        echo "Oh no! I'm being deleted :( <br>";
        
    }
    
    function get_role(){
        return $this->role;
    }
    
    final function deleted(){
        echo "Can't do anything :(";
    }
}

class Admin extends User{
    function __construct($name, $pass){
        parent::__construct($name, $pass);
        $this->role = "Admin";
    }
    
    //Test code to see if overriding a final function causes an error. TLDR, it did :).
    /*function deleted(){
        echo "Should cause error";
    }*/
    
}