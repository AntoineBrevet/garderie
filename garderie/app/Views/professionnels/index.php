<h1>Page Professionnel</h1>

<?php

 foreach ($infos as $value){
     echo 'le ' . $value["date"] . ' de ' . $value["debut"] . 'h - ' . $value["fin"] . 'h || Session de ' . $value["debut_session"] . ' a ' . $value["fin_session"] . '<br>';
     echo $value["nom"] . ' ' . $value["prenom"] . ' - ' .$value["age"] . ' ans - ' . $value["sexe"] . '<br>';
     echo '<hr>';
 }