<?php
    
class Work_file{
    
/******************************
Klasa za rad sa fajlovima

******************************/




/* Metod za upload fajlova na server
metod vraca poruku tj status uploada....

 */
public  function upload_file(){

    $dozvoljeni_formati = array('jpg', 'png', 'gif', 'pdf', 'doc');

    $file = explode(".", $_FILES['file']['name']);

    $temp = end($file);


 
 if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg")
   || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 2000000) && in_array($temp, $dozvoljeni_formati)){
       
       if(is_uploaded_file($_FILES['file']['tmp_name']) || $_FILES["file"]["error"] < 1){
            
            if(file_exists(BASE_PATH . "/uploads/" . $_FILES['file']['name'])){
                $date = new date('d-m-Y');
                $_FILES['file']['name'] = $file[0] . $date . "." . $temp;

            }

           move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $_FILES['file']['name']);

           $status = 'Uspesno uploadovan fajl';
           return $status;
           

       }else{
           $status = 'Dogodila se greska prilikom uploada.';
           return $status;
       }


   }else{
       $status = 'Fajl je u ne odgovarajucem formatu.';
       return $status;
   }

   
}
//Vraca sve fajlove iz izabranog direktorijuma
public  function list_dir_uploads($dir){

    $dir = opendir($dir);
    $lista = array();
   while($file = readdir($dir)){
       $lista[] = $file;

   }
    $results = count($lista);
    $lista = array_slice($lista, 2, $results);
    closedir($dir);
    return $lista;



    
}



}

?>


