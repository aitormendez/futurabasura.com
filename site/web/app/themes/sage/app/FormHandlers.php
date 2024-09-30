<?php

namespace App;

use Spatie\Dropbox\Client as DropboxClient;

add_action('html_forms_submission', function ($submission, $form) {
    // Validar y sanitizar los campos del formulario
    $name = sanitize_text_field($submission['name']);
    $surname = sanitize_text_field($submission['surname']);
    $email = sanitize_email($submission['emailAddress']);
    $message = sanitize_textarea_field($submission['message']);

    // Manejar el archivo subido
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Verificar que sea un archivo ZIP
        $allowedExtensions = ['zip'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (in_array($fileExtension, $allowedExtensions)) {
            // Inicializar el cliente de Dropbox
            $dropboxAccessToken = getenv('DROPBOX_ACCESS_TOKEN'); // Utiliza una constante o variable segura
            $client = new DropboxClient($dropboxAccessToken);

            // Ruta en Dropbox donde se guardará el archivo
            $dropboxFilePath = '/uploads/' . $fileName;

            // Leer el contenido del archivo
            $fileContent = file_get_contents($fileTmpPath);

            try {
                // Subir el archivo a Dropbox
                $client->upload($dropboxFilePath, $fileContent, 'add');

                // Opcional: Obtener un enlace compartido al archivo
                $sharedLink = $client->createSharedLinkWithSettings($dropboxFilePath);

                // Enviar un correo electrónico con la información y el enlace al archivo
                $to = 'tu_correo@example.com';
                $subject = 'Nuevo envío de formulario';
                $body = "Nombre: $name\nApellido: $surname\nEmail: $email\nMensaje: $message\nEnlace al archivo: {$sharedLink['url']}";
                wp_mail($to, $subject, $body);
            } catch (\Exception $e) {
                // Manejar errores
                error_log('Error al subir el archivo a Dropbox: ' . $e->getMessage());
                // Puedes mostrar un mensaje de error al usuario si lo deseas
            }
        } else {
            // El archivo no es un ZIP válido
            echo 'Por favor, sube un archivo ZIP válido.';
        }
    } else {
        // Error al subir el archivo
        echo 'Error al subir el archivo.';
    }
}, 10, 2);
