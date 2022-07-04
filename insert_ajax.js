document.getElementById('insBtn').addEventListener('click', insert);
document.getElementById('dshBtn').addEventListener('click', function() {
    window.location.href = 'dashboard.php';
});

function insert(){
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
    let insert = true;
    let params = "insert="+insert+"&fn="+fn+"&mn="+mn+"&ln="+ln+"&sufx="+sufx+"&pos="+pos+"&emply="+emply+"&client="+client+"&hub="+hub+"&acc_no="+acc_no+"&acc_nm="+acc_nm;
    let xhr = new XMLHttpRequest();
    fn.value = '';

    xhr.open('POST', 'process.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(this.responseText == "success"){
            document.getElementById('firstName').value = '';
            document.getElementById('middleName').value = '';
            document.getElementById('lastName').value = '';
            document.getElementById('suffix').value = '';
            document.getElementById('position').value = '';
            document.getElementById('employment').value = '';
            document.getElementById('client').value = '';
            document.getElementById('hub').value = '';
            document.getElementById('accNo').value = '';
            document.getElementById('accName').value = '';
        }
    }
    
    xhr.send(params);
}