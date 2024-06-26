<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validar los datos del formulario
    if (empty($name) || empty($email) || empty($message)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de email no válido.";
        exit;
    }

    // Configuración del correo
    $to = "tu_correo@dominio.com"; // Reemplaza con tu dirección de correo
    $subject = "Nuevo mensaje de contacto de $name";
    $body = "Nombre: $name\nEmail: $email\n\nMensaje:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Enviar el correo
    if (mail($to, $subject, $body, $headers)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Hubo un problema al enviar el mensaje. Por favor, inténtelo de nuevo más tarde.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
