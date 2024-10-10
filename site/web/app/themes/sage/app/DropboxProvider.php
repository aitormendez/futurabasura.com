<?php

namespace App;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use League\OAuth2\Client\Token\AccessTokenInterface;
use App\DropboxResourceOwner;

class DropboxProvider extends AbstractProvider
{
    use BearerAuthorizationTrait;

    protected $apiDomain = 'https://api.dropboxapi.com';
    protected $authDomain = 'https://www.dropbox.com';

    public function __construct(array $options = [], array $collaborators = [])
    {
        parent::__construct($options, $collaborators);
    }

    public function getBaseAuthorizationUrl()
    {
        return $this->authDomain . '/oauth2/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->apiDomain . '/oauth2/token';
    }

    public function getResourceOwnerDetailsUrl(AccessTokenInterface $token)
    {
        return $this->apiDomain . '/2/users/get_current_account';
    }

    protected function getDefaultScopes()
    {
        return ['account_info.read', 'files.content.write'];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw new \Exception($data['error_description'] ?? $response->getReasonPhrase());
        }
    }

    protected function createResourceOwner(array $response, AccessTokenInterface $token)
    {
        return new DropboxResourceOwner($response);
    }
}
