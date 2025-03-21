<?php
require('../inc/db_config.php');
require('../inc/essentials.php');

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // matching passwords
    if ($data['pass'] != $data['cpass']) {
        echo 'Mismatched Password';
        exit;
    }

    // check user exist
    $u_exist = select("SELECT * FROM `user` WHERE `email`=? OR `phonenum`=? LIMIT 1", [$data['email'], $data['phonenum']], "ss");
    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'Email_already' : 'Phone_already';
        exit;
    }

    // Upload user image to the server
    $img = uploadUserImage($_FILES['profile']);
    if ($img == 'inv_img') {
        echo 'Invalid Image';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'Upload Failed';
        exit;
    }

    // Encrypt password
    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    // Insert user into database
    $query = "INSERT INTO `user`( `name`, `email`, `phonenum`, `profile`, `gender`, `dob`, `password`) 
    VALUES (?,?,?,?,?,?,?)";

    $values = [
        $data['name'],
        $data['email'],
        $data['phonenum'],
        $img,
        $data['gender'],
        $data['dob'],
        
        $enc_pass
    ];

    if (insert($query, $values, "sssssss")) {
        alert('success', "Registration Completed");
    } else {
        echo 0;
    }
}






?>