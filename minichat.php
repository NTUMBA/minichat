<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <title>mini_chat</title>
  </head>
  <body>
    <form action="minichat_post.php" method="post">
    <p><label for="speudo">pseudo</label> : <input type="text" name="pseudo" id="pseudo"/></p>
    <p><label for="message">message</label> :  <input type="text" name="message" id="message"/></p>
    <p><input type="submit" value="Envoyer"/></p>
    </form>
    <?php
    // Connexion à la base de données
    // PHP essaie d'exécuter les instructions à l'intérieur du bloctry.
    // Si au contraire tout se passe bien, PHP poursuit l'exécution du code et ne lit pas ce qu'il y a dans le bloccatch.
    try
    {
    	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    }
    //test est le nom de notre base de données
    catch(Exception $e)
    {
      //S'il y a une erreur, il rentre dans le bloccatchet fait ce qu'on lui demande (ici, on arrête l'exécution de la page en affichant un message décrivant l'erreur)
            die('Erreur : '.$e->getMessage());
    }
    // Les requêtes proprement dites

    $response = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');

    while ($data = $response->fetch())
    {
    // Chaque fois qu'on fait une boucle,fetch va chercher dans $reponsel'entrée suivante et organise les champs dans l'array$donnees.
    	echo '<p>' . htmlspecialchars($data['pseudo']) . ': ' . htmlspecialchars($data['message']) . '</p>';
    }
    $response->closeCursor();
    // closecursor() termine le traitement de la requête
    ?>

  </body>

</html>
