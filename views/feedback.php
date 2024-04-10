
<html lang="en"><head>
    <meta charset="utf-8">
    <title>insiteful</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/css/home.css">
    <link rel="stylesheet" type="text/css" href="/public/css/feedback.css">
</head>
<body >

    <div class="feedback-container">
        <div class="content">
            <h3>Feedback</h3>
                <form action="/feedback/action" method="POST">
                    <label class="feedback">How can we make the service better for you?
                        <textarea class="feedback" name="feedback" style="min-height: 300px; min-width:400px;" id ="feedback"></textarea>
                        <div class="account-btn-group ">
                            <a href="/" class="btn-secondary " >Cancel</a>
                            <button type="submit" class="btn-primary" id="add-btn">   Send  </button>
                        </div>

                </form>
        </div>
    </div>
</body>
<script src="../public/js/contact.js"></script>
</html>






