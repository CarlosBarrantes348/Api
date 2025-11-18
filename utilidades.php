function configurarCors() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, X-Cedula-Programador, x-cedula-programador");

    if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
        http_response_code(200);
        exit();
    }
}

function leerJson() {
    $cuerpo = file_get_contents("php://input");
    $cuerpo = trim($cuerpo);

    if ($cuerpo === "") {
        return [];
    }

    $datos = json_decode($cuerpo, true);

    if ($datos === null && json_last_error() !== JSON_ERROR_NONE) {
        responder(false, "El cuerpo de la petición no es un JSON válido.", null, 400);
    }

    return $datos;
}

function responder($exito, $mensaje, $datos = null, $codigo = 200) {
    http_response_code($codigo);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode([
        "exito"   => $exito,
        "mensaje" => $mensaje,
        "datos"   => $datos
    ]);
    exit;
}
