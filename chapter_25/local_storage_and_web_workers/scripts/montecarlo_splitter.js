//Small Web worker script to generate a very inefficient version of arithmetic division (the program itself uses the division operator, making the implementation
//rather circular and meaningless). However, it does demonstrate a basic fact of statistics which is that the mean of a uniform distribution is the center
//of its range. It works by using the Math.random generator to generate a uniform distribution between 0 and 1, and then scaling it by a factor which increases 
//by one unit on each of the calculated values. The values of this distribution are then summed and the result is divided by the number of observation,
//which is the definition of the mean value of a set. The result is send to the parent script which instantiated the worker, the
//local_storage web page.

function calculateSplit(){

    let currValue = 1;

    while(true){

        //accumulator to store the sum of the distribution
        let accum = 0;
        //Number of observations of the distribution in the current loop
        let num_observations = 0;

        //Variable to store the resulting mean
        var montecarloSplit = 0;

        //Generate a distribution using the random function until reaching an upper limit, to avoid overflowing and to avoid looping undefinitely.
        while(num_observations < 10000000 && accum < 100000000){

            accum +=  Math.random() * currValue;
            num_observations++;
            montecarloSplit = accum / num_observations;

        }

        //We use the postMessage of the worker to send a message to itself. This generates an event that its processed using a callback defined in the main web site
        //that uses this script
        postMessage(`Number: ${currValue}| Split: ${montecarloSplit}`);
        currValue++;
    }


}

//Call to the function which calculates the "montecarlo split". It encapsulates the main logic of the split, which will be useful in case we want to add 
//other calculations or processes to the script as to keep all its elements organized and decoupled.
calculateSplit();

