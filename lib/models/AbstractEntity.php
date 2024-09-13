<?php
namespace lib\models;


/**
 * Abstract class that centralise all methods common to all DB entities
 */
abstract class AbstractEntity
{
    // The default value of id is -1, in order to easily check if the entity is a new one
    protected int $id = -1;

    /**
     * Class constructor
     * If an associative array is passed as param, we hydrate the entity
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Entity hydration system.
     * Transform the data of an associative array.
     * Table fields names needs to match the entity attributes.
     * Underscores are transformed into camelCase (ex : date_creation becomes setDateCreation).
     * @return void
     */
    protected function hydrate(array $data) : void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    public function setId(int $id) : void
    {
        $this->id = $id;
    }


    public function getId() : int
    {
        return $this->id;
    }
}