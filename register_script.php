<?php
require_once('connection.php');
include_once('register_form.php');
include_once('functions.php');

if (isset($_POST['submit'])) {
    $email = $_POST['user_email'];
    $username = $_POST['user_username'];
    $password = $_POST['user_password'];
    $repeat_password = $_POST['user_repeat_password'];

    $errors = [];

    if (!isValidUsername($username)) {
        $errors[] = "Korisničko ime ne zadovoljava zahteve: mora sadržavati najmanje 1 veliko slovo i najmanje 2 broja.";
    }

    // Provera dužine lozinke i ponovljene lozinke
    $password_errors = passwordLengthAndPasswordRepeated($password, $repeat_password);

    if (!empty($password_errors)) {
        // Ako postoje greške, ispisujemo ih
        foreach ($password_errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Ako nema grešaka, nastavljamo s ostalim proverama i ubacivanjem u bazu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        insertUsernameIntoDatabase($conn, $username);
        isValidEmail($conn, $email);
        insertUserInDatabase($conn, $email, $username, $hashed_password);
    }
}
?>
