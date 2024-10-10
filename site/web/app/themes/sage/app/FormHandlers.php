<?php

namespace App;

use Spatie\Dropbox\Client as DropboxClient;
use App\Providers\DropboxServiceProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

// Asumimos que el autoloader de Composer ya está incluido en otra parte

add_action('hf_form_success', function ($form, $result) {
    // Cargar el token de acceso desde el almacenamiento (por ejemplo, un archivo JSON)
    error_log('Cargando tokens...');
    $accessToken = DropboxServiceProvider::loadTokens();

    if ($accessToken) {
        error_log('Access Token cargado: ' . $accessToken->getToken());
    } else {
        error_log('No se pudo cargar el Access Token.');
        return;
    }

    // Verificar si el token ha expirado y refrescarlo si es necesario
    if ($accessToken && $accessToken->hasExpired()) {
        $provider = resolve(DropboxProvider::class);

        try {
            // Solicitar un nuevo access token usando el refresh token
            $newAccessToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $accessToken->getRefreshToken(),
            ]);

            // Guardar el nuevo access token
            DropboxServiceProvider::saveTokens($newAccessToken);

            // Usar el nuevo token para la subida
            $accessToken = $newAccessToken;

            error_log('Token de acceso refrescado exitosamente.');
        } catch (IdentityProviderException $e) {
            error_log('Error al refrescar el token de acceso: ' . $e->getMessage());
            error_log('Respuesta de Dropbox: ' . json_encode($e->getResponseBody()));
            return;
        } catch (\Exception $e) {
            error_log('Error general al refrescar el token de acceso: ' . $e->getMessage());
            return;
        }
    }

    // Verificar si tenemos un token válido después de la carga o refresco
    if (!$accessToken || !$accessToken->getToken()) {
        error_log('Error: No se pudo obtener un token de acceso válido.');
        return;
    }

    // Inicializar el cliente de Dropbox con el token actualizado
    $client = new DropboxClient($accessToken->getToken());

    // Verificar si se recibió el archivo desde el formulario
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];

        // Leer el contenido del archivo
        $fileContent = file_get_contents($fileTmpPath);

        if ($fileContent !== false) {
            // Definir la ruta de destino en Dropbox
            $dropboxFilePath = '/uploads/' . $fileName;

            try {
                // Subir el archivo a Dropbox
                $client->upload($dropboxFilePath, $fileContent, 'add');
                error_log('Archivo subido a Dropbox correctamente.');
            } catch (\Exception $e) {
                // Registrar el error sin interrumpir el flujo
                error_log('Error al subir el archivo a Dropbox: ' . $e->getMessage());
            }
        } else {
            error_log('Error al leer el contenido del archivo.');
        }
    } else {
        error_log('No se ha recibido el archivo o hubo un error en la subida.');
        if (isset($_FILES['file'])) {
            error_log('Código de error al subir el archivo: ' . $_FILES['file']['error']);
        }
    }
}, 10, 2);
