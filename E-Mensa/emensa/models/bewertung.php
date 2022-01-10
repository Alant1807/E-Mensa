<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<?php

function gericht_id_find($gericht_id): array
{
    $link = connectdb();
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement, "SELECT * FROM gericht WHERE id = (?)");
    mysqli_stmt_bind_param($statement, 'i', $gericht_id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $data = mysqli_fetch_array($result);
    mysqli_free_result($result);
    mysqli_close($link);
    return $data;
}

function Set_Bewertungen($bewertung)
{
    $link = connectdb();
    $_SESSION['email'] = mysqli_real_escape_string($link, $_SESSION['email']);
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement, "INSERT INTO bewertungen (bemerkung, sternebewertung, gericht_id, kunde)VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($statement, 'ssis',
        $bewertung['bemerkung'],
        $bewertung['bewertung'],
        $bewertung['gerichtID'],
        $_SESSION['email']
    );
    mysqli_stmt_execute($statement);
    mysqli_close($link);
}

function get_Bewertungen(): array
{
    $link = connectdb();
    $sql = "SELECT bewertungen.*, gericht.name FROM bewertungen,gericht WHERE gericht.id = bewertungen.gericht_id ORDER BY bewertungszeitpunkt DESC LIMIT 30";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}

function get_user_Bewertungen($user): bool|array|null
{
    $link = connectdb();
    $sql = "SELECT bewertungen.*, gericht.name FROM bewertungen,gericht WHERE gericht.id = bewertungen.gericht_id AND bewertungen.kunde = " . "'$user'" . " ORDER BY bewertungszeitpunkt DESC";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}

function removeRating($id){
    $link = connectdb();
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement, "DELETE FROM bewertungen WHERE gericht_id = (?)");
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    mysqli_close($link);
}
