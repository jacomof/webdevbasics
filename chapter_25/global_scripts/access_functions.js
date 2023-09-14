/*Auxiliary functions to quickly access the style property
of the elements of an HTML document*/


/*Returns a reference to the HTML element with the identifier 
contained in the argument obj.*/ 
function O(obj){
    if(typeof obj === "object")
        return obj
    else if(typeof obj === "string")
        return document.getElementById(obj)
    else
        throw new Error("Object argument is not the correct type.")
}

/*Returns a reference to the style property of the HTML
element with the name contained in the argument obj*/ 
function S(obj){
    return O(obj).style;
}

/*Returns an array with the style properties of the HTML
elements pertaining to the class with the name contained in the 
argument cls.*/
function C(cls){
    const bod = document.body;
    members = document.getElementsByClassName(cls) //Access all elements from the class name in cls
    styles = []
    for(elem of members)
        styles.push(elem.style)
    return styles
}