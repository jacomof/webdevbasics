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

    params="url="+url
    req = new getAjaxRequest()

    if(!req){
        document.getElementById("webPlace").innerHTML="No Ajax support!"
    }

    req.open("POST", "url_xml.php", true)
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    req.setRequestHeader("Content-length", params.length)

    req.onreadystatechange= function(){
        if(this.readyState == 4){
            if(this.status == 200){
                if(this.responseXML != null){
                    output=""
                    titles = this.responseXML.getElementsByTagName("title")
                    for(tit of titles){
                        output+=tit.childNodes[0].nodeValue + " size is: " + tit.childNodes.length  + "<br>"
                    }
                    document.getElementById("webPlace").innerHTML=output
                }else{
                    document.getElementById("webPlace").innerHTML="Ajax error! No data recieved!<br>";
                }
            }else{
                document.getElementById("webPlace").innerHTML="Ajax error! " + this.statusText + "<br>";
            }
        }
    }

    req.send(params)

}