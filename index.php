<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="sign.css">
    <title>SIGN UP</title>
    <script>
        function validatePhoneNumber() {
          function validatePhoneNumber() {
            var phoneNumber = document.getElementById('phone_number').value;
            var phoneRegex = /^\d{10}$/;
            var phoneInput = document.getElementById('phone_number');
            var phoneError = document.getElementById('phoneError');

            if (!phoneRegex.test(phoneNumber)) {
                phoneError.innerText = 'Please enter a valid 10-digit phone number.';
                phoneInput.classList.add('is-invalid');
                return false;
            } else {
                phoneError.innerText = '';
                phoneInput.classList.remove('is-invalid');
                return true;
            }
        }
        }

        function validateEmail() {
          var email = document.getElementById('email').value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var emailInput = document.getElementById('email');
            var emailError = document.getElementById('emailError');

            if (!emailRegex.test(email)) {
                emailError.innerText = 'Please enter a valid email address.';
                emailInput.classList.add('is-invalid');
                return false;
            } else {
                emailError.innerText = '';
                emailInput.classList.remove('is-invalid');
                return true;
            }
        }

        function checkPasswordStrength() {
          var password = document.getElementById('password').value;
        var strengthIndicator = document.getElementById('password-strength');
        
        strengthIndicator.innerHTML = '';  // Reset the indicator

        // Password strength rules (you can customize these)
        var minLength = 8;
        var hasUpperCase = /[A-Z]/.test(password);
        var hasLowerCase = /[a-z]/.test(password);
        var hasDigit = /\d/.test(password);
        var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        if (password.length < minLength) {
            strengthIndicator.innerHTML = 'Password should be at least ' + minLength + ' characters long.<br>';
        }
        if (!hasUpperCase) {
            strengthIndicator.innerHTML += 'Include at least one uppercase letter.<br>';
        }
        if (!hasLowerCase) {
            strengthIndicator.innerHTML += 'Include at least one lowercase letter.<br>';
        }
        if (!hasDigit) {
            strengthIndicator.innerHTML += 'Include at least one digit.<br>';
        }
        if (!hasSpecialChar) {
            strengthIndicator.innerHTML += 'Include at least one special character.<br>';
        }
    }

    function submitForm() {
      if (validateEmail() && validatePhoneNumber() && checkPasswordStrength() ) {
                document.getElementById('signupForm').submit();
            }
            }
    </script>
</head>
<body>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Firstname = $_POST['First-name'];
    $Lastname = $_POST['Last-name'];
    $dob = $_POST['Date-Of-Birth'];
    $Phone_Number = $_POST['phone_number'];
    $Email = $_POST['Email'];
    $Password = $_POST['password'];
    $Gender = $_POST['gender']; // Fix the name of the gender field
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "testing";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Sorry we failed to connect: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["First-name"]) || empty($_POST["Last-name"]) || empty($_POST["password"]) || empty($_POST["Email"])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>All fields are required!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div>';
    } else {
        $sql = "INSERT INTO `register` (`Firstname`, `Lastname`, `Phone Number`, `dob`, `Email`, `Password`, `Gender`) VALUES ('$Firstname','$Lastname', '$Phone_Number','$dob', '$Email', '$Password','$Gender');";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your entry has been submitted successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> We are facing some technical issue and your entry was not submitted successfully! We regret the inconvenience caused!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                  </div>';
        }
    }
}
?>
<div class="container">
    <h1>Registration</h1>
    <h2>It is free and takes 1 min</h2>
    <form action="index.php"  id="signupForm" method="post">
      <div class="grid-container">
        <div class="form-group">
            <label for="First-name">First-name</label>
            <input type="text" name="First-name" class="form-control" id="name" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="Last-name">Last-name</label>
            <input type="text" name="Last-name" class="form-control" id="name" aria-describedby="emailHelp">
        </div>
  </div>
  <div class="grid-container">
  <div class="form-group">
         <label for="phone_number">Phone Number</label>
              <input type="tel" name="phone_number" class="form-control" id="phone_number" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required onBlur="validatePhoneNumber()">
              <div class="invalid-feedback" id="phoneError"></div>
        </div>
          <div class="form-group">
              <label for="Date-Of-Birth">Date-Of-Birth</label>
                <input type="date" name="Date-Of-Birth" class="form-control" id="date-of-birth">
              <div class="invalid-feedback" id="phoneError"></div>
        </div>
  </div>
  <div class="grid-container">
        <div class="form-group">
           <label for="Email">Email</label>
            <input type="Email" name="Email" class="form-control" id="email" required onBlur="validateEmail()">
            <div class="invalid-feedback" id="emailError"></div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required oninput="checkPasswordStrength()" aria-describedby="emailHelp">
            <div id="password-strength"></div>
        </div>
  </div>
  <div class="radio-button">
                        <label>Gender</label>
                        <div class="form-check">
                            <input type="radio" name="gender" class="form-check-input" id="male" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" class="form-check-input" id="female" value="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" class="form-check-input" id="other" value="other" required>
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
        
        <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
    </form>
    <p> By clicking the Sign Up button, you agree to our<br>
        <input type="checkbox">
        <a href="#">Terms And Conditions</a> and <a href="#">Policy And Privacy</a>
    </p>
    <p class="para-2">Already have Account?<a href="login.php">Sign In Here</a></p>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
