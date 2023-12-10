<?php
require 'function.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verify reCAPTCHA
    $recaptcha_secret = '6LdufSwpAAAAAI9FJp9ZBA3ksnqMIYPyG445qfsn'; // Replace with your actual Secret Key
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $verify_url = "https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}";
    $recaptcha_data = json_decode(file_get_contents($verify_url));

    if ($recaptcha_data->success) {
        // Check credentials
        $cekdatabase = mysqli_query($conn, "SELECT * FROM login WHERE email='$email' AND password='$password'");
        $hitung = mysqli_num_rows($cekdatabase);

        if ($hitung > 0) {
            // Successful login
            $data = mysqli_fetch_array($cekdatabase);
            $_SESSION['log'] = 'true';
            $_SESSION['level'] = $data['level'];
            header('location:index.php');
            exit;
        } else {
            // Display failure alert for incorrect credentials
            echo '<div class="alert alert-danger text-center" role="alert">
                    Username atau Password Anda Salah.
                  </div>';
        }
    } else {
        // Handle reCAPTCHA verification failure
        echo '<div class="alert alert-danger text-center" role="alert">
                reCAPTCHA verification failed. Please try again.
              </div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<style>
    /* Add your custom CSS styles here */
    .error-message {
        color: red;
        margin-top: 10px;
    }
</style>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" autofocus />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" autofocus />
                                            </div>
                                            <div class="g-recaptcha" data-sitekey="6LdufSwpAAAAAHSWrv9R9nPXsPqwM7dHAbRueQ5p"></div> <!-- Replace YOUR_RECAPTCHA_SITE_KEY with the actual Site Key -->
                                            <br>
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </form>
                                    </div>
                                </div>
                                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                <div class="card-footer text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>