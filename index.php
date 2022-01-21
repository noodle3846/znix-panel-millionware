<?php

require_once 'app/require.php';
require_once 'app/controllers/CheatController.php';

$user = new UserController;
$cheat = new CheatController;

Session::init();

if (!Session::isLogged()) { Util::redirect('/login.php'); }

$username = Session::get("username");
$invitedBy = Session::get("invitedBy");
$sub = $user->getSubStatus();
$uid = Session::get("uid");

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
    <script>
        function generate_invite() {
            $.get("/api/generate_invite", (res) => {
                var left = parseInt(res);
                if (isNaN(left))
                    return toastr.error(res);

                toastr.success("invite generated!");
                geninv.childNodes[0].innerText = `generate invite (${left} left)`;

                if (left <= 0)
                    geninv.style.display = "none";
            });
        }

        function show_invites() {
            $.get("/api/invite_codes", (res) => {
                $("table").html(`
                <tr>
                    <th style="position: relative; left: 10px;">code</th>
                    <th>user</th>
                </tr>
                `);
                res.forEach(add_code);
                $(".invites").addClass("shown");
                $(".modal-overlay").addClass("shown");
            });
        }

        function add_code(code) {
            var elem = $(`
                <tr>
                    <td>${code.code}</td>
                    <td>${code.name}</td>
                </tr>
            `);
            $("table").append(elem);
        }
    </script>
</head>

<body>
    <script>
        if (location.href.indexOf("?") != -1) {
            toastr.error(location.href.substring(location.href.indexOf("?") + 1, location.href.length).split("_").join(" ").split("=")[0]);
        }
    </script>
    <div class="modal-overlay">

    </div>
    <div class="invites modal" style="max-height: 350px; overflow-y:scroll;">
        <table style="width:100%; text-align: left;">

        </table>
    </div>
    <div class="main">
        <div class="panel-card">
            <div class="header">
                <span>user info</span>
            </div>
            welcome, <a href="/profile.php" style="color:rgb(255, 84, 241);"><?php Util::display($username) ?></a> (uid: <?php Util::display($uid); ?>)<br>
            your inviter : <a href="https://website.cc/" style="color:rgb(255, 84, 241);"><?php Util::display($invitedBy) ?></a><br>

            <div class="inner">
                <div class="separator">
                    <br>
                    <span>sub</span><br>
                    <span style="color: lime;"><?php 
										if ($sub > 0) { 
											Util::display($sub . ' days'); 
										} else {
											Util::display('0 days'); 
										} ?></span><br>
                    <a href="https://website.cc/purchase.php">extend</a><br>
                    <br>
                    <span>client</span><br>
            <a href="https://website.cc/download.php">download loader</a><br>

                </div>

                <div class="separator">
                    <br>
                    <span>discord</span><br>
                    <a href="https://website.cc/account/connected-accounts/">link account</a><br>
                    <br>

                    <span>information</span><br>
                    <a href="https://website.cc/faq.php">frequently asked questions</a><br>
                    <a href="https://website.cc/static/tos.txt">terms of service</a><br>
                    <br>
                </div>
            </div>
            <span>management</span><br>

            <a href="https://website.cc/panel#" onclick="show_invites()">show my invites</a>
	    <?php if (Session::isAdmin() == true) : ?>
		<br>
		<a class="nav-link" href="<?= SUB_DIR ?>/admin">admin panel</a>

	    <?php endif; ?>
        </div>
    </div>
    <div class="panel-card stats" style="width: 300px">
        <div class="header"><span>stats</span></div>
        <span>registered users: <?php Util::display($user->getUserCount()); ?></span><br>
        <span>newest user: <a href="https://website.cc/" style="color: rgb(255, 213, 5);"><?php Util::display($user->getNewUser()); ?></a></span><br>
        <span><span>
    </span></span></div>
    <div class="controls">
        <a href="https://website.cc/logout.php">log out</a>
    </div>
    <div class="user-controls">
        <a href="https://website.cc/">panel</a>
    </div>

    <script>
        $(".modal-overlay").click(() => {
            $(".invites").removeClass("shown");
            $(".modal-overlay").removeClass("shown");
        });
    </script>
</body></html>
