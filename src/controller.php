<?php
/**
 * Include model into controller
 */
include_once("app/models/{{name}}.php");
/**
 * This is the controller {{name}}
 * ControllerBase is the parent and have all the dependency injection
 */
class {{name}}s extends controller{

/**
 * [Run when we came to /{{name}}]
 * @return [View]
 */
  function index(){
    ${{name}}Rep = $this->em->getRepository('{{name}}');
    ${{name}}s = ${{name}}Rep->findAll();

    foreach ($users as $user) {
        echo ${{name}}->getName();
    }
  }

/**
 * [Run when we came to /{{name}}/new]
 * @return [View]
 */
  function create(){
    ${{name}} = new user();
    ${{name}}->setName($_POST['name']);
    ${{name}}->em->persist($user);
    ${{name}}->em->flush();
    echo "Created Product with ID " . ${{name}}->getId() . "\n";
  }
  /**
   * [Run when we came to /{{name}}/update/id]
   * @return [View]
   */
  function update($params){
    $id = $params['id'];
    $newName = $_POST['name'];
    ${{name}} = $this->em->find('{{name}}', $id);

    if (${{name}} === null) {
        echo "{{name}} $id does not exist.\n";
        exit(1);
    }
    ${{name}}->setName($newName);
    $this->em->flush();
  }

  /**
   * [Run when we came to /{{name}}/delete/id]
   * @param  [Array] $params [id]
   * @return [View]
   */
  function delete($params){
    $id = $params['id'];
    ${{name}} = $this->em->find('{{name}}', $id);

    if (${{name}} === null) {
        echo "{{name}} $id does not exist.\n";
        exit(1);
    }
    $this->em->remove(${{name}});
    $this->em->flush();
  }

  /**
   * [Run when we came to /{{name}}/id]
   * @param  [Array] $params [id]
   * @return [VIEW]         [String with text to display]
   */
  function show($params){
    $id = $params['id'];
    ${{name}} = $this->em->find('{{name}}', $id);
    if (${{name}} === null) {
        echo "{{name}} not found.\n";
        exit(1);
    }
    echo sprintf("-%s\n", ${{name}}->getName());
  }
}
