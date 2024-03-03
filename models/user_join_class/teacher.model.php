<?php

// ========Get all teacher join class============
function getTeachers()
{

    global $connection;
    $statement = $connection->prepare("select u.id, u.name, u.email, u.image, c.id from users u 
    inner join users_join_class uj on uj.user_id= u.id
    inner join classes c on uj.class_id = c.id
    where u.role = :role
    ");
    $statement->execute([":role"=>"teacher"]);
    return $statement->fetchAll();
}