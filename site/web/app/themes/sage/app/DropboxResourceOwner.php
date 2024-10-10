<?php

namespace App;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class DropboxResourceOwner implements ResourceOwnerInterface
{
    /**
     * Información de la cuenta de Dropbox del usuario autenticado.
     *
     * @var array
     */
    protected $response;

    /**
     * Constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * Devuelve la información del propietario de la cuenta.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }

    /**
     * Devuelve el identificador único del propietario.
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['account_id'] ?? null;
    }

    /**
     * Devuelve el nombre del propietario de la cuenta.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->response['name']['display_name'] ?? null;
    }

    /**
     * Devuelve el correo electrónico del propietario de la cuenta.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->response['email'] ?? null;
    }
}
