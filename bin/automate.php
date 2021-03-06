<?php
/**
 * This file is a command line app, is used to generate files from a template in src
 */
$SRC = "/packages/moonlight/src";
$APP = "/app";
$PACK = "/package";
error_reporting(0);
if(isset($argv[1])) {
  switch ($argv[1]) {
    case "create":
      switch ($argv[2]) {
        case 'controller':
            create_controller($argv[3],$argv[4]);
        break;
        case 'model':
          create_model($argv[3]);
        break;
        case 'routing':
          create_routing($argv[3]);
        break;
        case 'crud':
            create_crude($argv[3],$argv[4]);
        break;
        case 'tables':
            create_tables();
        break;
        case 'package':
          create_package($argv[3],$argv[4]);
        break;
        default:
          help();
        break;
      }
    break;
    default:
      help();
    break;
  }
} else{
  help();
}
function create_package($folder, $package){
  if (!file_exists($PACK.$folder)) {
    mkdir($PACK.$folder);
  }
  if (!file_exists($PACK.$folder."/".$package)) {
    mkdir($PACK.$folder."/".$package);
  }
  $data = file_get_contents($SRC."/composer.json");
  file_put_contents($PACK.$folder."/".$package."/composer.json", $data);
}
function help(){
  echo "Help:\n";
  echo "Comands List:\n";
  echo "create:\n";
  echo "- crud {name}\n";
  echo "- crud {name} empty\n";
  echo "- controller {name} \n";
  echo "- controller {name} empty\n";
  echo "- model {name} \n";
  echo "- tables\n";
}
function create_controller($name,$empty){
  if($empty == "empty"){
    $ctrl = file_get_contents($SRC."controllerEmpty.php");
  } else {
    $ctrl = file_get_contents($SRC."controller.php");
  }
  $new_ctrl =str_replace("{{name}}", $name, $ctrl);
  file_put_contents($APP."controllers/".$name."s.php", $new_ctrl);
  echo "Controller ".$name." created with success\n";
}

function create_model($name){
  $model = file_get_contents($SRC."model.php");
  $new_model =str_replace("{{name}}", $name, $model);
  file_put_contents($APP."models/".$name.".php", $new_model);
  echo "Model ".$name." created with success\n";
}

function create_routing($name){
  $rout = file_get_contents($SRC."routing.php");
  $new_rout =str_replace("{{name}}", $name, $rout);
  file_put_contents($APP."routing.php", $new_rout,FILE_APPEND );
  echo "Routing ".$name." created with success\n";
}
function create_tables(){
    exec(".\packages\bin\doctrine orm:schema-tool:create");
    echo "Tables created with success\n";
}
function create_crude($name,$empty){
  create_controller($name, $empty);
  create_model($name);
  create_routing($name);
  create_tables();
  echo "Crud ".$name." created with success\n";
}
?>
