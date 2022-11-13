<?php


$json = file_get_contents('php://input');
$requestData = json_decode($json);
if (!$_POST && $requestData) {
    $_POST = (array) $requestData;
}

if (!$_POST) {
    $_POST = [];
}
try {

 if ($_POST["type"] == "createNewObject") {
        ob_start();
        Inspector::Instance()->createNewObject(
            $_POST['objType'],
            $_POST['object'],
            $_POST['diagName'],
            $_POST['width'],
            $_POST['height'],
            $_POST['posX'],
            $_POST['posY'],
            false,
            $_POST['selectedObjName'],
            $_POST['selectedObjType'],

        );
        ob_end_clean();
/*     $result = array("newPatchTo" => SessionManager::get('newPatchTo'), "patchCollisionParams" => SessionManager::get('patchCollisionParams'), "errors" => SessionManager::get('Errors'));
     SessionManager::set(['newPatchTo' => null]);
     SessionManager::set(['patchCollisionParams' => null]);
     echo(json_encode($result));*/
    }



} catch (Error $error){
    //Ide kell egy HandleAjaxError
} catch (Exception $exception){
    echo(json_encode(array('warning' => $exception->getMessage())));
}


?>