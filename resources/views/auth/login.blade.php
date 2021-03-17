<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

     <!-- Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </head>
  <body>
  <style>
        body {
            width: 100vw;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-div {
            max-width: 430px;
            padding: 35px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .logo {
            width:100px;
            height:100px;
            border-radius: 50%;
            margin:0 auto;
        }
  </style>

    <div class="login-div">
        <div class="row">
            <div class="logo"> <img class="logo" src="{{asset('./assets/login_logo.jpg')}}" alt=""></div>
        </div>
        <div class="row center-align">
            <h5>Sign in</h5>
            <h6>Use your SGS Account</h6>
        </div>
        
        <form method="POST" action="{{ route('login')}}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="username" type="text" class="validate" required name="username">
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password_input" type="password" class="validate" name="password">
                    <label for="password_input">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">Not your computer? Use a Private Window to sign in. <a href="#"><b>Learn more</b></a></div>
            </div>
            <div class="row"></div>
            <div class="row">
                <div class="col s6"><a href="#"></a></div>
                <div class="col s6 right-align"><button type="submit" class="waves-effect waves-light btn">Login</button></div>
            </div>
        </form>
    </div>
  </body>
</html>
