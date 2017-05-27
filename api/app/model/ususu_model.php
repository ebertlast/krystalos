<?php
namespace App\Model;

use App\Lib\Database;
use App\Lib\Response;

class UsusuModel
{
  private $db;
  private $table = 'USUSU';
  private $key = 'USUARIO';
  private $response;

  public function __CONSTRUCT()
  {
    $this->db = Database::StartUp();
    $this->response = new Response();
  }

  public function GetAll()
  {
    try
    {
      $result = array();
      $sql="SELECT [COMPANIA]
            ,[USUARIO]
            ,[CLAVE]=dbo.FNK_DESCIFRAR(CLAVE)
            ,[NOMBRE]
            ,[GRUPO]=dbo.FNK_DESCIFRAR(GRUPO)
            ,[TIPO]
            ,[IDMEDICO]
            ,[NIVELFUNCIONARIO]
            ,[CODCAJERO]
            ,[SYS_ComputerName]
            ,[FECHACAMBIO]
            ,[ESTADO]
            ,[ESMEDICO]
            ,[IDSEDE]
            ,[IDIMAGEN]
            ,[CARGO]
            ,[TELEFONO]
            ,[CELULAR]
            ,[EMAIL]
            ,[IDFIRMA]
            ,[FECHAVENCE]
            ,[CONECTADO]
            ,[SYS_COMP_CONECTADO]
            ,[FECHACONEC]
            ,[KEYUSER1]
            ,[IDTERCERO]
            ,[GENERO]
            ,[FECHANACIMIENTO]
         FROM $this->table ";
        //  FROM $this->table  WHERE [USUARIO]='AARELLANO'";

      $stm = $this->db->prepare($sql);
      $stm->execute();

      $data=( $stm->fetchAll());
      $result = array();
      if(count($data)>0){
        foreach ($data as $fila) {
          $fila->USUARIO=utf8_decode($fila->USUARIO);
          $fila->NOMBRE=utf8_decode($fila->NOMBRE);
          $fila->CARGO=utf8_decode($fila->CARGO);
          $fila->CLAVE='';
          $result[]=$fila;
        }
      }

      // var_dump($result);

      $this->response->setResponse(true);
      // $this->response->result = $stm->fetchAll();
      $this->response->result = $result;

            return $this->response;
    }
    catch(Exception $e)
    {
      $this->response
        // ->withHeader('Content-type','application/json; charset=utf-8')
        ->setResponse(false, $e->getMessage());

            return $this->response;
    }
  }

  public function Get($id)
  {
    try
    {
      $result = array();
      $sql="SELECT [COMPANIA]
            ,[USUARIO]
            ,[CLAVE]=dbo.FNK_DESCIFRAR(CLAVE)
            ,[NOMBRE]
            ,[GRUPO]=dbo.FNK_DESCIFRAR(GRUPO)
            ,[TIPO]
            ,[IDMEDICO]
            ,[NIVELFUNCIONARIO]
            ,[CODCAJERO]
            ,[SYS_ComputerName]
            ,[FECHACAMBIO]
            ,[ESTADO]
            ,[ESMEDICO]
            ,[IDSEDE]
            ,[IDIMAGEN]
            ,[CARGO]
            ,[TELEFONO]
            ,[CELULAR]
            ,[EMAIL]
            ,[IDFIRMA]
            ,[FECHAVENCE]
            ,[CONECTADO]
            ,[SYS_COMP_CONECTADO]
            ,[FECHACONEC]
            ,[KEYUSER1]
            ,[IDTERCERO]
            ,[GENERO]
            ,[FECHANACIMIENTO]
        FROM $this->table
        WHERE $this->key = ? ";
      $stm = $this->db->prepare($sql);
      $stm->execute(array($id));

      $data=( $stm->fetchAll());
      $result = array();
      if(count($data)>0){
        foreach ($data as $fila) {
          $fila->USUARIO=utf8_decode($fila->USUARIO);
          $fila->NOMBRE=utf8_decode($fila->NOMBRE);
          $fila->CARGO=utf8_decode($fila->CARGO);
          $fila->CLAVE='';
          $result[]=$fila;
        }
      }

      $this->response->setResponse(true);
      // $this->response->result = $stm->fetch();
      $this->response->result = $result[0];


            return $this->response;
    }
    catch(Exception $e)
    {
      $this->response->setResponse(false, $e->getMessage());
            return $this->response;
    }
  }

