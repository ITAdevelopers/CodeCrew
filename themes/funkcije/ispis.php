<?php
class Funkcije{

public function meni($stranice_menu){
foreach($stranice_menu as $menu){

echo "<li><a href='". URL . "index.php?title=".$menu["title']."'"> $menu['title'] ?></a></li>

}

}

}
?>