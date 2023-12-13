<?php

    include_once('style.php');
    require_once('connection.php');
    include_once('navbar.php');

?>

<div id="chat-widget">
        <div id="chat-circle" class="btn btn-raised">
            <img src="img/david.jpg" alt="Vaša slika">
        </div>
        <div class="chat-box">
            <div class="chat-box-header">
                <span>Poruka od admina</span>
                <button class="chat-box-toggle">x</button>
            </div>
            <div class="chat-box-body">
                <div class="chat-box-message">
                    <span>Dobrodošli! Kako vam mogu pomoći?</span>
                </div>
            </div>
            <div class="chat-input">
                <input type="text" id="user-message" placeholder="Unesite poruku...">
                <button id="send-message">Pošalji</button>
            </div>
        </div>