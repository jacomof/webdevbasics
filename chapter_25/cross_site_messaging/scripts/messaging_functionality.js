//Function to send a message to the receiver defined in the iframe element of the website.
function sendCrossMessage(){

    //We fetch the iFrame element
    let receiver = document.getElementById('message-receiver');

    //We fetch the input area where the user inputted the message 
    let input_field = document.getElementById('message-input');
    //We access the window of the receiver through the contentWindow property of the iFrame element, and use the postMessage method which will 
    //trigger an event on the target site with the data (in string format) we pass as an argument to the function.
    receiver.contentWindow.postMessage(input_field.value, '*');

    //Finally we clear the textarea element
    input_field.value = '';
    let plh = O('placeholder');
    plh.innerHTML = 'Sending Message';

}

//Function to send a message when the enter key is pressed while writing a message on the textarea input element.
//It's called anytime we press a key on the textarea element.
function sendButtonKeyPressed(event){
    //The onkeydown event contains information about the keys being pressed. Among this the name of the key inside of the key property.
    if(event.key === 'Enter'){
        sendCrossMessage()
    }
}

function receiveCrossMessage(event){
    
    let plh = O('placeholder');
    plh.innerHTML = event.data;;
}

window.onmessage= receiveCrossMessage