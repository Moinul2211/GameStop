<?php
require_once('../Models/user-info-model.php');
require_once('../Controllers/message-controller.php');
if (!isset($_COOKIE['flag'])) {
    popup("Error!", "You need to sign-in in order to access this page.");
}
$id = $_COOKIE['id'];
$row = UserInfo($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
<div class="first">
    <a href="../index.php"><img src="../Uploads/logo.png" alt="Logo"  width="120px" height="70px"></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="search.php"><button class="header-button">Search GameStop</button></a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
        if (!isset($_COOKIE['flag'])) {
            echo "<a href=\"Views/signin.html\">
                        <font color=\"white\" face=\"times new roman\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign In</font>
                    </a>";
        } else if ($row['role'] == "Manager") {
                echo "<img src=\"../{$row['profilepic']} \" width=\"40px\">&nbsp;&nbsp;&nbsp;
                    <select name=\"profile\" onchange=\"location = this.value;\">
                        <option disabled selected hidden> {$row['username']} </option>
                        <option value=\"user-profile.php\">Profile</option>
                        <option value=\"dashboard.php\">Dashboard</option>
                        <option value=\"sales-report.php\">Sales Report</option>
                        <option value=\"settings.php\">Settings</option>
                        <option value=\"logout-page.php\">Log Out</option>
                    </select>";
            } else if($row['role'] == "Business Client"){
                echo"<img src=\"../{$row['profilepic']}\" width=\"40px\">&nbsp;&nbsp;&nbsp;
                <select name=\"profile\" onchange=\"location = this.value;\">
                    <option disabled selected hidden>{$row['username']}</option>
                    <option value=\"../index.php\">Home Page</option>
                    <option value=\"user-profile.php\">Profile</option>
                    <option value=\"dashboard.php\">Dashboard</option>
                    <option value=\"sales-history.php\">Sales History</option>
                    <option value=\"settings.php\">Settings</option>
                    <option value=\"logout-page.php\">Log Out</option>
                </select>";
            }
        ?>
        
    </div>
    <div class="header"></div><br><br><br>
    <form action="../Controllers/change-password-controller.php" method="post">
        <table width="30%" border="1" cellspacing="0" cellpadding="25" align="center" bordercolor="#1B6392">
            <tr>
                <td>
                    <font color="#1B6392" face="times new roman" size="6">Create New Password</font>
                    <br><br>
                    <font color="black" face="times new roman" size="4">Enter Old Password</font>
                    <br>
                    <input type="password" name="oldpass" size="43px"><br><br>
                    <hr color="#1B6392" width="auto">
                    <br>
                    <font color="black" face="times new roman" size="4">New Password</font>
                    <br>
                    <input type="password" name="newpass" id="password" size="43px" onkeyup="checkPassword()">
                    <br>
                    <font color="red" face="times new roman" size="3" id="passwordError"></font><br>
                    <font color="black" face="times new roman" size="2"><i>i &nbsp;</i></font>
                    <font color="black" face="times new roman" size="2">Passwords must be at least 8 characters.</font>
                    <br><br>
                    <font color="black" face="times new roman" size="4">Re-enter New Password</font>
                    <br>
                    <input type="password" name="repass" id="repasswordField" size="43px" onkeyup="checkRepassword()">
                    <br>
                    <font color="red" face="times new roman" size="3" id="repasswordError"></font>
                    <br><br><br>
                    <input type="submit" name="submit" id="submitButton" value="Change Password">
                </td>
                <br>
            </tr>
        </table>
    </form>
    <br><br><br><br><br>
 
    <div class="footer">
            <center>
                <a href="about-us.php">
                    <font color="white" face="times new roman" size="4">About Us</font>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="helpline.php">
                    <font color="white" face="times new roman" size="4">Helpline</font>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="faq.php">
                    <font color="white" face="times new roman" size="4">FAQ</font>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="terms-and-services.php">
                    <font color="white" face="times new roman" size="4">Terms and Services</font>
                </a><br><br>
                <font color="white" face="times new roman" size="3">GameStop</font><br>
                <font color="white" face="times new roman" size="2">GameStop LTD Company</font><br>
                <font color="white" face="times new roman" size="1">© 2024 by GameStop.com, Inc.</font>
            </center>
    </div>
    <script>
        function checkFormValidity() {
            let password = document.getElementById('password').value;
            let repassword = document.getElementById('repasswordField').value;
            let passwordError = document.getElementById('passwordError').innerText;
            let repasswordError = document.getElementById('repasswordError').innerText;

            let submitButton = document.getElementById('submitButton');

            if (

                password === '' ||
                repassword === '' ||
                passwordError !== '' ||
                repasswordError !== '' ||
                password !== repassword
            ) {
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
        }


        function checkPassword() {
            let password = document.getElementById('password').value;

            if (password === '') {
                document.getElementById('passwordError').innerHTML = "Password cannot be empty.";
            } else if (password.length < 8) {
                document.getElementById('passwordError').innerHTML = "Password must be at least 8 characters long.";
            } else {
                document.getElementById('passwordError').innerHTML = "";
            }
            checkFormValidity();
        }

        function checkRepassword() {
            let password = document.getElementById('password').value;
            let repassword = document.getElementById('repasswordField').value;

            if (repassword !== password) {
                document.getElementById('repasswordError').innerHTML = "Passwords do not match.";
            } else {
                document.getElementById('repasswordError').innerHTML = "";
            }
            checkFormValidity()
        }
    </script>
</body>

</html>