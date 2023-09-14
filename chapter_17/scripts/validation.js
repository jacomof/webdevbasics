/*Example script to validate the user input of a form*/

function validateForename(text){
    if(text=="")
        return "Forename field is empty!\n"
    else return "";
}

function validateSurname(text){
    if(text=="")
        return "Surname field is empty!\n"
    else return "";
}

function validateUsername(text){
    if(text=="")
        return "Username field is empty!\n"
    else if(!/[a-zA-Z0-9]+/.test(text))
        return "Username contains invalid characters!\n"
    return ""
}

function validatePassword(text){
    ret_msg = ""
    if(text=="")
        return "Password field is empty!\n"
    if(text.length < 5){
        ret_msg += "Yout password must have more than 5 characters!\n"
    }
    if(text.search(/[A-Z]/) < 0)
        ret_msg += "The password field is missing a uppercase letter!\n"
    if(text.search(/[a-z]/) < 0)
        ret_msg += "The password field is missing a lowercase letter!\n"
    if(text.search(/\d/) < 0)
        ret_msg += "The password field is missing a digit!\n"
    return ret_msg
}

function validateAge(text){
    if(text=="")
        return "Age field is empty!\n"
    else{
        //Function parseInt parses a string to an integer. If it fails it returns NaN
        age = parseInt(text)
        if(isNaN(age))
            return "The input inside of the age field isn't a number!\n"
        if(age < 0 || age>120)
            return "Age isn't inside the correct range!\n"
        return ""
    }
}

function validateEmail(text){
    if(text=="")
        return "Email field is empty!\n"
    if(/[^\w@.]/.test(text))
        return "Wrong character set used for the email!\n";
    if(text.search("@") == 0)
        return "Not a valid email. The @ character can't be the first character!\n";
    else if(text.search("@")<0)
        return "The email filed is missing the @ character!\n";
    else if(text.search(/\./) == 0)
        return "Not a valid email. The . character can't be the first character!\n";
    else if(text.search(/\./) < 0)
        return "The email field is missing the . character!\n"
    return ""   
}
