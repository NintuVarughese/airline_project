<?php
include('db_conn.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>


<body>
    <section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

             
             
              <form method="POST" action="">
    <div class="form-outline mb-4">
        <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name"/>
        <label class="form-label" for="form3Example1cg">Your Name</label>
    </div>

    <div class="form-outline mb-4">
        <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email"/>
        <label class="form-label" for="form3Example3cg">Your Email</label>
    </div>

    <div class="form-outline mb-4">
        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password"/>
        <label class="form-label" for="form3Example4cg">Password</label>
    </div>

    <div class="form-outline mb-4">
        <input type="password" id="form3Example4cdg" class="form-control form-control-lg"/>
        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
    </div>

    <!-- <div class="form-check d-flex justify-content-center mb-5">
        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
        <label class="form-check-label" for="form2Example3g">
            I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
        </label> -->
    </div> 

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
    </div>

    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
</form>


                <!-- <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div>  -->

                <!-- <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                 <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              

            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
  <!-- <a href="login.php">login</a> -->
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $ins = $conn->query("insert into  register(name,email,password)values('$name','$email','$password')");
    // echo $name." ".$email." ".$password;
}

?>
</section>