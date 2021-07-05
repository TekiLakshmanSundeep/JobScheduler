document.onreadystatechange = () => {
    if(document.readyState == 'complete') {
        console.log('Document loaded successfully');
        setInterval(() => {
        getPHPData();
        }, 10000)
    }
}

function getPHPData() {
    var req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if(req.readyState === XMLHttpRequest.DONE) {
            if(req.status == "200") {
                console.log(req.responseText)
            } else {
                console.log('some error occured')
                
            }
            document.getElementById('result').innerText = req.responseText;
        } 
    }
    req.open('GET', './index.php');
    req.send();
}