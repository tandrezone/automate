<?php
/**
 * @Entity @Table(name="{{name}}s")
 **/
class {{name}} extends model
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;
  /** @Column(type="string") **/
  protected $name;

/**
 * [getId]
 * @return [int]
 */
  public function getId()
  {
      return $this->id;
  }

/**
 * [getName]
 * @return [string]
 */
  public function getName()
  {
    return $this->name;
  }

/**
 * [setName]
 * @param [string] $name
 */
  public function setName($name)
  {
    $this->name = $name;
  }
}
