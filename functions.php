<?php
    session_start();
    require_once('connection.php');
    // include_once('register_form.php');

?>

<!-- REGISTRACIJA KORISNIKA I PROVERE PRI ISTOJ -->

<?php

function isValidUsername($username) {
    return preg_match('/^(?=.*[A-Z])(?=.*[0-9]{2,})/', $username);
}
?>
<?php

function insertUsernameIntoDatabase($conn, $username) {
    $login_username_query = "SELECT user_username FROM users WHERE user_username = ?";
    $login_username_prep = $conn->prepare($login_username_query);
    $login_username_prep->bind_param('s', $username); // Korišćenje bind_param umesto bindParam
    $login_username_prep->execute();
    $login_username_result = $login_username_prep->get_result();

    if ($login_username_result->num_rows > 0) {
        die("Korisničko ime već postoji u bazi.");
    }
}

function isValidEmail($conn, $email) {
    $login_email_query = "SELECT user_email FROM users WHERE user_email = ?";
    $login_email_prep = $conn->prepare($login_email_query);
    $login_email_prep->bind_param('s', $email);
    $login_email_prep->execute();
    $login_email_result = $login_email_prep->get_result();
    if ($login_email_result->num_rows > 0) {
        die("E-mail adresa je već registrovana!");
    }
}

function passwordLengthAndPasswordRepeated($password, $repeat_password) {
    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Lozinka mora imati najmanje 8 karaktera";
    }

    if ($password != $repeat_password) {
        $errors[] = "Ponovljena lozinka se ne poklapa sa prvom lozinkom";
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    return $errors; // Vraća niz grešaka
}


function insertUserInDatabase($conn, $email, $username, $hashed_password){
    
    $register_users_query = "INSERT INTO users (user_email, user_username, user_password) VALUES (?, ?, ?)";
    $register_users_prepared = $conn->prepare($register_users_query);
    $register_users_prepared->bind_param('sss', $email, $username, $hashed_password);
    $register_users_result = $register_users_prepared->execute();

    // Dobijanje automatski inkrementiranog user_id
    $userId = $conn->insert_id;

    $insertUserSql = "INSERT INTO user_messages (user_id) VALUES (?)";
    $insertUserStmt = $conn->prepare($insertUserSql);
    $insertUserStmt->bind_param("i", $userId);
    $insertUserStmt->execute();
    $insertUserStmt->close();

    if ($register_users_result) {
        $_SESSION['user_email'] = $email;
        header("Location: logged_in.php");
        exit(); 
    }
    else {
        echo 'GRESKA U PRIJAVI';
    }

    $register_users_prepared->close(); 
}



?>

<!-- LOGOVANJE KORISNIKA I FUNKCIJE -->

<?php

    function loginUser($conn, $login_email_username, $login_password) {
        $login_query = "SELECT user_email, user_password FROM users WHERE user_email = ? OR user_username = ?";
        $login_prep = $conn->prepare($login_query);
        $login_prep->bind_param('ss', $login_email_username, $login_email_username);
        $login_prep->execute();
        $login_result = $login_prep->get_result();

    if ($login_result->num_rows > 0) {
        $row = $login_result->fetch_assoc();
        if (password_verify($login_password, $row['user_password'])) {
            $_SESSION['user_email'] = $row['user_email'];
            header("Location: logged_in.php");
        } else {
            return 'Pogresna lozinka';
        }
    } else {
        return 'Korisnik sa tom e-mail adresom, ili korisnickim imenom ne postoji. Molim Vas pokusajte ponovo.';
    }
}
?>


?>
