<?php

namespace App\Providers;

use App\DropboxProvider;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Client\Token\AccessToken;

class DropboxServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(DropboxProvider::class, function () {
            return new DropboxProvider([
                'clientId'                => getenv('DROPBOX_CLIENT_ID_AITOR'),
                'clientSecret'            => getenv('DROPBOX_CLIENT_SECRET_AITOR'),
                'redirectUri'             => getenv('DROPBOX_REDIRECT_URI_AITOR'),
            ]);
        });

        error_log('Client ID: ' . getenv('DROPBOX_CLIENT_ID_AITOR'));
        error_log('Client Secret: ' . getenv('DROPBOX_CLIENT_SECRET_AITOR'));
        error_log('Redirect URI: ' . getenv('DROPBOX_REDIRECT_URI_AITOR'));
    }

    public function boot()
    {
        // Puedes cargar las configuraciones adicionales si es necesario durante el proceso de inicialización.
    }

    public static function saveTokens(AccessToken $accessToken)
    {
        // Definir la ruta de almacenamiento
        $upload_dir = wp_upload_dir();
        $tokensPath = $upload_dir['basedir'] . '/tokens.json';

        $data = [
            'access_token' => $accessToken->getToken(),
            'refresh_token' => $accessToken->getRefreshToken(),
            'expires' => $accessToken->getExpires(),
        ];

        $result = file_put_contents($tokensPath, json_encode($data));
        if ($result === false) {
            error_log('Error al guardar el archivo tokens.json en ' . $tokensPath);
        } else {
            error_log('Archivo tokens.json guardado exitosamente en ' . $tokensPath);
        }
    }

    public static function loadTokens()
    {
        $upload_dir = wp_upload_dir();
        $tokensPath = $upload_dir['basedir'] . '/tokens.json';

        if (!file_exists($tokensPath)) {
            error_log('El archivo tokens.json no existe en ' . $tokensPath);
            return null;
        }

        $data = json_decode(file_get_contents($tokensPath), true);
        return new AccessToken($data);
    }
}
