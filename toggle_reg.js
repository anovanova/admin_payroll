document.getElementById('toggleBtn').addEventListener('click', toggleReg);
//document.getElementById('otpBtn').addEventListener('click', otpFunc);
$(document).on('submit',"#formReg", function(){
    event.preventDefault();
    $('#otpDiv').modal('show');
    let un = $('#RegUserName').val();
    let email = $('#Email').val();
    let password = $('#RegPassword').val();
    let cpassword = $('#CPassword').val();
    let fn = $('#firstName').val();
    let mn = $('#middleName').val();
    let ln = $('#lastName').val();
    let sufx = $('#suffix').val();
    let pos = $('#position').val();
    let emply = $('#employment').val();
    let client = $('#client').val();
    let hub = $('#hub').val();
    let acc_no = $('#accNo').val();
    let acc_nm = $('#accName').val();
    let register = true; 
    let otp = 0;
    let req = $.ajax({
        url: "process.php",
        method: "POST",
        data: {
            regUsername: un,
            regPassword: password,
            cPassword: cpassword,
            email: email,
            fn: fn,
            mn: mn,
            ln: ln,
            sufx: sufx,
            pos: pos,
            emply: emply,
            client: client,
            hub: hub,
            acc_no: acc_no,
            acc_nm: acc_nm,
            register: register
        },
        dataType: "html"
    });

    req.done(function(msg){
        console.log(msg);
    });
});
function toggleReg(){
    var pw = document.getElementById('RegPassword');
    var pwc = document.getElementById('CPassword');
    if(pw.type === "password"){
        pw.type = "text";
        pwc.type = "text";
    }
    else{
        pw.type = "password";
        pwc.type = "password";
    }
}
/*function otpFunc(){
    $('#otpDiv').modal('show');
    if(document.getElementById('otpDiv').hidden == true){
        let un = document.getElementById('RegUserName').value;
        let email = document.getElementById('Email').value;
        let password = document.getElementById('RegPassword').value;
        let cpassword = document.getElementById('CPassword').value;
        let fn = document.getElementById('firstName').value;
        let mn = document.getElementById('middleName').value;
        let ln = document.getElementById('lastName').value;
        let sufx = document.getElementById('suffix').value;
        let pos = document.getElementById('position').value;
        let emply = document.getElementById('employment').value;
        let client = document.getElementById('client').value;
        let hub = document.getElementById('hub').value;
        let acc_no = document.getElementById('accNo').value;
        let acc_nm = document.getElementById('accName').value;
        let register = true;
        let otp = 0;

        if (un == "" || email == "" || password == "" || cpassword == ""){
            console.log("blank");
        }
        else{
            let params = "register="+register+"&email="+email+"&regUsername="+un+"&regPassword="+password+"&cPassword="+cpassword+"&fn="+fn+"&mn="+mn+"&ln="+ln+"&sufx="+sufx+"&pos="+pos+"&emply="+emply+"&client="+client+"&hub="+hub+"&acc_no="+acc_no+"&acc_nm="+acc_nm;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'process.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function(){
                console.log(this.responseText);
            }

            xhr.send(params);
        }
        
    }
    else{
        document.getElementById('otpDiv').hidden = true;
    }
}*/
/*function blur(){
    document.getElementById('regForm').className = "container w-70 mx-auto grid place-content-center gap-2 mt-10";
    document.getElementById('header').className = "grid place-content-center p-5";
    document.getElementById('otpDiv').hidden = true;
}*/