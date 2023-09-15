function getAjaxRequest(){
  
    try{
        //Non IE Browser
        var request =  new XMLHttpRequest()
    }catch(e1){
        try{
        request = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e2){
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(e3){
                request = false;
            }
        }
    }
    return request;
}

function suma(a,b){
    document.getElementById('webPlace').innerHTML=(a+b)
}

function sendRequest(url){

    req = new getAjaxRequest()

    if(!req){
        document.getElementById("webPlace").innerHTML="No Ajax support!"
    }

    final_url="url_get.php?url="+url
    req.open("GET", final_url, true)

    req.onreadystatechange= function(){
        if(this.readyState == 4){
            if(this.status == 200){
                if(this.responseText != null){
                    document.getElementById("webPlace").innerHTML=this.responseText
                }else{
                    document.getElementById("webPlace").innerHTML="Ajax error! No data returned!";
                }
            }else{
                document.getElementById("webPlace").innerHTML="Ajax error! " + this.statusText
            }
        }
    }

    req.send(null)

}