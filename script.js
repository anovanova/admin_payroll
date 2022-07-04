//document.getElementById('id').addEventListener('input', getName);
//document.getElementById('toggle').addEventListener('click', toggle);
//document.getElementById('otpBtn').addEventListener('click', otpFunc, false);
function getName(e){
    e.preventDefault();
    let id = document.getElementById('id').value;
    let params = "id="+id;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'process.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        console.log(this.responseText);
    }

    xhr.send(params);
}
function toggle(){
    var pw = document.getElementById('password');
    if(pw.type === "password"){
        pw.type = "text";
    }
    else{
        pw.type = "password";
    }
}