<?php
$connection = mysqli_connect('localhost', 'root', '', 'woodmastery');
session_start();
if(isset($_POST['login'])){
    $email = $_POST["email"];
    $pasword = $_POST["pwd"];

    $quary = "SELECT * FROM users WHERE email = '$email' AND Pwd = '$pasword'";
    $result_set = mysqli_query($connection, $quary);
    $row = mysqli_fetch_array($result_set);


    if(is_array($row)){
        if($email == "admin@Email.com"){
            $_SESSION['Username'] = $row['email'];
            $_SESSION['Pasword'] = $row['Pwd'];
        } else{
            $_SESSION['User'] = $row['email'];
            $_SESSION['Pasw'] = $row['Pwd'];
        }
        
    } else {
    echo '<script type="text/javascript">';
    echo 'alert("Invalid Username or Password!");';
    echo 'window.location.href = "login.php";';
    echo '</script>';
    }


}
if(isset($_SESSION["Username"])){
    header("Location:sellerIntaface.php");
    
} if(isset($_SESSION["User"])){
    header("Location:home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        *{
    margin:0;
    padding:0;
    font-family: 'poppins';
    color: white;
}

body{
    background: url(imagesLog/lock5.jpg);
    background-size: auto;
    
    
    
}
.login-section{
    border:2px solid blueviolet ;
    height:580px;
    width:400px;
    position:absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    transition: 2s;
    overflow: hidden;
}

.login-section:hover{
    box-shadow: 0 0 40px whitesmoke;
}

.login-section .formbox{
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}
.formbox h2{
    text-align: center;
    font-size:33px;

}

.formbox .input-box{
    width: 340px;
    height: 40px;
    border-bottom: 2px solid white; /*for input-box lines*/
    margin: 30px 0;
    position: relative;
}
.input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 17px;
    padding-right: 28px;
    color: wheat;

}
.input-box label{
    position: absolute;
    top: 50%;
    left:0;
    transform: translateY(-50%);
    font-size: 18px;
    font-weight: 500;
    color: white;
    transition: .3s ease;
}
.input-box .icon{
    position: absolute;
    top: 13px;
    right: 0;
    font-size: 19px;
}
/* need this for user entering data type on the input-box line*/
.input-box input:focus ~ label,
.input-box input:valid ~ label{
    top: -5px;
    font-weight: 500;
}

/*CSS for Remember me label & checkbox*/
.remember-password{
    font-size: 15px;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: space-between;
}
.remember-password label input{
    accent-color:light blue;
    margin-right:3px ;
}

.remember-password a{
    color: white;
    font-weight: 600;
    text-decoration: none;
    font-size: 15px;
}

.remember-password a:hover{
    color:yellow;
    text-decoration: none;   
}

/*CSS for condition checker*/
.condition-checker{
    font-size: 16px;
    font-weight: 500;
    margin: -15px 0 15px;
    display:inline-flexbox;
}
.condition-checker a:hover{
    color:yellow;
    text-decoration: none;   
}

.btn{
    background-color: white;
    width: 100%;
    height: 45px;
    outline: none;
    border: none;
    cursor: pointer;
    font-size: 19px;
    color: white;
    background: darkgreen;
    
}

/*CSS for login form Register-link */
.create-account{  
    font-size: 15px;
    text-align: center;
    margin: 25px;
}
.create-account p a{
    color: white;
    font-weight: 600;
    text-decoration: none;
}
.create-account p a:hover{
    color: orange;
    font-weight: 600;
}

