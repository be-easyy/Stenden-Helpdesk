<?php
    include("include/init-db.php");
    include("include/init-session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <title>Login - Stenden Helpdesk</title>
</head>
<body>
    <div class="page">
		<div class="mid_box">
			<div class="mid_box_margin">
				<div class="mid_box_margin_logo">
					<img src="img/" alt="Logo">
				</div>
				<div class="mid_box_margin_form">
					<form action="" method="POST">
						<input type="text" id="input" name="user">
						<input type="password" id="input" name="pass">
						<input type="submit" id="submit" name="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>