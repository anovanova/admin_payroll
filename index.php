<?php
session_start();
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="dist/output.css" rel="stylesheet">
    <title>First Mile</title>
</head>
<body class="bg-slate-900">
    <div class="grid place-content-center p-5">
        <h1 class="font-bold text-4xl text-white">First Mile</h1>    
    </div>
    <div>
        <form class="container mx-auto grid grid-cols-2 gap-6" action="process.php" method="post">
            <div class="grid gap-2 p-10 px-56">
                <div class="block">
                    <label class="block text-zinc-100 font-bold" for="id">ID:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="id" id="id">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="bscRate">Basic Rate:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="bscRate" id="bscRate">
                </div>

                <div>
                    <label class="block text-zinc-100 font-bold" for="dispRem">Dispute Remarks:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="despRem" id="despRem">
                </div>  
            </div>

            <div class="grid p-10 px-40">
                <div>
                    <div class="grid place-content-center p-5">
                        <h1 class="font-bold text-3xl text-white">DTR</h1>
                    </div>
                    <div>
                        <label class="block text-zinc-100 font-bold" for="daysWork">Days Worked:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="daysWork" id="daysWork">
                    </div>  
                </div>

                <div>
                    <div class="grid place-content-center p-5">
                        <h1 class="font-bold text-3xl text-white">Receipt Amount</h1>
                    </div>
                    <div>
                        <label class="block text-zinc-100 font-bold" for="orAmnt">OR Amount:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="orAmnt" id="orAmnt">
                    </div>
                </div>
            </div>

            <!--Earnings-->
            <div class="grid gap-2 p-10 py-40 px-40">
                <div class="grid place-content-center p-5">
                    <h1 class="font-bold text-3xl text-white">Earnings</h1>
                </div>
                <div>
                    <label class="block text-zinc-100 font-bold" for="ot">Overtime:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="ot" id="ot">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="regHol">Regular Holiday:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="regHol" id="regHol">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="specHol">Special Holiday:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="specHol" id="specHol">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="rdDuty">RD Duty:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="rdDuty" id="rdDuty">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="nightDiff">Night Diff:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="nightDiff" id="nightDiff">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="unwHol">Unwork Holiday:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="unwHol" id="unwHol">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="incen">Incentive:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="incen" id="incen">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="adj">Adjustment:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="adj" id="adj">
                </div>
                
                <div>
                    <label class="block text-zinc-100 font-bold" for="other">Others:</label>
                    <input class="w-full h-8 rounded-lg" type="text" name="other" id="other">
                </div>
            </div>
            
            <div class="p-10 px-56 grid gap-3">
                <div class="grid gap-2">
                    <div class="grid place-content-center p-5">
                        <h1 class="font-bold text-3xl text-white">SPX</h1>
                    </div>
                    <div>
                        <label class="block text-zinc-100 font-bold" for="spxTotSal">SPX Total Salary:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="spxTotSal" id="spxTotSal">
                    </div>

                    <div>
                        <label class="block text-zinc-100 font-bold" for="spxAllo">SPX Allowance:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="spxAllo" id="spxAllo">
                    </div>
                    
                    <div>
                        <label class="block text-zinc-100 font-bold" for="spxGrossPay">SPX Gross Pay:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="spxGrossPay" id="spxGrossPay">
                    </div>  
                </div>

                <div class="grid gap-2">
                    <div class="grid place-content-center p-5">
                        <h1 class="font-bold text-3xl text-white">Agency Deductions</h1>
                    </div>
                    <div>
                        <label class="block text-zinc-100 font-bold" for="sssPrem">SSS Premium:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="sssPrem" id="sssPrem">
                    </div>
                    
                    <div>
                        <label class="block text-zinc-100 font-bold" for="philHealth">Philhealth:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="philHealth" id="philHealth">
                    </div>
                    
                    <div>
                        <label class="block text-zinc-100 font-bold" for="sssLoans">SSS Loans:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="sssLoans" id="sssLoans">
                    </div>
                    
                    <div>
                        <label class="block text-zinc-100 font-bold" for="pagiLoans">Pagibig Loans:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="sssLoans" id="sssLoans">
                    </div>
                    
                    <div>
                        <label class="block text-zinc-100 font-bold" for="late">Late/Undertime:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="late" id="late">
                    </div>
                    
                    <div>
                        <label class="block text-zinc-100 font-bold" for="claim">Claims:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="claim" id="claim">
                    </div>
                    
                    <div>
                        <label class="block text-zinc-100 font-bold" for="over">Over:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="over" id="over">
                    </div> 
                </div>
                <div class="grid gap-2">
                    <div class="grid place-content-center p-5">
                        <h1 class="font-bold text-3xl text-white">For Accounting</h1>
                    </div>
                    <div>
                        <label class="block text-zinc-100 font-bold" for="bscPay">Basic Pay:</label>
                        <input class="w-full h-8 rounded-lg" type="text" name="bscPay" id="bscPay">
                    </div>
                </div>
            </div>
            <div class="grid place-content-center mb-10 col-span-2">
                <button class="bg-cyan-300 w-40 h-16 text-2xl font-bold rounded-2xl">Submit</button>
            </div>
   
        </form>

        <script src="script.js"></script>
    </div>
</body>
</html>
<?php
}
else{
    header("location: login.php");
}
?>