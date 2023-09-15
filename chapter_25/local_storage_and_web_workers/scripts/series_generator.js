//Script of a worker used to generated an arithmetic progression of whole numbers beginning with 0 and increment one unit at a time.

//Counter to keep track of the current value of the series.
var counter = 0;

//The setInterval function is used here to generate a new number every 3 seconds.
setInterval(generateNumber, 3000);

//On the function we simply increment the counter and send the value to the website which instantiated the worker.
function generateNumber(){

    postMessage(++counter);

}