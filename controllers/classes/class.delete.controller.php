<?php
require '../../database/database.php';
require '../../models/class.model.php';
require '../../models/user_join_class/class.model.php';

// ========check class id =======
$id = $_GET['id'] ? $_GET['id'] : null;
if (isset($id)) {

    deleteClassJoin($id);
    deleteClass($id);
    header('Location: /home');
}
?>