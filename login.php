<?php
include 'app/require.php';

$user = new UserController;

Session::init();

if (Session::isLogged()) { Util::redirect('/'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') { $error = $user->loginUser($_POST); }

//Util::head('Login');

?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>login - website</title>
<link rel="stylesheet" href="./files/app.css">
<script src="./files/jquery.min.js.download"></script>
<link rel="stylesheet" href="./files/toastr.min.css">
<script src="./files/toastr.min.js.download"></script>
<style>
        .toast {
            background: black;
            box-shadow: none !important;
        }

        .toast-error {
            border: 1px solid red;
        }

        .toast-success {
            border: 1px solid red;
        }
    </style>
<script async="" src="./files/invisible.js.download"></script></head>
<body>
<script>
        if (location.href.indexOf("?") != -1) {
            toastr.error(location.href.substring(location.href.indexOf("?") + 1, location.href.length).split("_").join(" ").split("=")[0]);
        }
    </script>
    <div class="col-12 mt-3 mb-2">

			<?php if (isset($error)) : ?>
				<div class="alert alert-primary" role="alert">
					<?php Util::display($error); ?>
				</div>
			<?php endif; ?>

		</div>
<div class="main">
<a href="https://website.cc/">main page</a>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<input type="text" placeholder="username" name="username">
<input type="password" placeholder="password" name="password">
<input id="submit" type="submit" value="submit">
</form>
</div>
<script src="./files/cookieconsent.min.js.download"></script>
<script src="./files/cookies.js.download"></script>
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6c94ace40ea2b394',m:'D0DRfeYARU5Vy8SC.ac9ij_WIz7uOaISQOd_VCj7I3s-1641469266-0-AWUSYMq4NPvpuAeSGyA1glnK3705xu0NnAiCs9Yht0yiRcZn66VmKWfPjbjikIRaz597dycIXjKHyQBSIYSMy05H7oHFeu176KItHT6BfIVZmqDJirFuzKH37nC+Jbxu0g==',s:[0xa07c308a57,0xd076b4df03],u:'/cdn-cgi/challenge-platform/h/g'}})();</script></body></html>