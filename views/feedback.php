<?php
    include_once 'home.php';
?>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>insiteful</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/public/css/home.css">
    <link rel="stylesheet" type="text/css" href="/public/css/feedback.css">


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&amp;family=Poppins:wght@700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="/public/js/utils.js"></script><script data-id="33671ad4-a966-4a52-b48f-56c92d10a678" data-utcoffset="1" data-server="https://simple-web-analytics.com" src="https://cdn.counter.dev/script-testing.js"></script>
    <script src="components/counter-flash.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AerWkj-d8OVv4VFbb4c0YC2C9EYlKw9A6QzZdKqaKHomGcnfiQcBFXL0vtL2A1sF_pfSuVY2IUg8XFbx&amp;vault=true&amp;intent=subscription" data-sdk-integration-source="button-factory" data-uid-auto="uid_mjhnbdvtjqseghzieuoeabthzjrlbg"></script><script src="https://www.paypal.com/tagmanager/pptm.js?id=counter.dev&amp;t=xo&amp;v=5.0.431&amp;source=payments_sdk&amp;client_id=AerWkj-d8OVv4VFbb4c0YC2C9EYlKw9A6QzZdKqaKHomGcnfiQcBFXL0vtL2A1sF_pfSuVY2IUg8XFbx&amp;disableSetCookie=true&amp;vault=true" id="xo-pptm" async=""></script>
</head>
<body style="overflow: hidden;">






<div id="forest-ext-shadow-host"></div>
<div class="jquery-modal blocker current">
    <div id="modal-feedback" style="display: inline-block;" class="modal">
        <div class="modal-header">
            <h3 class="ml16">Feedback</h3>
        </div>
        <div class="modal-content">
            <form action="/feedback/action" method="POST">
                <label class="feedback">How can we make the service better for you?
                    <textarea class="feedback" name="feedback" style="min-height: 200px;"></textarea>
                <div class="account-btn-group flex mt24 mb32">
                    <a href="/" class="btn-secondary full mr16" rel="modal:close">Cancel</a>
                    <button type="submit" class="btn-primary full">Send</button>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>