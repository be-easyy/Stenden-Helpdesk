<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <title>User - Stenden Helpdesk</title>
</head>
<body>
<div class="page">
    <div class="wrap">
        <div class="header">
            <div class="logo">
            <img id="logo" src="img/logo.png" alt="Logo">
            </div>
            <div class="navbar">
                <a class="open" href="#">New Ticket</a> 
                <a href="#">Ticket History</a> 
                <a href="#">Overview</a> 
                <a href="#">Your Tickets</a>
                <a href="">FAQ</a>
            </div>
        </div>


        <div class="content">
            <div class="content_margin">
                <form method="POST" action="">
                    <label for="long_middle">Subject</label>
                    <input type="text" id="long_middle" name="subject" placeholder="Subject of the issue..">
                    <div class="form-50_left">
                        <label for="short_left">Name</label>
                        <input type="text" id="short_left" name="name" placeholder="Your full name..">
                    </div>
                    <div class="form-50_right">
                        <label for="short_right">Product</label>
                        <input type="text" id="short_right" name="product" placeholder="Troubled product..">
                    </div>
                    <div class="form-50_left">
                        <label for="short_left">Date</label>
                        <input type="date" id="short_left" name="date">
                    </div>
                    <div class="form-50_right">
                        <label for="short_right">Licence</label>
                        <input type="text" id="short_right" name="licence">
                    </div>
                    <label for="textarea">Description</label>
                    <textarea id="textarea" name="description" placeholder="Describe your issue.."></textarea>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer_margin">
        </div>
    </div>
</div>
</body>
</html>