<?php

function filtraCampo($campo)
{
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function validarCampoTexto($campo)
{
    return (!empty(filtraCampo($campo) && validarLargoCampo($campo, 2)));
}

function validarLargoCampo($campo, $longitud)
{
    return (strlen(trim($campo)) > $longitud);
}

function esNumeroValido($campo)
{
    return (!empty(filtraCampo($campo) && is_numeric($campo)));
}

function validaContrasena($campo){

    if (empty($campo) || !validarLargoCampo($campo, 7)) {
        return false;
    }

    $cadena = '/^(?=.*[A-Z]){2}(?=.*[a-z])(?=.*\d)(?=.*[.@()]).+$/';

    return preg_match($cadena, $campo) === 1;
}
