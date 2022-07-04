<?php
session_start();
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
if(isset($_GET['loadCont'])){
    $stmt = $conn->prepare("SELECT * FROM contacts");
    $stmt->execute();
    $count = $stmt->rowCount();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '
        <tr class="rowDataCont">
          <td class="idDataCont">'.$row['id'].'</td>
          <td class="fnDataCont">'.$row['first_name'].'</td>
          <td class="mnDataCont">'.$row['middle_name'].'</td>
          <td class="lnDataCont">'.$row['last_name'].'</td>
          <td class="posDataCont">'.$row['position'].'</td>
          <td class="civDataCont">'.$row['civ_status'].'</td>
          <td class="gendDataCont">'.$row['gender'].'</td>
          <td class="contNoDataCont">'.$row['contact_no'].'</td>
          <td class="bdateDataCont">'.$row['bdate'].'</td>
          <td class="dateHDataCont">'.$row['date_hired'].'</td>
          <td class="sssDataCont">'.$row['sss'].'</td>
          <td class="phlhDataCont">'.$row['philhealth'].'</td>
          <td class="pagIDataCont">'.$row['pagibig'].'</td>
          <td class="tinDataCont">'.$row['tin'].'</td>
          <td>
            <button class="btn btn-primary editBtnCont">Edit</button>
            <button class="btn btn-success viewBtnCont" value='.$row['id'].'>View</button>
            <button class="btn btn-danger delToggleCont" value='.$row['id'].'>Delete</button>
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
if(isset($_GET['pos'])){
    $posData = strtoupper($_GET['posInp']);
    $stmt = $conn->prepare("INSERT INTO position (position) VALUES (:position)");
    $stmt->execute(['position' => $posData]);
    echo $posData;
}
if(isset($_GET['loadPos'])){
    $stmt = $conn->prepare("SELECT * FROM position");
    $stmt->execute();
    $count = $stmt->rowCount();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '
        <tr class="rowDataPos">
            <td class="posRowDataId">'.$row['id'].'</td>
          <td class="posRowData">'.$row['position'].'</td>
          <td>
            <button class="btn btn-primary editPosBtn">Edit</button>
            <button class="btn btn-danger delPosToggle" value='.$row['id'].'>Delete</button>
          </td>  
        </tr>
        ';
    }
}
if(isset($_GET['delPos'])){
    $idPos = $_GET['idPos'];
    echo $idPos;
    $stmt = $conn->prepare("DELETE FROM position WHERE id= :id");
    $stmt->execute(['id' => $idPos]);
}
if(isset($_GET['delCont'])){
    $idCont = $_GET['idCont'];
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id= :id");
    $stmt->execute(['id' => $idCont]);
}
if(isset($_GET['editPos'])){
    $idPos = $_GET['idPos'];
    $posE = strtoupper($_GET['posE']);
    $stmt = $conn->prepare("UPDATE position SET position = :position WHERE id = :id");
    $stmt->execute(['position' => $posE, 'id' => $idPos]);
    echo $posE;
}
if(isset($_POST['firstNameContE'])){
    $idCont = $_POST['idEdit'];
    $fn = strtoupper($_POST['firstNameContE']);
    $mn = strtoupper($_POST['middleNameContE']);
    $ln = strtoupper($_POST['lastNameContE']);
    $pos = strtoupper($_POST['position']);
    $civ = strtoupper($_POST['occu']);
    $gend = strtoupper($_POST['gend']);
    $contNo = strtoupper($_POST['contNoE']);
    $bdate = strtoupper($_POST['bDateE']);
    $dateH = strtoupper($_POST['dateHiredE']);
    $sss = strtoupper($_POST['sssE']);
    $phlh = strtoupper($_POST['phlhE']);
    $pagI = strtoupper($_POST['pagIE']);
    $tin = strtoupper($_POST['tinE']);
    $imagePicture = $_FILES['imageContE']['name'];
    move_uploaded_file($_FILES['imageContE']['tmp_name'], "image/".$_FILES['imageContE']['name']);
    $img = "image/".$_FILES['imageContE']['name'];

    $stmt = $conn->prepare("UPDATE contacts SET first_name = :fn, middle_name = :mn, last_name = :ln, position = :pos, civ_status = :civ, gender = :gend, contact_no = :contNo, bdate = :bdate, date_hired = :dateH, sss = :sss, philhealth = :phlh, pagibig = :pagI, tin = :tin, picture = :imagePicture WHERE id = :idCont");
    $stmt->execute(['idCont' => $idCont, 'fn' => $fn, 'mn' => $mn, 'ln' => $ln, 'pos' => $pos, 'civ' => $civ, 'gend' => $gend, 'contNo' => $contNo, 'bdate' => $bdate, 'dateH' => $dateH, 'sss' => $sss, 'phlh' => $phlh,'pagI' => $pagI, 'tin' => $tin, 'imagePicture' => $img]);
    
}
if(isset($_GET['posOpt'])){
    $stmt = $conn->prepare("SELECT * FROM position");
    $stmt->execute();
    $count = $stmt->rowCount();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '
        <option value="'.$row['position'].'">'.$row['position'].'</option>
        ';
    }
}
if(isset($_POST['contIns'])){
    $contIns = $_POST['contIns'];
    $fn = strtoupper($_POST['fn']);
    $mn = strtoupper($_POST['mn']);
    $ln = strtoupper($_POST['ln']);
    $posCont = $_POST['posCont'];
    $occu = $_POST['occu'];
    $gend = $_POST['gend'];
    $contNo = $_POST['contNo'];
    $bDate = $_POST['bDate'];
    $dateHired = $_POST['dateHired'];
    $sss = $_POST['sss'];
    $phlh = $_POST['phlh'];
    $pagI = $_POST['pagI'];
    $tin = $_POST['tin'];

    $stmt = $conn->prepare("INSERT INTO contacts (first_name, middle_name, last_name, position, civ_status, gender, contact_no, bdate, date_hired, sss, philhealth, pagibig, tin) VALUES (:first_name, :middle_name, :last_name, :position, :civ_status, :gender, :contact_no, :bdate, :date_hired, :sss, :philhealth, :pagibig, :tin)");
    $stmt->execute(['first_name' => $fn, 'middle_name' => $mn, 'last_name' => $ln, 'position' => $posCont, 'civ_status' => $occu, 'gender' => $gend, 'contact_no' => $contNo, 'bdate' => $bDate, 'date_hired' => $dateHired, 'sss' => $sss, 'philhealth' => $phlh, 'pagibig' => $pagI, 'tin' => $tin]);
}
if(isset($_GET['showPic'])){
    $id = $_GET['idP'];
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row["picture"] == "image/"){
        echo '<h5 class="profilePic">No picture</h5>';
        
    }
    else{
        echo '<img class="profilePic" src="'.$row["picture"].'" style="width:100px;height:100px;"/>';
    }
    //echo $row["picture"];
}
if(isset($_FILES["excelUpload"])){
    move_uploaded_file($_FILES['excelUpload']['tmp_name'], "excel_files/".$_FILES['excelUpload']['name']);
    $excelFile = "excel_files/".$_FILES['excelUpload']['name'];
    $inputFileType = 'Xlsx';
    $inputFileName = $excelFile;
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    $reader->setReadDataOnly(false);
    $spreadsheet = $reader->load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();

    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    date_default_timezone_set('Asia/Manila');

    for ($row = 1; $row <= $highestRow; ++$row) { 
        if($sheet->getCell('C'.$row)->getValue() == true){
            $sheet->getCell('B'.$row)->setValue(date("m/d/Y h:i:s A"));
            $sheet->getCell('A'.$row)->setValue($_SESSION['username']);
        }   
    }
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save($inputFileName);
    $returnDateType =  \PhpOffice\PhpSpreadsheet\Calculation\Functions::RETURNDATE_EXCEL;
    $dateConv = \PhpOffice\PhpSpreadsheet\Calculation\Functions::setReturnDateType($returnDateType);
    for ($row = 1; $row <= $highestRow; ++$row) {    
        $values = array();
        for ($col = 'B'; $col <= $highestColumn; $col++) {
            array_push($values, $sheet->getCell($col . $row)->getFormattedValue());
        }  
        //$dateE = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($values[7]);
        echo " ";
        print_r($_SESSION['username']);
        //$stmt = $conn->prepare("INSERT INTO contacts (first_name, middle_name, last_name, position, civ_status, gender, contact_no, bdate, date_hired, sss, philhealth, pagibig, tin) VALUES (:first_name, :middle_name, :last_name, :position, :civ_status, :gender, :contact_no, :bdate, :date_hired, :sss, :philhealth, :pagibig, :tin)");
        //$stmt->execute(['first_name' => strtoupper($values[0]), 'middle_name' => strtoupper($values[1]), 'last_name' => strtoupper($values[2]), 'position' => strtoupper($values[3]), 'civ_status' => strtoupper($values[4]), 'gender' => strtoupper($values[5]), 'contact_no' => $values[6], 'bdate' => $values[7], 'date_hired' => $values[8], 'sss' => $values[9], 'philhealth' => $values[10], 'pagibig' => $values[11], 'tin' => $values[12]]);
    }

}
if(isset($_GET['viewExcelCont'])){
    $inputFileType = 'Xlsx';
    $inputFileName = 'excel_files/Book1.xlsx';
    //$spreadsheet = new Spreadsheet();
    /**  Create a new Reader of the type defined in $inputFileType  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Advise the Reader that we only want to load cell data  **/
    $reader->setReadDataOnly(true);
    /**  Load $inputFileName to a Spreadsheet Object  **/
    //$spreadsheet = $reader->load($inputFileName);
    //$cellValue = $spreadsheet->getActiveSheet()->getCell('A1')->getValue();
    //echo $cellValue;

    $spreadsheet = $reader->load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    $columnNm = 1;
    $columnNo = 1;
    date_default_timezone_set('Asia/Manila');

    /*while($sheet->getCell('B'.strval($columnNm))->getValue() == true){
        $sheet->getCell('A'.strval($columnNo))->setValue(date("m/d/Y h:i:s A"));
        $columnNo++;
        $columnNm++;
    }*/
    for ($row = 1; $row <= $highestRow; ++$row) { 
        if($sheet->getCell('B'.$row)->getValue() == true){
            $sheet->getCell('A'.$row)->setValue(date("m/d/Y h:i:s A"));
        }   
    }

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save($inputFileName);
}
if(isset($_POST['genExc'])){

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $stmt = $conn->prepare("SELECT * FROM contacts");
    $stmt->execute();
    $count = $stmt->rowCount();
    $inc = 1;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $sheet->setCellValue("A".$inc, $row['id']);
        $sheet->setCellValue("B".$inc, $row['first_name']);
        $sheet->setCellValue("C".$inc, $row['middle_name']);
        $sheet->setCellValue("D".$inc, $row['last_name']);
        $sheet->setCellValue("E".$inc, $row['position']);
        $sheet->setCellValue("F".$inc, $row['civ_status']);
        $sheet->setCellValue("G".$inc, $row['gender']);
        $sheet->setCellValue("H".$inc, $row['contact_no']);
        $sheet->setCellValue("I".$inc, $row['bdate']);
        $sheet->setCellValue("J".$inc, $row['date_hired']);
        $sheet->setCellValue("K".$inc, $row['sss']);
        $sheet->setCellValue("L".$inc, $row['philhealth']);
        $sheet->setCellValue("M".$inc, $row['pagibig']);
        $sheet->setCellValue("N".$inc, $row['tin']);
        $inc++;
    }
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save("excel_files/generated_contacts.xlsx");
}
?>