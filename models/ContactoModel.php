<?php

require_once "Conexion.php";

class ContactoModel
{
    public function hola()
    {
        echo "hola modelo";
    }
    static public function getContactos($parametro)
    {
        $condicion = '';

        if ($parametro->todo === false) {
            if ($parametro->esCliente) {
                $condicion = " AND c.esCliente IS TRUE ";
            } elseif ($parametro->esProveedor) {
                $condicion = " AND c.esProveedor IS TRUE ";
            }
        }

        // echo $condicion;
        $respuesta = Conexion::conecion()->prepare("
        SELECT 
            c.idContacto, 
            c.nombre, 
            c.razonSocial AS razon_social, 
            CASE WHEN c.esCliente IS TRUE THEN 1 ELSE 0 END esCliente,
            CASE WHEN c.esProveedor IS TRUE THEN 1 ELSE 0 END esProveedor,
            d1.descripcion AS Direccion,
            p.descripcion as Pais,
            pr.descripcion as Provincia,
            c1.descripcion AS correo,
            t.descripcion AS telefono,
            tp.nombre AS tipoIdentificacion,
            i.Identificacion AS identificacion,
            CASE WHEN c.estado IS TRUE THEN 1 ELSE 0 END estado 
        FROM contacto c 
        INNER JOIN identificacion i ON c.idTercero = i.idTercero
        INNER JOIN tipo tp ON i.idTipoIdentificacion = tp.idtipo
        LEFT JOIN tercero_direccion td ON td.idTercero = c.idTercero
        LEFT JOIN direccion d1 ON td.idDireccion = d1.idDireccion
        LEFT JOIN pais p ON d1.idpais = p.idpais
        LEFT JOIN provincia pr ON d1.idprovincia = pr.idprovincia
        LEFT JOIN tercero_correo tc ON tc.idTercero = c.idTercero
        LEFT JOIN correo c1 ON tc.idCorreo = c1.idCorreo
        LEFT JOIN tercero_telefono tt ON tt.idTercero = c.idTercero
        LEFT JOIN telefono t ON tt.idTelefono = t.idTelefono
        WHERE 1 = 1 $condicion
        ");
        $respuesta->execute();
        return $respuesta->fetchAll();
    }

    static public function getContacto($idContacto)
    {
        $respuesta = Conexion::conecion()->prepare(
            "SELECT 
            c.idContacto,
            c.idTercero,
            c.nombre,
            c.razonSocial,
            c.esCliente,
            c.esProveedor,
            COALESCE(tt.idTelefono,0) idTelefono,
            t.descripcion AS telefono,
             COALESCE(tc.idCorreo,0) idCorreo,
            cr.descripcion AS correo,
            i.idIdentificacion,
            i.idTipoIdentificacion,
            i.Identificacion,
            COALESCE(tcd.idDireccion,0) idDireccion,
            d.descripcion AS direccion,
            p.idprovincia,
            p.descripcion AS Provincia,
            p1.idpais,
            p1.descripcion AS Pais,
            c.estado
        FROM contacto c
        LEFT JOIN tercero_telefono tt ON tt.idTercero = c.idTercero
        LEFT JOIN telefono t ON tt.idTelefono = t.idTelefono
        LEFT JOIN tercero_correo tc ON tc.idTercero = c.idTercero
        LEFT JOIN correo cr ON cr.idCorreo = tc.idCorreo
        LEFT JOIN identificacion i ON i.idTercero = c.idTercero
        LEFT JOIN tercero_direccion tcd ON tcd.idTercero = c.idTercero
        LEFT JOIN direccion d ON tcd.idDireccion = d.idDireccion
        LEFT JOIN provincia p ON d.idprovincia = p.idprovincia
        LEFT JOIN pais p1 ON d.idpais = p1.idpais
        WHERE c.idContacto = :idContacto"
        );
        $respuesta->bindParam(":idContacto", $idContacto, PDO::PARAM_INT);
        $respuesta->execute();

        return $respuesta->fetchAll();
    }

    static public function registrarContacto($datos)
    {
        $exec = Conexion::conecion();

        try {
            //code...

            $exec->beginTransaction();
            $exec->exec("INSERT INTO tercero VALUES()");
            $idTercero =  $exec->lastInsertId();

            $stmt = $exec->prepare("INSERT INTO contacto(idTercero, esCliente, esProveedor, nombre, razonSocial, estado)
             VALUES(:idTercero, :esCliente, :esProveedor, :nombre, :razonSocial, :estado)");
            $stmt->bindParam(":idTercero", $idTercero, PDO::PARAM_INT);
            $stmt->bindParam(":esCliente", $datos['esCliente'], PDO::PARAM_BOOL);
            $stmt->bindParam(":esProveedor", $datos['esProveedor'], PDO::PARAM_BOOL);
            $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":razonSocial", $datos['razonSocial'], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_BOOL);
            $stmt->execute();
            $idContacto = $exec->lastInsertId();

            $stmt = $exec->prepare("INSERT INTO identificacion(idTercero, idTipoIdentificacion, Identificacion)
            VALUES(:idTercero, :tipoIdentificacion, :identificacion)");
            $stmt->bindParam(":idTercero", $idTercero, PDO::PARAM_INT);
            $stmt->bindParam(":tipoIdentificacion", $datos['tipoIdentificacion'], PDO::PARAM_INT);
            $stmt->bindParam(":identificacion", $datos['identificacion'], PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $exec->prepare("INSERT INTO direccion(descripcion, idprovincia, idpais, estado)
            VALUES(:descripcion, :idprovincia, :idpais, :estado)");
            $stmt->bindParam(":descripcion", $datos['direccion'], PDO::PARAM_STR);
            $stmt->bindParam(":idprovincia", $datos['provincia'], PDO::PARAM_INT);
            $stmt->bindParam(":idpais", $datos['pais'], PDO::PARAM_INT);
            $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_BOOL);
            $stmt->execute();
            $idDireccion = $exec->lastInsertId();

            $exec->exec("INSERT INTO tercero_direccion(idTercero, idDireccion)
            VALUES($idTercero, $idDireccion)");
            
         
            if (isset($datos["telefono"]) && !empty($datos["telefono"])) {
                $exec->exec("INSERT INTO telefono(descripcion)
                VALUES('" . $datos["telefono"] . "')");
                $idTelefono = $exec->lastInsertId();

                $exec->exec("INSERT INTO tercero_telefono(idTercero, idTelefono)
                VALUES($idTercero, $idTelefono)");
            }


            if (isset($datos["correo"]) && !empty($datos["correo"])) {
                $exec->exec("INSERT INTO correo(descripcion)
                VALUES('" . $datos["correo"] . "')");
                $idCorreo = $exec->lastInsertId();

                $exec->exec("INSERT INTO tercero_correo(idTercero, idCorreo)
                VALUES($idTercero, $idCorreo)");
            }


            $exec->commit();
            return  $idContacto;
        } catch (PDOException $e) {
            //throw $th;
            $exec->rollBack();
            echo "Ah ocurrido un error: " . $e->getMessage();
            throw new Exception('internal-database-error');
        }
    }



    ///actualizarContacto
    static public function actualizarContacto($datos)
    {
        try {
            $resultados = ContactoModel::getContacto($datos['idContacto']);

            if (count($resultados) > 0) {
                // print_r($resultados);
    
                $idTercero = $resultados[0]['idTercero'];
                $idTelefono = $resultados[0]['idTelefono'];
                $idCorreo = $resultados[0]['idCorreo'];
                $idIdentificacion = $resultados[0]['idIdentificacion'];
                $idDireccion = $resultados[0]['idDireccion'];
    
                if ($idIdentificacion > 0) {
                    Conexion::conecion()->prepare("UPDATE identificacion SET Identificacion = '" . $datos['identificacion'] . "' WHERE idIdentificacion = " . $idIdentificacion . "")->execute();
                } else {
                    $stmt = Conexion::conecion();
                    $stmt->prepare("INSERT INTO identificacion(idTercero, idTipoIdentificacion, Identificacion)
                VALUES($idTercero, " . $datos["tipoIdentificacion"] . ", '" . $datos["identificacion"] . "')")->execute();
                }
    
                if ($idTercero > 0) {
                    Conexion::conecion()->prepare("UPDATE telefono SET descripcion = '" . $datos['telefono'] . "' WHERE idTelefono = " . $idTelefono . "")->execute();
                } else {
                    $stmt = Conexion::conecion();
                    $respuesta = $stmt->prepare("INSERT INTO telefono(descripcion)
                    VALUES('" . $datos["telefono"] . "')")->execute();
                    $idTelefono = $stmt->lastInsertId();
    
                    $stmt->prepare("INSERT INTO tercero_telefono(idTercero, idTelefono)
                    VALUES($idTercero, $idTelefono)")->execute();
                }
    
    
                if ($idCorreo > 0) {
                    Conexion::conecion()->prepare("UPDATE correo SET descripcion = '" . $datos['correo'] . "' WHERE idCorreo = " . $idCorreo . "")->execute();
                } else {
                    $stmt = Conexion::conecion();
                    $respuesta = $stmt->prepare("INSERT INTO correo(descripcion)
                    VALUES('" . $datos["correo"] . "')")->execute();
                    $idCorreo = $stmt->lastInsertId();
    
                    $stmt->prepare("INSERT INTO tercero_correo(idTercero, idCorreo)
                    VALUES($idTercero, $idCorreo)")->execute();
                }
                   if ($idIdentificacion > 0) {
                    Conexion::conecion()->prepare("UPDATE identificacion SET Identificacion = '" . $datos['identificacion'] . "' WHERE idIdentificacion = " . $idIdentificacion . "")->execute();
                } else {
                    $stmt = Conexion::conecion();
                    $stmt->prepare("INSERT INTO identificacion(idTercero, idTipoIdentificacion, Identificacion)
                VALUES($idTercero, " . $datos["tipoIdentificacion"] . ", '" . $datos["identificacion"] . "')")->execute();
                }
    
                if ($idDireccion > 0) {
                    Conexion::conecion()->prepare("UPDATE direccion d
                    SET d.descripcion = '" . $datos['direccion'] . "',
                        d.idprovincia = '" . $datos['provincia'] . "', 
                        d.idpais = '" . $datos['pais'] . "',
                        d.estado = '" . $datos['estado'] . "                  
                       WHERE idDireccion = " . $idDireccion . "")->execute();
    
                } else {
    
                    $stmt = Conexion::conecion();
                    $respuesta = $stmt->prepare("INSERT INTO direccion(descripcion, idprovincia, idpais, estado)
                    VALUES(" . $datos["descripcion"] . ", '" . $datos["idprovincia"] . "', '" . $datos["idpais"] . "', '" . $datos["estado"] . "')")->execute();
                    $idDireccion = $stmt->lastInsertId();
                    
                    $stmt->prepare("INSERT INTO tercero_direccion(idTercero, idDireccion)
                    VALUES($idTercero, $idDireccion)")->execute();
                }
    
                $dato = Conexion::conecion()->prepare("UPDATE contacto c 
                                                SET c.nombre = '" . $datos['nombre'] . "', 
                                                    c.razonSocial = '" . $datos['razonSocial'] . "',
                                                    c.esCliente = " . $datos['esCliente'] . ",
                                                    c.esProveedor = " . $datos['esProveedor'] . ",
                                                    c.estado = " . $datos['estado'] . "
                                              WHERE c.idContacto = " . $resultados[0]['idContacto'] . "")->execute();
    
                return $dato;
            }
        } catch (PDOException $th) {
            print "Ah ocurrido un error: " . $th->getMessage();
            // throw $th;
        }
    }

    static public function getProvincia($idPais) {

        $respuesta = Conexion::conecion()->prepare(
            "SELECT p.idprovincia, p.idpais,p.descripcion FROM provincia p
             WHERE p.idpais = $idPais AND p.estado IS TRUE"
        );

        $respuesta->execute();

        return $respuesta->fetchAll();
    }


    /*
    static public function eliminarContacto($idUsuario) {
        $respuesta = Conexion::conecion()->prepare("
            SELECT 
                u.idUsuario,
                u.usuario,
                p.idPersona,
                p.idTercero,
                COALESCE(tt.idTelefono,0) AS idTelefono,
                COALESCE(tc.idCorreo,0) AS idCorreo
            FROM usuario u 
            INNER JOIN persona p ON p.idPersona = u.idPersona
            LEFT JOIN tercero_telefono tt ON tt.idTercero = p.idTercero
            LEFT JOIN tercero_correo tc ON tc.idTercero = p.idTercero
            WHERE u.idUsuario = ". $idUsuario ."
            LIMIT 1");
        $respuesta->execute();
        $records = $respuesta->fetchAll();

        $idUsuario = $records[0]['idUsuario'];
        $idPersona = $records[0]['idPersona'];
        $idTercero = $records[0]['idTercero'];
        $idTelefono = $records[0]['idTelefono'];
        $idCorreo = $records[0]['idCorreo'];

       if(count($records) > 0) {
           if($idTelefono > 0) {
                Conexion::conecion()->prepare("DELETE FROM tercero_telefono WHERE idTelefono = $idTelefono")->execute();
                Conexion::conecion()->prepare("DELETE FROM telefono WHERE idTelefono = $idTelefono")->execute();
           } 
           if($idCorreo > 0) {
                Conexion::conecion()->prepare("DELETE FROM tercero_correo WHERE idCorreo = $idCorreo")->execute();
                Conexion::conecion()->prepare("DELETE FROM correo WHERE idCorreo = $idCorreo")->execute();
            }

            Conexion::conecion()->prepare("DELETE FROM tercero WHERE idTercero = $idTercero")->execute();
            Conexion::conecion()->prepare("DELETE FROM persona WHERE idPersona = $idPersona")->execute();
            Conexion::conecion()->prepare("DELETE FROM usuario WHERE idUsuario = $idUsuario")->execute();
       }

       return (count($records) > 0) ? true : false;
       }*/
}
