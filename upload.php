<?php
if ($_FILES['upload']) {
    $file = $_FILES['upload'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($file_ext, $allowed_ext)) {
        $file_new_name = uniqid() . '.' . $file_ext;
        $file_destination = 'uploads/' . $file_new_name;
        
        if (move_uploaded_file($file_tmp, $file_destination)) {
            $func_num = $_GET['CKEditorFuncNum'];
            $url = $file_destination;
            $message = '';
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($func_num, '$url', '$message');</script>";
        }
    }
}
?>
