<?php
session_start();
// CONNECTION TO DATABASE
$mysqli = new mysqli("localhost", "root", "", "kitchen_spurs");
// echo $mysqli ? 'connected' : 'not connected';
// CONNECTION TO DATABASE