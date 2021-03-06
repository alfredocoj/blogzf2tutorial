<?php

namespace Admin\Entity;

class Usuario
{
     /**
     * Nome da tabela. Campo obrigatório
     * @var string
     */
    protected $tableName ='users';

    /**
     * @var int
     */
    protected $usr_id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $valid;

    /**
     * @var string
     */
    protected $role;

    /**
     * Primary Key field name
     *
     * @var string
     */
    protected $primaryKeyField = 'usr_id';

    /**
     * Magic getter to expose protected properties.
     *
     * @param  string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed  $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray( array $values )
    {
        foreach( $this as $key => $value )
            if( isset( $values[$key] ) )
                $this->$key = $values[ $key ];
    }

    /**
     * Set all entity data based in an array with data
     *
     * @param array $data
     * @return void
     */
    public function setData($data)
    {
        foreach($data as $key => $value) {
            $this->__set($key, $value);
        }
    }

    /**
     * Return all entity data in array format
     *
     * @return array
     */
    public function getData()
    {
        $data = get_object_vars($this);
        unset($data['tableName']);
        unset($data['primaryKeyField']);
        return array_filter($data);
    }

    public function getTableName()
    {
        return $this->tableName;
    }
}
