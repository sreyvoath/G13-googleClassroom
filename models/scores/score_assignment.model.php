<?php 

// ========Get score assignment============
function getScoreAssign(int $id)
{

    global $connection;
    $statement = $connection->prepare("select * from assignments where id = :id");
    $statement->execute([
        ":id"=> $id
    ]);
    return $statement->fetch();
}

// ========Get name student submitted assignment============
function getUserSubmitted(int $id)
{

    global $connection;
    $statement = $connection->prepare("select u.name from student_submit s
    inner join users u on u.id = s.user_id
    ");
    $statement->execute([
        ":id"=> $id
    ]);
    return $statement->fetch();
}

function getStudentAssigned(int $class_id, int $assignment_id)
{

    global $connection;
    $statement = $connection->prepare("select u.id, u.name, u.email, u.image, c.id as class_id , c.title, uj.join_date, s.document from users u 
    inner join users_join_class uj on uj.user_id= u.id
    inner join classes c on uj.class_id = c.id
    inner join assignments a on c.id = a.class_id
    inner join student_submit s on a.id = s.assignment_id
    where u.role = :role and c.id = :id and a.id = :assign_id 
    group by u.id 
    ");

    $statement->execute([
        ":role" => "student",
        ":id" => $class_id,
        ":assign_id" => $assignment_id,
    ]);
    return $statement->fetchAll();
}

function getStudentTurned(int $assignment_id)
{
    global $connection;
    $statement = $connection->prepare("select s.*, u.image, u.name, a.document from student_submit s
    inner join users u on u.id = s.user_id
    inner join assignments a on a.id = s.assignment_id
    where u.role = :role and a.id = :assign_id and s.status = :status
    
    ");

    $statement->execute([
        ":role" => "student",
        ":status" => true,
        ":assign_id" => $assignment_id,
        
    ]);
    return $statement->fetchAll();
}
function getStudentTurnedIn()
{
    global $connection;
    $statement = $connection->prepare("select u.* from users u 
    inner join turned_in t on t.student_id = u.id
    where u.role = :role 
    
    ");

    $statement->execute([
        ":role" => "student",
        
    ]);
    return $statement->fetchAll();
}
