<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="form">
  <meta name="keywords" content="Chat Room">
  <meta name="author" content="Amey Thakur">
  <title>Chat Room</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../layout/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../layout/css/all.min.css" />
  <link rel="stylesheet" href="../layout/css/owl.carousel.min.css" />
  <link rel="stylesheet" href="../layout/css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <link rel="stylesheet" href="../layout/css/front-end-en.css" />
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <style>
    .offcanvas-body .chat_box .chat {
      background-color: #000000;
      color: white;
      padding: 18px 25px;
      border-radius: 20px;
    }

    .offcanvas-body {
      background-color: #000000;
    }

    .offcanvas-start {
      width: 563px;
    }

    .form-horizontal {
      width: 100%;
      background-color: white;
    }
  </style>

</head>

<body onload="ajax();">
  <div class="contactUSIcon">
    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="far fa-comment"></i></a>
  </div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Group chat</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div id="chat_box" class="chat_box">
        <div id="chat" class="chat"></div>
        <form method="post" action="#" class="form-horizontal" onsubmit="sendMessage(event)">
          <div class="form-group">
            <input type="hidden" value="Ahmed" class="form-control" id="" placeholder="Enter your name" name="username">
          </div>
          <div class="row g-2">
            <div class="col-9">
              <div class="form-floating d-grid align-items-center">
                <input type="text" class="form-control" id="comment" name="message" required placeholder="Message">
                <label for="comment">Message</label>
              </div>
            </div>
            <div class="col-2 d-grid align-items-center">
              <button type="submit" name="submit" class="btn btn-outline-primary"><i class="fas fa-paper-plane"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../layout/js/jquery-3.6.0.min.js"></script>
  <script src="../layout/js/all.min.js"></script>
  <script src="../layout/js/bootstrap.bundle.min.js"></script>
  <script src="../layout/js/owl.carousel.min.js"></script>
  <script src="../layout/js/owl.autoplay.min.js"></script>
  <script>
    function ajax() {
      $.ajax({
        url: "chat.php",
        success: function(result) {
          $("#chat").html(result);
        }
      });
    }

    setInterval(function() {
      ajax();
    }, 1000);

    function sendMessage(event) {
      event.preventDefault();

      var username = "Ahmed";
      var message = $("#comment").val();

      $.ajax({
        url: "index.php",
        method: "POST",
        data: {
          username: username,
          message: message
        },
        success: function(response) {
          $("#comment").val("");
          // Optionally, you can update the chat or perform any other actions here
        }
      });
    }
  </script>
</body>

</html>