<?php

class HistorialC
{

    public function BorrarHistorialC()
    {
        $res = HistorialM::Veri(substr($_GET["url"], 10));

        if ($res == true) {
            if (substr($_GET["url"], 10)) {
                $tablaBD = "citas";
                $id = substr($_GET["url"], 10);
                if (is_numeric($id)) {
                    $resultado = HistorialM::BorrarHistoriaM($tablaBD, $id);
                    if ($resultado == true) {
                        echo '<script>
                        window.location = "' . $_SERVER . 'clinica/historial";
                        </script>';
                    } else {

                    }
                }

            }

        } else {

        }
    }
}
