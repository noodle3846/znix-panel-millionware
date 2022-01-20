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

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>profile - website</title>
    <link rel="stylesheet" href="./files/app.css">
    <script src="./files/jquery.min.js.download"></script>
    <script src="./files/socket.io.js.download"></script>
    <link rel="stylesheet" href="./files/toastr.min.css">
    <script src="./files/toastr.min.js.download"></script>
</head>

<body>
    <script>
        if (location.href.indexOf("?") != -1 && location.href.indexOf("id=") == -1) {
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
            <div class="header"><span>user profile</span></div>
            username: <a href="https://website.cc/profile.php" style="color:rgb(255, 84, 241);"><?php Util::display($username); ?></a><br>
            invited by: <a href="https://website.cc/" style="color:rgb(255, 84, 241);">soon...</a><br>
            role: <span style="color: rgb(255, 213, 5);">premium</span><br><br>

            <span>management</span><br>
            <a href="https://website.cc/purchase?username=<?php Util::display($username); ?>">gift sub</a>
            
        </div>
        <div class="panel-card" style="margin-top: 45px; max-height: 20vw;">
            <div class="header">
                <span>comments</span>
            </div>
            <div style="width: 100%; max-height: 20vw;  overflow-y: scroll;">
                <div class="comments">
                    <div class="leave-comment">
                        <div id="comment-hyper"><a href="https://website.cc/profile?id=3184#" onclick="$(&#39;#comment-form&#39;).parent().toggleClass(&#39;shown&#39;)">leave a comment</a></div>
                        <form autocomplete="off" action="https://website.cc/comment" method="POST" id="comment-form">
                            <input type="hidden" name="id" value="3184">
                            <input type="text" name="contents">
                            <button>send</button>
                        </form>
                    </div>
                </div>
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
        $(".modal-overlay").click(() => {
            $(".invites").removeClass("shown");
            $(".modal-overlay").removeClass("shown");
        });
    </script>
</body></html>