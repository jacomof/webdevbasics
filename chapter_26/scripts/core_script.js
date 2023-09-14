/*Configuration constants*/

TITLE_IMAGE_NAME = 'title-image';

/*Access function used in all previous exercises.*/

//Returns the element with the id contained in the string variable "element".
function O(element){

    if(typeof element === "object")
        return element;
    else
        return document.getElementById(element);

}

//Returns the style of the element with the id contained in the string variable "element".
function S(element){
    return O(element).style;
}

//Returns an array with all the elements with the class contained in "class_name".
function C(class_name){

    return document.getElementsByClassName("class_name");

}


//The rest of the codes creates the title of the 'platespace' website using the Canvas API. It's is included in all pages of the site.


//We load the image of a paw that will be included in the final title image.
titleImage = new Image();
titleImage.src = './images/paw.png';


titleImage.onload = 
    function()
    {
        //We use the Canvas API to draw text on the main canvas element of the site.
        let titleText = 'Pl  tespace';
        let titleCanvas = O(TITLE_IMAGE_NAME);
        let titleCtx = titleCanvas.getContext("2d");

        //We configure the text style (font family, size, weight, etc.)
        titleCtx.font = 'bold 90px Consolas';
        titleCtx.strokeStyle = 'black';
        titleCtx.fillStyle = 'rgb(170, 101, 11)';
        titleCtx.textBaseline = 'middle';
        titleCtx.textAlign = "center";

        //We draw the text on the Canvas
        titleCtx.fillText(titleText, 350, 45);
        titleCtx.strokeText(titleText, 350, 45);
        
        //We draw the paw image on its respective position
        titleCtx.drawImage(this, 227, 20, 48, 48);


    }


//Creates a new Ajax request object in the most browser compatible way. Necessary since older internet explorer browsers had a different name
//for the XMLHttpRequest class.
function getAjaxRequest(){

    newRequest = new XMLHttpRequest();

    //In case the constructor returns "undefined" we check for all the different classes that implement Ajax requests in older browsers.
    if(typeof newRequest ==="undefined"){
        try {
            return new ActiveXObject("Msxml2.XMLHTTP.6.0");
        }catch(e){}
        try{
            return new ActiveXObject("Msxml2.XMLHTTP.3.0");
        }catch(e){}
        try{
            return new ActiveXObject("Microsoft.XMLHTTP");
        }catch(e){}
        
        throw "Ajax requests not supported by browser"
    }
    else return newRequest;

}

//Checks for user existance in the database, and prevents upload if 
//through and ajax request ot the user_existance.php page.
//This page returns the text "true" if the user exists.

used_username = false;

function checkUserExistance(user){

    currRequest = getAjaxRequest();

    currRequest.onreadystatechange = () =>{
        if(currRequest.readyState == XMLHttpRequest.DONE){
            if(currRequest.status == 200){
                if(currRequest.responseText === "true"){
                    S('username-input').color = 'red';
                    alert("The user already exists!");
                    used_username = true;
                }else 
                    used_username=false;
            }
        }

    }

    currRequest.open('POST', 'user_existance.php');
    currRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    currRequest.send(`username=${user}`);

}

function changeUsernameInputColor(){
    S('username-input').color = 'black';
}