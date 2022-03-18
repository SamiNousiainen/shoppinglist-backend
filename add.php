<?php

require_once './inc/functions.php';
require_once './inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$description = filter_var($input->description, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$amount = filter_var($input->amount, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


try {
    $db = openDb();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $db->prepare('insert into item(description, amount) values (:description, :amount)');
    $query->bindValue(':description', $description . PDO::PARAM_STR, PDO::PARAM_INT);
    $query->bindValue(':amount', $amount . PDO::PARAM_INT);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $db->lastInsertId(), 'description' => $description, 'amount' => $amount);
    print json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}