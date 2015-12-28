<?php
$router->map('GET','/{{name}}s', '{{name}}s.index', '{{name}}s_index');                      //LIST OF ALL USERS
$router->map('POST','/{{name}}s/new', '{{name}}s.create', '{{name}}s_create');               //CREATE NEW USER       C
$router->map('GET','/{{name}}s/[i:id]', '{{name}}s.show', '{{name}}s_show');                 //LIST OF USER ID       R
$router->map('GET|POST','/{{name}}s/edit/[i:id]', '{{name}}s.edit', '{{name}}s_edit');       //UPDATE USER           U
$router->map('POST','/{{name}}s/delete/[i:id]', '{{name}}s.delete', '{{name}}s_delete');     //DELETE USER           D
?>
