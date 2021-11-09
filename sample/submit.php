<?php
// Include the database configuration file
require_once 'dbConfig.php';

$editorContent =$title = $img = $tag = $statusMsg = '';
$author="DK-2021";

// If the form is submitted
if(isset($_POST['submit'])){
    // Get editor content
    $editorContent = $_POST['editor'];
    $title = $_POST['title'];
    $tag = $_POST['tag'];
    $filepath = "static/" . $_FILES["img"]["name"];

    if (move_uploaded_file($_FILES["img"]["tmp_name"], $filepath)) {
        echo "Transfer done";
    } else {
        echo "Error !!";
    }
    // Check whether the editor content is empty
    if(!empty($editorContent)){
        // Insert editor content in the database
        $insert = $db->query("INSERT INTO blog(title,img,tag,content,author) VALUES ('$title','$filepath','$tag','".$editorContent."', '$author')");
        
        // If database insertion is successful
        if($insert){
            $statusMsg = "The editor content has been inserted successfully.";
        }else{
            $statusMsg = "Some problem occurred, please try again.";
        } 
    }else{
        $statusMsg = 'Please add content in the editor.';
    }
}

echo($statusMsg);
?>