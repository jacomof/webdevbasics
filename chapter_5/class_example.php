<?php
/*PHP script to showcase the syntax on how to define classes and instantiate/create objects.*/


//Here we create a new object of the class User, specified below, and access some of its attributes.
//We call the constructor, which is the funciton that's called when a new instance of a class is created.
$u = new User("Sergi","1234");

//print_r is a function that prints all the properties of any object or variable in php. It's very useful for debugging!
print_r($u);

//As you can see, to access an object's attributes and methods you specify you add an arrow ("->") next to the variable or expression containing
//it and the properties/method name.
$u->save_user();
$sergi_pass = $u->get_password();
echo "Revealing Sergi's password: $sergi_pass <br>";
User::utility("Gatito");
$u->feature = 10;

//Just a personal note, the idea of creating attributes of an object outside of the class definition seems like a bad idea,
//since it mixes specification with implementation and use.
echo "Awful idea by PHP devs: $u->feature.";
echo "This user belongs to the species: " . User::SPECIES . ".<br>";
echo "This species has population: " . User::$population . ".<br>";
$adm = new Admin("Carlos", "strong_p455w04d");
print_r($adm); echo "<br>";


//Class definition
class User{

    /*To add attributes to the class, you add them as any variable declaration. 
    Optionally, we can specify an access modifier:
        -public: these are variables that can be accessed directly by any part of a program. By default, all variables are public.
        -private: these are variables that can only be accessed within the class.
        -protected: these are variables that can only be accessed within the class, or on descendant classes.
    */    
    
    //We can specify constant within classes using the constant keywoard.
    //Constant are accessible with the ScopeResolutionOperator(::).
    const SPECIES = "HUMAN";
    public $user_name;
    private $password;
    protected $role = "User";
    
    //We can also declare static variables, which are variables that are the same for all members of a class.
    ////To access static functions we use the ScopeResolutionOperator(::).
    public static $population = 7000000000;
     
    //We define methods just as any other function. We can also specify an access modifier which behaves the same as in attributes.
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
    
    //We can declare static functions, which are functions that  are accessible without instantiating
    //the class. In other words, they're functions of the class itself rather than of the instances of the class. 
    //To access static functions we use the ScopeResolutionOperator(::).
    static function utility($input){
        echo "Processing input: $input <br>";
    }
    
    static function get_species(){
        //The self keyword allows you to reference an specific class within itself.
        return self::SPECIES;
    }
    
    //This is the destructor of the class. It's executed when the object is destroyed either at the end of the script or
    //when it's garbage collected after unsetting the variable containing it with unset  
    function __destruct(){
        
        echo "Oh no! I'm being deleted :( <br>";
        
    }
    

    function get_role(){
        return $this->role;
    }
    
    //Final functions can't be overload and are defined as below. Overloading means to redefine a function in a child class.
    final function deleted(){
        echo "Can't do anything :(";
    }
}

//PHP supports inheritance as well. We define inheritance by specifying a parent class with the extends keyword.
//It will inherit all properties and functions, which it may overload. It can also define new properties and functions. 
class Admin extends User{

    //Here we overload the constructor to add a new parameter, called role.
    function __construct($name, $pass){
        parent::__construct($name, $pass);
        $this->role = "Admin";
    }
    
    //Test code to see if overriding a final function causes an error. TLDR, it did :).
    /*function deleted(){
        echo "Should cause error";
    }*/
    
}