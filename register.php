<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bulma.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body>
  <section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column is-4 is-offset-4">
            <h1 class="title">
              Register an Account
            </h1>
            <form class="" action="save_register.php" method="post">
              <div class="box">
                <label class="label">Name</label>
                <p class="control">
                  <input class="input" type="text" name="name" placeholder="Name" required="">
                </p>
                <label class="label">Username</label>
                <p class="control">
                  <input class="input" type="text" name="username" placeholder="Username" required="">
                </p>
                <hr>
                <label class="label">Password</label>
                <p class="control">
                  <input class="input" type="password" name="password" placeholder="Password" required="">
                </p>
                <hr>
                <p class="control">
                  <input type="submit" class="button is-primary" value="Register">
                  <a href="login.php" class="button is-default">Cancel</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
</body>
</html>
