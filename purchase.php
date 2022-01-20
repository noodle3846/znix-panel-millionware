<?php

require_once 'app/require.php';

$user = new UserController;

Session::init();

if (!Session::isLogged()) { Util::redirect('/login.php'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (isset($_POST["updatePassword"])) {
		$error = $user->updateUserPass($_POST);
	}


	if (isset($_POST["activateSub"])) {
		$error = $user->activateSub($_POST);
	}
}

$uid = Session::get("uid");
$username = Session::get("username");
$admin = Session::get("admin");

$sub = $user->getSubStatus();

Util::banCheck();
//Util::head($username);
//Util::navbar();

?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>panel - website</title>
    <link rel="stylesheet" href="./files/app.css">
    <script src="./files/jquery.min.js.download"></script>
    <script src="./files/socket.io.js.download"></script>
    <link rel="stylesheet" href="./files/toastr.min.css">
    <script src="./files/toastr.min.js.download"></script>
    <script src="./files/saved_resource"></script>
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
    <style>
        input[type="text"] {
            padding: 2px !important;
            margin: 5px !important;
            width: 150px !important;
            display: inline-block;
        }

        button {
            background: black;
            border: 1px solid rgb(255, 84, 241);
            padding: 2px !important;
            margin: 0 !important;
            width: 150px !important;
            display: inline-block;
            color: rgb(180, 180, 180);
        }

        .inner {
            border-top: 0 !important;
            border-bottom: 0 !important;
        }
    </style>
</head>

<body>
    <script>
        if (location.href.indexOf("?") != -1 && location.href.indexOf("username=") == -1) {
            if (location.href.indexOf("succ") != -1)
                toastr.success(location.href.substring(location.href.indexOf("?") + 1, location.href.length).split("_").join(" ").split("=")[0]);
            else
                toastr.error(location.href.substring(location.href.indexOf("?") + 1, location.href.length).split("_").join(" ").split("=")[0]);
        }
    </script>
    <?php if (isset($error)) : ?>
				<div class="alert alert-primary" role="alert">
					<?php Util::display($error); ?>
				</div>
			<?php endif; ?>
    <div class="main">
        <div class="panel-card" style="min-height: 250px">
            <div class="header">
                <span>purchase or gift</span>
            </div>
            <div class="inner">
                <div class="separator">
                    <span>credit card</span><br><br>
                    <!-- 9.99, 22.99, 74.99, 249.99-->
                    <select id="length">
                        <option value="1">1 month - $7.99</option>
                        <!--<option value="2">3 months - $17.99</option>
                        <option value="3">1 year - $54.99</option>
                        <option value="4">lifetime - $179.99</option>-->
                    </select><br>

                    <br>
                    <button onclick="window.location.href='https://sellix.io';">buy</button>
                </div>

                <div class="separator">
                    <span>crypto</span><br><br>

                    <select id="clength">
                        <option value="1">1 month - $7.99</option>
                    </select><br>

                    <br>
                    <button onclick="window.location.href='https://sellix.io';">buy</button>
                </div>
                
                <?php if ($sub <= 0) : ?>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <span>redeem code</span><br>
                <input type="text" placeholder="subscription code" name="subCode">
                <button name="activateSub" type="submit" value="submit">redeem</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="controls">
        <a href="https://website.cc/logout.php">log out</a>
    </div>
    <div class="user-controls">
        <a href="https://website.cc/">panel</a>
    </div>


    <script>
        function buy() {
            const stripe = new Stripe("pk_live_7mHGy304xropPAh0bt2oahoT");

            $("#buy").text("please wait");
            $.get("/api/purchase/" + $("#length").val() + "/" + $("#u").val(), (data) => {
                if (!data.success) {
                    $("#buy").text("error");
                    setTimeout(() => { $("#buy").text("buy"); }, 2500);
                    return toastr.error(data.error);
                }
                $("#buy").text("redirecting");

                setTimeout(() => {
                    stripe.redirectToCheckout({
                        sessionId: data.session,
                    });
                }, 500);
            })
        }

        function buy_crypto() {
            $("#cbuy").text("please wait");
            $.get("/api/purchase/crypto/" + $("#clength").val() + "/" + $("#cu").val(), (data) => {
                if (!data.success) {
                    $("#cbuy").text("error");
                    setTimeout(() => { $("#cbuy").text("buy"); }, 2500);
                    return toastr.error(data.error);
                }
                $("#cbuy").text("redirecting");
                console.log(data);
                setTimeout(() => {
                    location = data.url;
                }, 500);
            })
        }

    </script>

<iframe name="__privateStripeMetricsController1540" frameborder="0" allowtransparency="true" scrolling="no" allow="payment *" src="./files/m-outer-fd3c67f2efa9f22f2ecd16b13f2a7fb3.html" aria-hidden="true" tabindex="-1" style="border: none !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; visibility: hidden !important; position: fixed !important; height: 1px !important; pointer-events: none !important; user-select: none !important;"></iframe></body></html>