<?php

    require_once('user_logged_in.php');

?>

<?php

    require_once('connection.php');
    include_once('login_form.php');
    include_once('functions.php');

?>

<?php

    if (isset($_POST['login'])) {
        $login_email_username = $_POST['login_email_username'];
        $login_password = $_POST['login_password'];

        $loginResult = loginUser($conn, $login_email_username, $login_password);

    if (is_string($loginResult)) {
        // If $loginResult is a string, it means there was an error.
        echo $loginResult;
    }

    if ($username === 'Admin125' && $password === 'adminadminn') {
        header('Location: admin.php');
        exit();
    } else {
        header('Location: logged_in.php');
        exit();
    }

}

?>
