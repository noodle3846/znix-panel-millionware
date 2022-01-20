<?php
include 'app/require.php';

$user = new UserController;

Session::init();

if (Session::isLogged()) { Util::redirect('/'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') { $error = $user->registerUser($_POST); }

//Util::head('Register');
//Util::navbar();

?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>register - website</title>
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
    <?php if (isset($error)) : ?>
				<div class="alert alert-primary" role="alert">
					<?php Util::display($error); ?>
				</div>
			<?php endif; ?>
<div class="main">
<a href="https://website.cc/">main page</a>
<form method="post">
<input type="text" placeholder="username" name="username">
<input type="password" placeholder="password" name="password">
<input type="text" placeholder="invite code" name="invCode">
<input id="submit" type="submit" value="submit">
</form>
</div>
<script src="./files/cookieconsent.min.js.download"></script>
<script src="./files/cookies.js.download"></script>
<script>
        function findGetParameter(parameterName) {
            var result = null, tmp = [];
            var items = location.search.substr(1).split("&");
            for (var index = 0; index < items.length; index++) {
                tmp = items[index].split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            }
            return result;
        }
        if (findGetParameter('invite') !== null)
            document.querySelector('input[name=k]').value = findGetParameter('invite');
    </script>
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6c94ad022e57b394',m:'5HoVpe3HJZuJ.K_iSLUNAF4E6xqjKOcd9eUdBKStUxU-1641469271-0-AQCMi7HYOPLAQhBhiPS2SaofSsg87S8COx9fwzYuntNd9bQk1wFLF8ub1pn54qii/lvTbYXsre96G0Dh06JkrL4IaECKmAVDIxORsEXnugIKZuJo1gGfdSrhmMXRQG4cYA==',s:[0xfa0588e419,0x38a96acf14],u:'/cdn-cgi/challenge-platform/h/g'}})();</script>
</body></html>