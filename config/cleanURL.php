<?php
 function clean_string($string)
{
    $this->string_clean = str_replace("<", "", $string);
    $this->string_clean = str_replace(">", "", $string);
    $this->string_clean = str_replace("'", "", $string);
    $this->string_clean = str_replace(" ", "", $string);
    $this->string_clean = str_replace("/", "", $string);
    $this->string_clean = str_replace("@", "", $string);
    
    if(trim($string) == ""){
    		die ("invalid VALUE");
    	}
    	else
    		return "$string_clean";
}	
?>