/*Transition of login form to register form (included js)*/
.login-section .formbox.register{
    transform: translateY(-560px);
    transition:transform.6s ease;
}
.login-section.active .formbox.register{
    transform: translateY(0);
    transition-delay: .7s ;
}
.login-section .formbox.login{
    transform: translateY(0px);
    transition:transform .7s;
}
.login-section.active .formbox.login{
    transform: translateY(530px);
    transition-delay: 0s ;
}
       
    </style>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <!-- Below CSS link(For icons of labels)from this web side-: https://boxicons.com/?query=enve -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

    <!--Login Form-->
    <div class="login-section">
        <div class="formbox login" id="loginForm">
            <form  method="POST">

                <h2> Login </h2>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-envelope'> </i> <!--from boxicons.com-->
                    </span>
                    <input type="text" id="email" name="email" required>
                    <label> Email </label>
                </div>

                <div class="input-box">
                    <span class="icon">
                       <i class='bx bxs-lock-alt'> </i> <!--From boxicons.com-->
                    </span>
                    <input type="password" id="password" name="pwd" required>
                      <label> Password </label>
                </div>

                <div class="remember-password">
                    <label> <Input type="checkbox"> Remember me </label>
                    <a href="forgot_password.html"> Forget Password </a>
                </div>

                <input type="submit" class="btn" name="login" value= "Login"  > 
                  
                <div class="create-account">
                    <p> Don't have an account? <a href="#" class="register-link">Register</a> </p>
                </div>
            </form>
           
        </div>
       <!--End of Login form-->



        <!--Register form-->
        <div class="formbox register" id="registerForm" >
            <form action= "connection.php" method="POST">
                <h2> Register </h2>
                <div class="input-box">
                    <span class="icon">
                      <i class='bx bxs-user'></i> <!--from boxicons.com-->
                    </span>
                    <input type="text" id="name" name="name" required>
                    <label> Name </label>
                </div>
                
        
                <div class="input-box">
                    <span class="icon">
                      <i class='bx bxs-envelope'> </i> <!--from boxicons.com-->
                    </span>
                    <input type="email" id="email" name="email" required>
                    <label> Email </label>
                </div>
                <div class="input-box">
                    <span class="icon">
                      <i class='bx bxs-phone'> </i> <!--from boxicons.com-->
                    </span>
                    <input type="tel" id="phone" name="phone"  pattern="[0][0-9]{9}" required><br><br>
                    <label> Phone Number </label>
                </div>
        
                <div class="input-box">
                    <span class="icon">
                       <i class='bx bxs-lock-alt'> </i> <!--From boxicons.com-->
                    </span> 
                    <input type="password" id="password" name= "pwd" required>
                    <label> Password </label>
                </div>
                
                <div class="input-box">
                    <span class="icon">
                      <i class='bx bxs-lock-alt'> </i> <!--From boxicons.com-->
                    </span>
                    <input type="password" id="confirmpassword" name= "confirmpass" required>
                    <label> Confirm Password </label>
                </div>
                
                <div class="condition-checker">
                    <Input type="checkbox" id="termsCheckbox"required>
                    <label for="termsCheckbox">I accept the <a href="conditionForm.php" id="termsLink"> Terms & Conditions.</a> </label>
                </div>
        
                <input type="submit" class="btn" value= "Register" >

                <div class="create-account">
                    <p>Already have an account? <a href="#" class="login-link"> Login </a> </p>
                </div> 
                
            </form>
           
        </div>
    </div>
   <!--End of Register form-->

   <script src="login.js"> </script>
   <script >
   const registerForm = document.querySelector('.register form');



// Add event listener for register submission
registerForm.addEventListener('submit', function (event) {
    if (!validateName(registerForm.name.value) || !validateEmail(registerForm.email.value) || 
        !validatePassword(registerForm.password.value) || !validateConfirmPassword(registerForm.confirmpassword.value)) {
        event.preventDefault();
    }
});


// Validation functions
function validateName(name) {
  const invalidChars = /[0-9!@#$%^&*()+\-/]/;
  
  if (invalidChars.test(name)) {
      alert('Please enter a valid name without numbers or special characters.');
      return false;
  }
  
  return true;
}

function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!email.match(emailPattern)) {
        return false;
    }
    return true;
}

function validatePassword(password) {
    if (password.length < 8) {
        alert('Password must be at least 8 characters long.');
        return false;
    }
    return true;
}

function validateConfirmPassword(confirmPassword) {
    const password = registerForm.password.value;
    if (confirmPassword !== password) {
        alert('Passwords do not match.');
        return false;
    }
    return true;
}
   
   </script>
   



  
</body>
</html>










