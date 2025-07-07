<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome']; 
    $email_remetente = $_POST['email'];
    $mensagem = $_POST['mensagem']; 

    $destinatario = "projetointegrador814@gmail.com";
    $assunto = "Nova mensagem do site";

    $corpo_email = "Você recebeu uma nova mensagem de contato:<br><br>";
    $corpo_email .= "Nome: " . htmlspecialchars($nome) . "<br>";
    $corpo_email .= "Email: " . htmlspecialchars($email_remetente) . "<br>";
    $corpo_email .= "Mensagem:<br>" . nl2br(htmlspecialchars($mensagem));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'projetointegrador814@gmail.com';
        $mail->Password = 'tqitqxxckzndkdvm';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('projetointegrador814@gmail.com', 'Site - Projeto Integrador');
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = $corpo_email;

        $mail->send();

        echo "<h1>Mensagem enviada com sucesso!</h1>";
        echo "<p>Obrigado por entrar em contato, " . htmlspecialchars($nome) . ". Responderemos em breve.</p>";
        echo "<a href='index.php'>Voltar para a Homepage</a>";

    } catch (Exception $e) {
        echo "<h1>Falha no envio do e-mail.</h1>";
        echo "<p>Erro: {$mail->ErrorInfo}</p>";
        echo "<a href='index.php'>Voltar para a Homepage</a>";
    }

} else {
    echo "Acesso Negado! Esta página deve ser acessada através do formulário de contato.";
    exit;
}
?>
