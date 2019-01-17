<?php
    include("./includes/init-db.php");
    include("./includes/init-session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Login - Stenden Helpdesk</title>
</head>
<body>
    <div class="login_page">
		<div class="mid_box">
			<div class="mid_box_margin">
				<div class="mid_box_margin_logo">
					<img id="logo" src="img/logo.png" alt="Logo">
				</div>
				<div class="mid_box_margin_form">
					<form action="log_in.php" method="POST">
						<div class="login_input">
							Username: 
						</div>
						<input type="text" id="input" name="user">
						<div class="login_input">
							Password: 
						</div>
						<input type="password" id="input" name="pass">
						<input type="submit" id="submit" name="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


