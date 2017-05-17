<?php

if ($_POST) {
    $errors = array();
    $errorStr = "";
    $successStr = "";
    if (!$_POST["email"]) {
        array_push($errors, "An email is required.");
    }
    if (!$_POST["subject"]) {
        array_push($errors, "A subject is required.");
    }
    if (!$_POST["content"]) {
        array_push($errors, "Content field is required.");
    }
    
    if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
        array_push($errors, "The email is invalid.");
    }
    
    if (!empty($errors)) {
        $errorStr = '<div id="error" class="alert alert-danger" role="alert"><strong>There were some errors:</strong><br>';
        foreach ($errors as $value) {
            $errorStr .= $value.'<br>';
        }
        $errorStr .= '</div>';
    } else {
        $emailTo = "me@mydomain.com";
        $subject = $POST["subject"];
        $content = $_POST["content"];
        $headers = "From: ".$_POST["email"];
        
        if (mail($emailTo, $subject, $content, $headers)) {
            $successStr = '<div id="error" class="alert alert-success" role="alert">Your message was <strong>sent</strong>!</div>';
        } else {
            $errorStr = '<div id="error" class="alert alert-danger" role="alert">Your message <strong>couldn\'t be sent</strong>. Please try again.</div>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <style type="text/css">
        #error ul {
            list-style-type: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Get in touch !</h1>
        
        <div id="error" role="alert"></div>
        <?php echo $errorStr.$successStr; ?>

        <form method="post">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="subject">Password</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter a subject, a.k.a. Programmer, Coding, etc.">
            </div>
            <div class="form-group">
                <label for="content">What would you like to ask us ?</label>
                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </form>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
        
        $("form").submit(function (e) {
            var errors = [];
            
            var email = $("#email").val();
            if (email === "") {
                errors.push("The email field is required.");
            }
            
            var subject = $("#subject").val();
            if (subject === "") {
                errors.push("The subject field is required.");
            }
            
            var content = $("#content").val();
            if (content === "") {
                errors.push("The content field is required.");
            }
            
            var errorsDiv = $("#error");
            errorsDiv.removeClass("alert alert-danger");
            errorsDiv.html("");
            
            if (errors.length > 0) {
                errorsDiv.html("<p><strong>There were errors in your form: </strong></p>");
                errorsDiv.addClass("alert alert-danger");
                errors.forEach(function (item, index) {
                    errorsDiv.html(errorsDiv.html() + item + "<br>");
                });
                return false;
            } else {
                return true;
            }
        });
        
    </script>
</body>

</html>
