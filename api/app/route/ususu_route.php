<?php

use App\Model\UsusuModel;
use App\Lib\Tokens;

$app->group('/ususu', function () {
    //Lista todos los usuarios o un usuario
    // $this->map(['GET'], '/[{usuario}]', function ($req, $res, $args) {
    //   $usuario='';
    //   if(isset($args['usuario'])){
    //     $usuario=$args['usuario'];
    //   }
    //   $ususu = new UsusuModel();
    //   return $res
    //       ->withHeader('Content-type', 'application/json')
    //       ->getBody()
    //       ->write(
    //         json_encode(
    //           ($usuario!=='')?$ususu->Get($usuario):$ususu->GetAll()
    //         )
    //       );
    // });
    $this->get('/list/[{usuario}]', function ($req, $res, $args = []) {
      $usuario='';
      if(isset($args['usuario'])){
        $usuario=$args['usuario'];
      }
      $ususu = new UsusuModel();
      return $res
          ->withHeader('Content-type', 'application/json')
          ->getBody()
          ->write(
            json_encode(
              ($usuario!=='')?$ususu->Get($usuario):$ususu->GetAll()
            )
          );
      return $res->getBody()->write('Hello Users');
    });

    $this->post('/autenticar', function ($req, $res, $args = []) {
      // $usuario='ezerpa';
      // $clave='enclave';
      if(!isset($json['json'])){
        return $res
            ->withHeader('Content-type', 'application/json')
            ->withStatus(401)
            ->withJson(array('error' => 'Sin información para procesar'))
            ;
      }
      $data = json_decode($json['json'],true);

      $usuario = $data["usuario"];
      $clave = $data["clave"];

      $ususu = new UsusuModel();
      $userData = $ususu->Get($usuario);//array('data' => $ususu->Get($usuario)->result[0]);
      $datetime1 = (new DateTime($userData->result->FECHACAMBIO));
      $datetime2 = date_create('2009-10-13');
      // echo ($datetime1 > $datetime2);
      // echo $userData->result->ESTADO;
      // echo $userData->result->CLAVE;
      // echo ($datetime1 > $datetime2)?"SI":"NO";

      if($userData->result->ESTADO==='Activo' && strtoupper($userData->result->CLAVE)===strtoupper($clave) && ($datetime1 > $datetime2)){
        $data = array('usuario' => $usuario, 'clave' => $clave);
        $jwt= new Tokens();
        $token = $jwt->encode($data);
        $userData->result->TOKEN=$token;
        return $res
            ->withHeader('Content-type', 'application/json')
            ->withAddedHeader('Authorization', $token)
            // ->withAddedHeader('Allow', 'PUT');
            ->getBody()
            ->write(
              json_encode(
                $userData
              )
            );

      }else{
        $message="Usuario y Contraseña no Coinciden. Vuelve a Intentarlo.";
        if($userData->result->ESTADO!=="Activo"){
          $message="Usuario inactivo. Contacte con el departamento de tecnología";
        }
        if($datetime1 < $datetime2){
          $message="Clave vencida. Contacte con el departamento de tecnología";
        }
        return $res
            ->withHeader('Content-type', 'application/json')
            ->withJson(array('error' => $message))
            ;
      }
         // return $res->getBody()->write('Token => '. $userData);

    });

});

