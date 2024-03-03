<?php

// ========Get all students============
function getStudents()
{

    global $connection;
    $statement = $connection->prepare("select u.id, u.name, u.email, u.image, c.id, c.title, uj.join_date from users u 
    inner join users_join_class uj on uj.user_id= u.id
    inner join classes c on uj.class_id = c.id
    where u.role = :role
    ");
    
    $statement->execute([":role"=>"student"]);
    return $statement->fetchAll();
}