  public function InsertOrUpdate($data)
  {
    try
    {
      if(isset($data['$this->key']))
      {
          $sql="UPDATE $this->table SET
            [COMPANIA]          = ?
            ,[USUARIO]          = ?
            ,[CLAVE]            =dbo.FNK_CIFRAR(?)
            ,[NOMBRE]           = ?
            ,[GRUPO]            =dbo.FNK_CIFRAR(?)
            ,[TIPO]             = ?
            ,[IDMEDICO]         = ?
            ,[NIVELFUNCIONARIO] = ?
            ,[CODCAJERO]        = ?
            ,[SYS_ComputerName] = ?
            ,[FECHACAMBIO]      = ?
            ,[ESTADO]           = ?
            ,[ESMEDICO]         = ?
            ,[IDSEDE]           = ?
            ,[IDIMAGEN]         = ?
            ,[CARGO]            = ?
            ,[TELEFONO]         = ?
            ,[CELULAR]          = ?
            ,[EMAIL]            = ?
            ,[IDFIRMA]          = ?
            ,[FECHAVENCE]       = ?
            ,[CONECTADO]        = ?
            ,[SYS_COMP_CONECTADO] = ?
            ,[FECHACONEC]       = ?
            ,[KEYUSER1]         = ?
            ,[IDTERCERO]        = ?
            ,[GENERO]           = ?
            ,[FECHANACIMIENTO]  = ?
        WHERE $this->key = ? ";

          $this->db->prepare($sql)
                ->execute(
                   array(
                      $data['COMPANIA']
                      ,$data['USUARIO']
                      ,$data['CLAVE']
                      ,$data['NOMBRE']
                      ,$data['GRUPO']
                      ,$data['TIPO']
                      ,$data['IDMEDICO']
                      ,$data['NIVELFUNCIONARIO']
                      ,$data['CODCAJERO']
                      ,$data['SYS_ComputerName']
                      ,$data['FECHACAMBIO']
                      ,$data['ESTADO']
                      ,$data['ESMEDICO']
                      ,$data['IDSEDE']
                      ,$data['IDIMAGEN']
                      ,$data['CARGO']
                      ,$data['TELEFONO']
                      ,$data['CELULAR']
                      ,$data['EMAIL']
                      ,$data['IDFIRMA']
                      ,$data['FECHAVENCE']
                      ,$data['CONECTADO']
                      ,$data['SYS_COMP_CONECTADO']
                      ,$data['FECHACONEC']
                      ,$data['KEYUSER1']
                      ,$data['IDTERCERO']
                      ,$data['GENERO']
                      ,$data['FECHANACIMIENTO']
                  )
              );
      }
      else
      {
          $sql = "INSERT INTO $this->table
                      ([COMPANIA],[USUARIO],[CLAVE],[NOMBRE],[GRUPO],[TIPO],[IDMEDICO],[NIVELFUNCIONARIO]
                      ,[CODCAJERO],[SYS_ComputerName],[FECHACAMBIO],[ESTADO],[ESMEDICO],[IDSEDE],[IDIMAGEN]
                      ,[CARGO],[TELEFONO],[CELULAR],[EMAIL],[IDFIRMA],[FECHAVENCE],[CONECTADO]
                      ,[SYS_COMP_CONECTADO],[FECHACONEC],[KEYUSER1],[IDTERCERO],[GENERO],[FECHANACIMIENTO])
                      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

          $this->db->prepare($sql)
                ->execute(
                  array(
                      $data['COMPANIA']
                      ,$data['USUARIO']
                      ,$data['CLAVE']
                      ,$data['NOMBRE']
                      ,$data['GRUPO']
                      ,$data['TIPO']
                      ,$data['IDMEDICO']
                      ,$data['NIVELFUNCIONARIO']
                      ,$data['CODCAJERO']
                      ,$data['SYS_ComputerName']
                      ,$data['FECHACAMBIO']
                      ,$data['ESTADO']
                      ,$data['ESMEDICO']
                      ,$data['IDSEDE']
                      ,$data['IDIMAGEN']
                      ,$data['CARGO']
                      ,$data['TELEFONO']
                      ,$data['CELULAR']
                      ,$data['EMAIL']
                      ,$data['IDFIRMA']
                      ,$data['FECHAVENCE']
                      ,$data['CONECTADO']
                      ,$data['SYS_COMP_CONECTADO']
                      ,$data['FECHACONEC']
                      ,$data['KEYUSER1']
                      ,$data['IDTERCERO']
                      ,$data['GENERO']
                      ,$data['FECHANACIMIENTO']
                  )
              );
      }
      $this->response->setResponse(true);
            return $this->response;
    }catch (Exception $e)
    {
      $this->response->setResponse(false, $e->getMessage());
    }
  }

  public function Delete($id)
  {
    try
    {
      $stm = $this->db
                  ->prepare("DELETE FROM $this->table WHERE $this->key = ?");

      $stm->execute(array($id));

      $this->response->setResponse(true);
            return $this->response;
    } catch (Exception $e)
      {
        $this->response->setResponse(false, $e->getMessage());
      }
    }
  }
