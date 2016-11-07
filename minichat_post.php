<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'dvlpnum');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
// sécurité XSS
// $pseudo=htmlspecialchars($_POST['sobriquet']);
// $message=htmlspecialchars(['note']);
// Insertion du message à l'aide d'une requête préparée
$response = $bdd->prepare('INSERT INTO minichat (pseudo, message) VALUES(?, ?)');
$pseudo = $_POST['pseudo'];
$message = $_POST['message'];

$response->execute(array($pseudo, $message));

// Redirection du visiteur vers la page du minichat
header('Location: minichat.php');
// La fonction header() permet d'envoyer ce qu'on appelle des « en-têtes HTTP ».
// C'est le protocole qu'utilisent le serveur et le client pour échanger des pages web.
// Ici, on utilise une des possibilités de HTTP qui commande une redirection via la commande Location
// Par rapport à d'autres types de redirection (comme la balise <meta>),
// cette technique a l'avantage d'être instantanée et transparente pour l'utilisateur.
// De plus, s'il rafraîchit ensuite la page minichat.php,
// il ne risque pas d'avoir le message souvent gênant et déroutant : « Pour afficher cette page,
// les informations précédemment transmises doivent être renvoyées. Êtes-vous sûr de vouloir le faire ? ».
?>
