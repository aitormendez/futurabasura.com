<?php

error_log('Verificando la clase DropboxProvider...');

// Verificar si el autoloader de Composer se ha cargado correctamente.
if (!file_exists(__DIR__ . '/app/themes/sage/vendor/autoload.php')) {
    error_log('El autoloader de Composer no se ha encontrado.');
    exit('El autoloader de Composer no se ha encontrado.');
}

require_once __DIR__ . '/app/themes/sage/vendor/autoload.php';

error_log('Autoloader incluido exitosamente.');

// Comprobar si la clase existe después de incluir el autoloader.
if (!class_exists(\App\DropboxProvider::class)) {
    error_log('La clase DropboxProvider no existe.');
    exit('La clase DropboxProvider no existe.');
} else {
    error_log('La clase DropboxProvider está disponible.');
}

// Si la clase está disponible, procede con el resto del código.
error_log('authorize.php accedido');

use App\DropboxProvider;

$provider = new DropboxProvider([
    'clientId'     => getenv('DROPBOX_CLIENT_ID_AITOR'),
    'clientSecret' => getenv('DROPBOX_CLIENT_SECRET_AITOR'),
    'redirectUri'  => getenv('DROPBOX_REDIRECT_URI_AITOR'),
]);

error_log('Proveedor de Dropbox inicializado.');

// Continuar con la generación de la URL de autorización
$authorizationUrl = $provider->getAuthorizationUrl();
$_SESSION['oauth2state'] = $provider->getState();

error_log('URL de autorización generada: ' . $authorizationUrl);
error_log('Estado generado: ' . $_SESSION['oauth2state']);

header('Location: ' . $authorizationUrl);
exit;
