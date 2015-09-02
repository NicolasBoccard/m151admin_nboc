<?php

/*
  Created on : 02 septembre 2015
  Author     : Nicolas Boccard
 */

function afficher_profil($tableau)
{
    for ($i = 0; $i < count($tableau); $i++)
    {
        for ($j = 1; $j < 3; $j++)
        {
            echo $tableau[$i][$j];
            echo "<br/>";
        }
        echo "<input type=\"submit\" name=" . $tableau[$i][0] . " value=\"détail\"/>";
        echo "<br/>";
        echo '----------------------------------------------------------';
        echo "<br/>";
    }
}
