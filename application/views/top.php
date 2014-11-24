<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=BASE_URL;?>static/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=BASE_URL;?>static/css/style.css">

<!--[if lt IE 9]>
<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>


<div class="container">

<form id="top_login" class="form-signin" role="form" method="POST" action="/auth/login/">
<h2 class="form-signin-heading">Please Login</h2>
<label for="inputEmail" class="sr-only">UserID</label>
<input type="text" id="inputID" class="form-control" name="username" placeholder="UserId" required autofocus>
<label for="inputPassword" class="sr-only">Password</label>
<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
<div class="checkbox">
<label>
<input type="checkbox" value="remember-me"> Remember me
</label>
</div>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

</div> <!-- /container -->


<script src="<?=BASE_URL;?>static/js/jquery-2.1.1.min.js"></script>

</body>
</html>

