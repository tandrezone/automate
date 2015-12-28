<?php
/**
 * Automate is a package generator for css and js files
 * This gets the files from a repository file and based on a automate.json the program knows what components needs to download
 */
  class automate{
    private $file;
    private $rep;
    private $dir;

/**
 * Automate configurtations
 * @param [string] $jsonFile       config file of the application, automate.json
 * @param string $repositoryFile file with the links for the packages
 */
    function __construct($jsonFile, $repositoryFile = 'automate.config') {
      $this->rep = $repositoryFile;
      $this->file = $jsonFile;
    }
    /**
     * This creates a package file system that can be implemented in any app
     * @param  [string] $name    the name of the package
     * @param  [string] $version the version of the package
     * @param  [string] $type    the type of the package can be js css or package
     * @param  [array $files   list of files in this package
     * @return [array]          array of packages
     */
    function createRep($name, $version, $type, $files) {
      $package = new stdClass();
      $package->name = $name;
      $package->version = $version;
      $package->files = $files;
      $package->type = $type;
      $this->repository[] = $package;
    }

/**
 * return list of packages
 * @return [array] list of packages
 */
    function getRep(){
      var_dump($this->repository);
    }
    /**
     * generate a file repository, this file is a json of the list of packages available to all apps
     * @return [type] [description]
     */
    function generateRep(){
      $gen = json_encode($this->repository);
      file_put_contents($this->rep, $gen);
    }

    /**
     * get my app  config, this method get's my config file for this specific app, in this app i config the folder for where the packages go and the list of my needed packages
     * @return [type] [description]
     */
    function getConfig(){
      $conf = file_get_contents($this->file);
      $conf = json_decode($conf);
      $this->dir = $conf->config->dir;
      $requires = $conf->require;
      foreach ($requires as $req => $key) {
        $this->get_pack($req,$key);
      }
    }

    /**
     * install packages, this method get's the packages that i want, search for them in the repository file and if find install 
     * @param  [string] $name    Name of the packages that i want
     * @param  [string] $version Version of the package that i want
     * @return [type]          [description]
     */
    function get_pack($name, $version){
      $rep = json_decode(file_get_contents($this->rep));
      for($i = 0; $i < sizeof($rep); $i++) {
        if($rep[$i]->name == $name) {
          if($rep[$i]->version == $version) {
            $files = $rep[$i]->files;
            $type = $rep[$i]->type;
            foreach($files as $file){
              $f = file_get_contents($file);
              mkdir($this->dir."/".$type);
              file_put_contents($this->dir."/".$type."/".$name.".js", $f);
            }
          }
        }
      }
    }
  }

$a = new automate("automate.json", "automate.config");
/*
$a->createRep("angularjs", "1.4.2", array("https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"));
$a->createRep("jquery", "1", array("https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"));
$a->createRep("jquery", "2", array("https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"));
$a->generateRep();
*/
$a->getConfig();
