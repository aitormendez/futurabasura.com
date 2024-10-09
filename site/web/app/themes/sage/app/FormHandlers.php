<?php

namespace App;

use Spatie\Dropbox\Client as DropboxClient;

// Asumimos que el autoloader de Composer ya está incluido en otra parte

add_action('hf_form_success', function ($form, $result) {

    // Obtener el token de acceso desde las variables de entorno
    $dropboxAccessToken = getenv('DROPBOX_ACCESS_TOKEN_AITOR');

    if (!$dropboxAccessToken) {
        // Si no se pudo obtener el token, registramos el error y terminamos
        error_log('Error: No se pudo obtener el token de acceso.');
        return;
    }

    // Inicializar el cliente de Dropbox
    $client = new DropboxClient($dropboxAccessToken);

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
                // Opcionalmente, puedes registrar que el archivo se subió correctamente
                // error_log('Archivo subido a Dropbox correctamente.');
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
