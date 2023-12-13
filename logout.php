<form action="" method="post">
    <input type="submit" name="logout" value="Logout">
</form>

<?php

    if(isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
    }

?>