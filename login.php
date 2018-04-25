<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" id="bulma" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.2/css/bulma.min.css" />
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
  <div class="login-wrapper columns">
    <div class="column is-8 is-hidden-mobile hero-banner">
      <section class="hero is-fullheight is-dark">
        <div class="hero-body">
          <div class="container section">
            <div class="has-text-right">
              <h1 class="title is-1">Login</h1> <br>
              <p class="title is-3">Cosmetic Shop</p>
            </div>
          </div>
        </div>
        <div class="hero-footer">
          <p class="has-text-centered">Image © Glenn Carstens-Peters via unsplash</p>
        </div>
      </section>
    </div>
    <div class="column is-4">
      <section class="hero is-fullheight">
        <div class="hero-heading">
          <div class="section has-text-centered">
            <?php if($_GET['id'] == "fail") {?>
              <div class="notification is-warning">
                Invalid User ID or Password. Please try again.
              </div>
            <?php } else if($_GET['id'] == "success") { ?>
              <div class="notification is-success">
                Registration Successful
              </div>
              <?php } ?>
            <img src="assets/logo.png" >
          </div>
        </div>
        <div class="hero-body">
          <div class="container">
            <div class="columns">
              <div class="column is-8 is-offset-2">
                <h1 class="avatar has-text-centered section">
                  
                </h1>
                <form action = "checklogin.php" method="post" >
                  <div class="login-form">
                    <p class="control has-icon has-icon-right">
                      <input class="input email-input" type="text" name="username" id="username" placeholder="Username" required="">
                      <span class="icon user">
                        <i class="fa fa-user"></i>
                      </span>
                    </p>
                    <p class="control has-icon has-icon-right">
                      <input class="input password-input" type="password" name="password" id="password" placeholder="Password" required="">
                      <span class="icon user">
                        <i class="fa fa-lock"></i>
                      </span>
                    </p>
                    <p class="control login">
                      <button class="button is-success is-outlined is-large is-fullwidth">Login</button>
                    </p>
                  </div>
                </form>
                <div class="section forgot-password">
                  <p class="has-text-centered">
                    <a href="index.php">Home</a>
                    <a href="register.php">Register</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

</body>
</html>
