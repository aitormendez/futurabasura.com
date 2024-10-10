<?php

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use App\DropboxProvider;
use App\Providers\DropboxServiceProvider;

session_start();

// Incluir el autoloader de Composer
require_once __DIR__ . '/app/themes/sage/vendor/autoload.php';

// Registrar mensajes de depuración
error_log('callback.php accedido');
error_log('Parámetros GET: ' . json_encode($_GET));

// Verificar si se ha recibido un "challenge" de Dropbox para la verificación del webhook.
if (isset($_GET['challenge'])) {
    header('Content-Type: text/plain');
    echo $_GET['challenge'];
    exit;
}

// Instanciar el proveedor de Dropbox
$provider = new DropboxProvider([
    'clientId'     => getenv('DROPBOX_CLIENT_ID_AITOR'),
    'clientSecret' => getenv('DROPBOX_CLIENT_SECRET_AITOR'),
    'redirectUri'  => getenv('DROPBOX_REDIRECT_URI_AITOR'),
]);

// Verificar si el estado de la solicitud de OAuth es válido.
if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    error_log('Estado inválido. Esperado: ' . $_SESSION['oauth2state'] . ', recibido: ' . $_GET['state']);
    unset($_SESSION['oauth2state']);
    exit('Estado inválido en la autenticación con Dropbox.');
} else {
    error_log('Estado válido. Procediendo a obtener el token de acceso.');
}

try {
    // Obtener el token de acceso usando el código recibido en la redirección.
    $accessToken = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Registrar los tokens obtenidos
    error_log('Access Token: ' . $accessToken->getToken());
    error_log('Refresh Token: ' . $accessToken->getRefreshToken());
    error_log('Expires: ' . $accessToken->getExpires());

    // Almacenar el token de forma segura para su uso posterior.
    DropboxServiceProvider::saveTokens($accessToken);

    echo 'Autenticación completada exitosamente. Ahora puedes utilizar el token almacenado para subir archivos a Dropbox.';
} catch (IdentityProviderException $e) {
    error_log('Error al obtener el token de acceso: ' . $e->getMessage());
    exit('Error al obtener el token de acceso: ' . $e->getMessage());
}
