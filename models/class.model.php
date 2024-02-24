<?php
// function get classes
function getClasses(): array
{
    global $connection;
    $statement = $connection->prepare("select * from classes order by id desc");
    $statement->execute();
    return $statement->fetchAll();
}

// function create class
function createClass(string $title, string $section, string $subject, int $user_id, int $category_id, string $image): bool
{
    global $connection;

    $statement = $connection->prepare("insert into classes(title, section, subject, archive, user_id, category_id, image) values(:title, :section, :subject,  :archive,  :user_id,:category_id, :image )");
    $statement->execute([
        ':title' => $title,
        ':section' => $section,
        ':subject' => $subject,
        ':user_id' => $user_id,
        ':archive' => 0,
        ':category_id' => $category_id,
        ':image' => $image
    ]);

    return $statement->rowCount() > 0;
}

// function get class by id
function getClass(int $id)
{
    global $connection;
    $statement = $connection->prepare("select * from classes where id = :id");
    $statement->execute([':id' => $id]);
    return $statement->fetch();
    
}

// function update class
function updateClass(string $title, string $section, string $subject, int $id): bool
{
    global $connection;
    $statement = $connection->prepare("update classes set title = :title, section = :section, subject = :subject where id = :id");
    $statement->execute([
        ':title' => $title,
        ':section' => $section,
        ':subject' => $subject,
        ':id' => $id

    ]);

    return $statement->rowCount() > 0;
}

// function delete class
function deleteClass(int $id): bool
{
    global $connection;
    $statement = $connection->prepare("delete from classes where id = :id");
    $statement->execute([':id' => $id]);
    return $statement->rowCount() > 0;
}
