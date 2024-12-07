<?php

$tareas = [

    [
        'id'=>1,
        'descripcion'=>'tarea 1',
        'estado'=>'inprogress'
    ],
    [
        'id'=>1,
        'descripcion'=>'tarea 1',
        'estado'=>'inprogress'
    ],
    [
        'id'=>1,
        'descripcion'=>'tarea 1',
        'estado'=>'inprogress'
    ]
    ];



function filtraDatos($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function esValidoDato($data){
    
    if(!empty(filtraDatos($data))){
        return true;
    }else{
        return false;
    }
}

function guardaDatos($id,$des,$est){
    global $tareas;

    if(esValidoDato($id) && esValidoDato($des) && esValidoDato($est)){

    array_push ($tareas,[
        'id'=>$id,
        'descripcion'=>$des,
        'estado'=>$est
    ]);
    return true;
    }else{
        return false;
    }



}