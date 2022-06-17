<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

$mail = new PHPMailer(true);

$conn = new PDO("mysql:host=localhost;dbname=first_mile", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $conn = mysqli_connect('localhost', 'root', '', 'first_mile');
    $null = !empty($intLat) ? "'$intLat'" : "NULL";
    $query = 'SELECT * FROM riders WHERE id ='.$id;
    $result = mysqli_query($conn, $query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($users);
}
if(isset($_POST['regRedirect'])){
    header('Location: register.php');
}
if(isset($_POST['register'])){  
    $username = $_POST['regUsername'];
    $password = $_POST['regPassword'];
    $cpassword = $_POST['cPassword'];
    $email = $_POST['email'];
    $fn = strtoupper($_POST['fn']);
    $mn = strtoupper($_POST['mn']);
    $ln = strtoupper($_POST['ln']);
    $sufx = strtoupper($_POST['sufx']);
    $pos = strtoupper($_POST['pos']);
    $emply = strtoupper($_POST['emply']);
    $client = strtoupper($_POST['client']);
    $hub = strtoupper($_POST['hub']);
    $acc_no = strtoupper($_POST['acc_no']);
    $acc_nm = strtoupper($_POST['acc_nm']);

    $stmt = $conn->prepare("SELECT * FROM riders WHERE username= :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $_SESSION['otp'] = 0;
    if($stmt->rowCount() > 0){
        echo "failed_username";
    }
    else{
        if($cpassword !== $password){
            echo "failed password";
        }
        else{
            $_SESSION['otp'] = rand(000000, 999999);
            /*$mail->SMTPDebug = 2;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Host = "mail.placer8developer.com";
            $mail->Username = "testmail@placer8developer.com";                 
            $mail->Password = "testmail.placer8developer";                                                       
            $mail->From = "testmail@placer8developer.com";
            $mail->FromName = "OTP";

            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Subject Text";
            $mail->Body = "<h1>".$_SESSION['otp']."</h1>";
            $mail->AltBody = "This is the plain text version of the email content";
               
            $mail->send();*/
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $_SESSION['fn'] =  $fn;
            $_SESSION['mn'] = $mn;
            $_SESSION['ln'] = $ln;
            $_SESSION['sufx'] = $sufx;
            $_SESSION['pos'] = $pos;
            $_SESSION['emply'] = $emply;
            $_SESSION['client'] = $client;
            $_SESSION['hub'] = $hub;
            $_SESSION['acc_no'] = $acc_no;
            $_SESSION['acc_nm'] = $acc_nm;
            echo $_SESSION['otp'];
        }  
    }
}
if(isset($_POST['otpSub'])){
    $otp = $_POST['otp'];

    if($otp == $_SESSION['otp']){
        try{
            $stmt = $conn->prepare("INSERT INTO riders (username, password,email, last_name, first_name, middle_name, suffix, position, employment, client, hub, account_no, account_name) VALUES (:username, :password, :email, :last_name, :first_name, :middle_name, :suffix, :position, :employment, :client, :hub, :account_no, :account_name)");
            $pass = md5($_SESSION['password']);
            $stmt->execute(['username' => $_SESSION['username'], 'password' => $pass, 'email' => $_SESSION['email'], 'last_name' => $_SESSION['ln'], 'first_name' => $_SESSION['fn'], 'middle_name' => $_SESSION['mn'], 'suffix' => $_SESSION['sufx'], 'position' => $_SESSION['pos'], 'employment' => $_SESSION['emply'], 'client' => $_SESSION['client'], 'hub' => $_SESSION['hub'], 'account_no' => $_SESSION['acc_no'], 'account_name' => $_SESSION['acc_nm']]);
            session_unset();
            header("location: login.php");  
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }  
    }
    else{
        header("location: register.php?error_otp_".$_SESSION['otp']); 
    }
    
}
if(isset($_POST['login'])){
    $stmt = $conn->prepare("SELECT * FROM admin_tbl WHERE username= :username AND password= :password");
    $stmt->execute(['username' => $_POST['username'], 'password' => $_POST['password']]);
    if($stmt->rowCount() > 0){
        $_SESSION['username'] = $_POST['username'];
        header("location: dashboard.php");
    }
    else{
        header("location: login.php?error_login?".$pass);
    }
}
if(isset($_POST['insert'])){
    echo "success";
    $fn = strtoupper($_POST['fn']);
    $mn = strtoupper($_POST['mn']);
    $ln = strtoupper($_POST['ln']);
    $sufx = strtoupper($_POST['sufx']);
    $pos = strtoupper($_POST['pos']);
    $emply = strtoupper($_POST['emply']);
    $client = strtoupper($_POST['client']);
    $hub = strtoupper($_POST['hub']);
    $acc_no = strtoupper($_POST['acc_no']);
    $acc_nm = strtoupper($_POST['acc_nm']);
    $stmt = $conn->prepare("INSERT INTO riders (last_name, first_name, middle_name, suffix, position, employment, client, hub, account_no, account_name) VALUES (:last_name, :first_name, :middle_name, :suffix, :position, :employment, :client, :hub, :account_no, :account_name)");
    $stmt->execute(['last_name' => $ln, 'first_name' => $fn, 'middle_name' => $mn, 'suffix' => $sufx, 'position' => $pos, 'employment' => $emply, 'client' => $client, 'hub' => $hub, 'account_no' => $acc_no, 'account_name' => $acc_nm]);
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    echo $id;
    $stmt = $conn->prepare("DELETE FROM riders WHERE id= :id");
    $stmt->execute(['id' => $id]);
}
if(isset($_GET['load'])){
    $stmt = $conn->prepare("SELECT * FROM riders");
    $stmt->execute();
    $count = $stmt->rowCount();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '
        <tr class="rowData">
          <td class="idData">'.$row['id'].'</td>
          <td class="fnData">'.$row['first_name'].'</td>
          <td class="mnData">'.$row['middle_name'].'</td>
          <td class="lnData">'.$row['last_name'].'</td>
          <td>'.$row['email'].'</td>
          <td>'.$row['password'].'</td>
          <td>
            <button class="btn btn-primary editBtn">Edit</button>
            <button class="btn btn-danger delToggle" value='.$row['id'].'>Delete</button>
          </td>  
        </tr>
        ';
    }
}
if(isset($_GET['edit'])){
    $id = $_GET['ids'];
    $fn = $_GET['fn'];
    $mn = $_GET['mn'];
    $ln = $_GET['ln'];
    $stmt = $conn->prepare("UPDATE riders SET first_name = :firstname, middle_name = :middlename, last_name = :lastname WHERE id = :id");
    $stmt->execute(['firstname' => $fn, 'middlename' => $mn, 'lastname' => $ln, 'id' => $id]);
    echo $_GET['fn'], $_GET['mn'], $_GET['ln'];
}

?>