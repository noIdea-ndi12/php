<?php
    //Root : Variable donnant le Chemin absolu jusqu'a la racine du projet
    define('ROOT',dirname(__FILE__));
    
    //WebRoot : Varaible donnant le chemin web a partir de la racine
    define('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));

    session_start();
    
    //Si p est vide on met par default à l'accueil
    if($_GET['p'] == ''){
        $_GET['p'] = 'accueil';
    }
    
   // require ROOT . '/core.php';
    
    //On capture les paramètres de l'url
    $params = explode('/',$_GET['p']);
    
    //On crée les variables de vue et controleur pour les appeller ensuite
    $controleur = $params[0];

    //Par default on appelle l'action index
    $action = (isset($params[1]))?$params[1]:'index';
    
    $filename = ROOT . '/controller/' . $controleur . '.php';
    
    //Si le controleur existe on l'inclue sinon on affiche l'erreur 404
    if(file_exists($filename)){
        require($filename);

        $controleur = new $controleur();
        //On test si l'action existe sinon on appelle l'erreur 404
        if(method_exists($controleur, $action)){
            unset($params[0],$params[1]);
            call_user_func_array(array($controleur,$action),$params);
        }
        else{
            echo 'fonction existe pas';
        }
    }
    else{
        echo 'page existe pas';
    }
    
?>
