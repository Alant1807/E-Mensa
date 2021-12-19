<?php

function insertUser($email, $password, $withadmin)
{
    $link = connectdb();
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);
    mysqli_begin_transaction($link);
    $statement = mysqli_stmt_init($link);
    if ($withadmin) {
        mysqli_stmt_prepare($statement,
            "INSERT INTO benutzer (email,passwort,admin,anzahlanmeldungen,letzteanmeldung)VALUES(?,?,1,1,NOW())");
    } else {
        mysqli_stmt_prepare($statement,
            "INSERT INTO benutzer (email,passwort,admin,anzahlanmeldungen,letzteanmeldung)VALUES(?,?,0,1,NOW())");
    }
    mysqli_stmt_bind_param($statement, 'ss', $email, $password);
    mysqli_stmt_execute($statement);
    mysqli_commit($link);
    mysqli_close($link);
}

function getUser($user)
{
    $link = connectdb();
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement,
        "SELECT * FROM benutzer WHERE email = (?)");
    mysqli_stmt_bind_param($statement, 's',
        $user);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $data = mysqli_fetch_array($result);
    mysqli_free_result($result);
    mysqli_close($link);
    return $data;

}

function update_user($email, $success)
{
    $link = connectdb();
    $email = mysqli_real_escape_string($link, $email);
    mysqli_begin_transaction($link);
    $statement = mysqli_stmt_init($link);
    if ($success) {
        mysqli_stmt_prepare($statement,
            "UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1 WHERE email = (?)");
        mysqli_stmt_bind_param($statement, 's',
            $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_prepare($statement,
            "UPDATE benutzer 
                  SET letzteanmeldung = NOW()
                  WHERE email = (?);");
    } else {
        mysqli_stmt_prepare($statement,
            "UPDATE benutzer SET anzahlfehler = anzahlfehler + 1 WHERE email = (?)");
        mysqli_stmt_bind_param($statement, 's',
            $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_prepare($statement,
            "UPDATE benutzer 
                  SET letzterfehler = NOW()
                  WHERE email = (?);");
    }
    mysqli_stmt_bind_param($statement, 's',
        $email);
    mysqli_stmt_execute($statement);
    mysqli_commit($link);
    mysqli_close($link);
}

function resetUser($email, $password){
    $link = connectdb();
    $password = mysqli_real_escape_string($link, $password);
    mysqli_begin_transaction($link);
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement,
        "UPDATE benutzer SET passwort = (?) WHERE email = (?)");
    mysqli_stmt_bind_param($statement, 'ss',
        $email, $password);
    mysqli_stmt_execute($statement);
}

function insertNewsletter($benutzername,$email,$language){
    $link = connectdb();
    $benutzername = mysqli_real_escape_string($link,$benutzername);
    $email = mysqli_real_escape_string($link,$email);
    mysqli_begin_transaction($link);
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement,"INSERT INTO newsletteranmeldungen (name,email,sprache) VALUES (?,?,?)");
    mysqli_stmt_bind_param($statement, 'sss', $benutzername,$email,$language);
    mysqli_stmt_execute($statement);
    mysqli_commit($link);
    mysqli_close($link);
}
