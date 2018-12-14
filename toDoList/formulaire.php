<?php


class taches{

public function __construct($param = array()) {   
    $this->text = $param['text'];
    $this->archived = $param['archived'];
    }
}

if(isset($_POST['submit']) && isset($_POST['tache']) && !empty($_POST['tache'])){

    $reponse = array(
        'tache' => FILTER_SANITIZE_STRING,
    );
    $result = filter_input_array(INPUT_POST, $reponse);

    // décoder le fichier json
    $fileJson = file_get_contents("todo.json");
    $jsonDecode = json_decode($fileJson, true);

    // tester la validité de l'entrée et ecrire sur le json
    if ($result != null AND $result != FALSE && !empty($_POST['tache'])) {

        $todo = new taches(array("text" => $_POST['tache'], "archived" => false));
        
        array_push($jsonDecode,$todo);
        $todo="";
        $_POST['tache']="";

    }else{
        // print_r("champ non valide");
    }
    // réencodage du fichier json
    $jsonEncode = json_encode($jsonDecode, JSON_FORCE_OBJECT);
    file_put_contents('todo.json',$jsonEncode);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <META http-equiv="Cache-Control" content="no-cache"> 
    <META http-equiv="Pragma" content="no-cache"> 
    <META http-equiv="Expires" content="0"> 
    	<!-- CSS FONT -->
	<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Julius Sans One' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- MATERIALIZE -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
    <link rel="stylesheet" href="css/style.css">
    
    <title>toDoList</title>
</head>
<body>
    
    <div class="contentAll row">
        <div class="contentForm col-4 ">
            <div class="addTache">
                <h4>Ajouter une tâche</h4>
                <form method="POST" action="formulaire.php" class="row">
                    <input type="text" name="tache" id="tache" class="col-6">
                    <input type="submit" value="submit" name="submit" class="submit col-3">
                </form>
            </div>
            <div class="toDoList">
                <h4>A FAIRE</h4>
                <form method="POST" action="formulaire.php" id='formulaire'>
                <?php
                    //Test l'entrée bouton et le non vide tache
                    
                    
                    // affichage du fichier json
                    $fileJson = file_get_contents("todo.json");
                    $jsonDecode = json_decode($fileJson, true);

                    //  foreach ($jsonDecode as $key => $value) {

                    //         // var_dump($value);
                    //         if($value['archived']==false){
                               
                            
                    //        echo '
                    //        <div class ="contentNewTache">
                    //        <input type="checkbox" name="test[]" value="'.$key.'" id="check'.$key.'">

                    //         <p>'.$value['text'].'</p>
                    //         </div>';
                    //         }
                            
                    // }
                      
                    
                    
                    ?>
                <input type="submit" name="submitArchive" class="submit" value="Enregistrer" id="enregistrer">
                </form>
           </div>
           <div class="archive" id="archive">
                <h4>Archive</h4>
                    <?php 
                    $affichArch = array();

                        if(isset($_POST['submitArchive']) || isset($_POST['submit'])){

                                foreach ($_POST['test'] as $key) {

                                        $jsonDecode[$key]['archived']=true;   

                                        $jsonEncode = json_encode($jsonDecode, JSON_FORCE_OBJECT);
                                        file_put_contents('todo.json',$jsonEncode);

                                        
                                    }
                        }
                        //             foreach ($jsonDecode as $key => $value) {
            
                        //                 if($value['archived']==true){
                        //                     array_push($affichArch, $value);
                        //                 }
                        //             }
                        //                 foreach ($affichArch as $key => $value) {
                        //                     echo '<p>'.$value['text'].'   FAIT</p>';
                        //                 }
                             
                    ?>
           </div>
        </div>
    </div>
    <script src="./index.js"></script>
</body>
</html>