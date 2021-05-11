<?php

class ValorRuleta{
  private $id;
  private $cadena;
  private $valor;
  private $percentatge_premi;
  private $premi1;
  private $premi2;
  private $premi3;
  private $premi4;
  private $premi5;
  private $premi6;
  private $premi7;

  function __construct($id_p,$cadena_p, $valor_p, $percentatge_premi_p){
    $this->id=$id_p;
    $this->cadena=$cadena_p;
    $this->valor=$valor_p;
    $this->percentatge_premi=$percentatge_premi_p;
    $this->premi1=0;
    $this->premi2=0;
    $this->premi3=0;
    $this->premi4=0;
    $this->premi5=0;
    $this->premi6=0;
    $this->premi7=0;
  }

  public function setPremi1(){
        $this->premi1++;
  }
  public function getPremi1(){
    return $this->premi1;
  }
  public function setPremi2(){
        $this->premi2++;
  }
  public function getPremi2(){
    return $this->premi2;
  }
  public function setPremi3(){
        $this->premi3++;
  }
  public function getPremi3(){
    return $this->premi3;
  }
  public function setPremi4(){
        $this->premi4++;
  }
  public function getPremi4(){
    return $this->premi4;
  }
  public function setPremi5(){
        $this->premi5++;
  }
  public function getPremi5(){
    return $this->premi5;
  }
  public function setPremi6(){
        $this->premi6++;
  }
  public function getPremi6(){
    return $this->premi6;
  }
  public function setPremi7(){
        $this->premi7++;
  }
  public function getPremi7(){
    return $this->premi7;
  }
  function setPercentatgePremiValor(){
    /*
    hi ha una quantitat de premis X
    quantitat           Valor               Resultat
      1                   500€                500€
      10                  50€                 500€
      20                  20€                 400€
      40                  10€                 400€
      100                 5€                  500€
      1000                1€                  1000€ //el de 500, 50,20, 10, 5 i 1 surten un 70% de vegades

      1000                Tornar a Tirar        0€
      1000                No té premis          0€  // surten un 30%  de vegades

    */
  }

  function Mostra_resultat(){
    //echo "Mostra resultat :<br/>";
    //echo " id = ".$this->id."  cadena = ".$this->cadena." valor =".$this->valor. " percentatge_premi =".$this->percentatge_premi."<br/>";
  }

}
function calcular_random($val1, $val2){
  return rand($val1,$val2);
}
function calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores){
  //echo "<br/>funció calcular valor iteracio $i<br/>";
  $servername = "localhost";
  $username = "prova";
  $password = "prova";

  // Create connection
  $conn = new mysqli($servername, $username, $password);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else{
    //echo "Connected successfully";
    if($tguanyadores>0 && $tperdedores>0){
          $random=calcular_random(1,24);
      }
      else if($tguanyadores>0 && $tperdedores==0){
              $random=calcular_random(1,18);
            }else if($tguanyadores==0 && $tperdedores>0){
                    $random=calcular_random(19,24);
                  }
//Valors  != 0
////SELECT count(*) FROM `Control_valors` WHERE `500`<>0 or `50`<>0 or `20`<>0 or `10`<>0 or `5`<>0 or `1`<>0
//SELECT count(*) FROM `Control_valors` WHERE `500`>=1 or `50`>=1 or `20`>=1 or `10`>=1 or `5`>=1 or `1`>=1
//valors 0
//SELECT count(*) FROM `Control_valors` WHERE `TronaTirar`>=1 or `0`>=1

    //echo "<h1>tguanyadores =".$tguanyadores."tperdedores = ".$tperdedores."</h1>";
    //echo "Tirades (dins calcular_valor)=".$tirades."<br/> Guanya (dins calcular_valor) = ".$guanya."<br/> Perd (dins calcular_valor) = ".$perd."<br/>";
    if($random>=16)$perd=$perd-1;
    else $guanya=$guanya-1;
    //echo "Tirades (dins calcular_valor)=".$tirades."<br/> Guanya (dins calcular_valor) = ".$guanya."<br/> Perd (dins calcular_valor) = ".$perd."<br/>";
    //echo "importTotal=".$importTotal;
    //echo "<b>tirades totals que guanyaran alguna cosa =".$TotalGuanyades." i les que no guanyaran res seran =".$TotalPerdudes."<br/></b>";
    switch($random){
      case 1:
      case 2:
      case 3:
        //echo "<br/>Ha sortit l'1";
        //echo "valor POST[premi500]=".$_POST['premi500']."<br/>";
        //$sql="INSERT INTO `prova`.`Control_valors`(`500`,`50`,`20`,`10`,`5`,`1`,`TronaTirar`,'0') VALUES (1,0,0,0,0,0,0,0)";
        $sqlselect = "Select count(id) from `prova`.`Control_valors` where `500`=1";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        //echo "<br/>row[0] =".($row[0])."<br/> <h1>tguanyadores=".$tguanyadores."</h1>";
        /*$calcul= "SELECT * FROM `valors_ruleta` where `valor`!=0";
        //echo "calcul=".$calcul;
        $resultat = mysqli_query($conn,$calcul);
        //echo "resultat =".$resultat;
        $valor= mysqli_fetch_row($resultat);
        echo "valor == ".$valor;*/
      if($row[0]<$_POST['premi500'] && $tguanyadores>0 && $tperdedores>0 && $importTotal>0){
            $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (".$_POST['premi500'].",0,0,0,0,0,0,0)";
            //echo "<p> sql = ".$sql."</p>";
            if (mysqli_query($conn, $sql)) {
                //echo "<p>Record 500 inserted successfully</p>";
                //echo "valor ($i) = $valor";
                $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`) VALUES ($i,'500€',500,500)";
                //echo "<p>valors_ruleta sql = ".$sql."</p>";
                if (mysqli_query($conn, $sql)) {
                    //echo "<p>Record valors_ruleta inserted successfully</p>";
                    $importTotal=$importTotal-500;
                    calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores-1, $tperdedores);
                    mysqli_close($conn);
                  } else {
                    //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                  }
              }
              else {
                //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
              }
        }
        else{
          calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores);
        }
        mysqli_close($conn);

        return 3;
      break;
      case 4:
      case 5:
      case 6:
        //echo "<br/>Ha sortit l'2";
        $sqlselect = "Select count(id) from `prova`.`Control_valors` where `50`!=0";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        $insert=($row[0]+1);
        //echo "<br/><h1>row+1=".$insert."</h1>"."<br/>REGALS de 50 =".($row[0]);
        //echo "valor POST[premi50]=".$_POST['premi50']."<br/> <h1>tguanyadores=".$tguanyadores."</h1>";
        if($row[0]<$_POST['premi50'] && $tguanyadores>0 && $tperdedores>0 && $importTotal>0){
            $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (0,".$insert.",0,0,0,0,0,0)";
            //echo "<p> sql = ".$sql."</p>";
            if (mysqli_query($conn, $sql)) {
                //echo "<p>Record 50 inserted successfully</p>";
                //echo "valor ($i) = $valor";
                $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`) VALUES ($i,'50€',50,50)";
                //echo "<p>valors_ruleta sql = ".$sql."</p>";
                if (mysqli_query($conn, $sql)) {
                    $importTotal=$importTotal-50;
                    //echo "<p>Record valors_ruleta inserted successfully</p>";
                    calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores-1, $tperdedores);
                    mysqli_close($conn);
                  } else {
                    //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                  }
              }
              else {
                //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
              }
        }
        else{
              calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores);
        }
        mysqli_close($conn);

        return 6;
      break;
      case 7:
      case 8:
      case 9:
        //echo "<br/>Ha sortit l'3";
        $sqlselect = "Select count(id) from `prova`.`Control_valors` where `20`!=0";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        $insert=($row[0]+1);
        //echo "<br/><h1>row+1=".$insert."</h1>"."<br/>row[0] =".($row[0])."<br/>";

        //echo "valor POST[premi20]=".$_POST['premi20']."<br/> <h1>tguanyadores=".$tguanyadores."</h1>";
        if($row[0]<$_POST['premi20'] && $tguanyadores>0 && $tperdedores>0 && $importTotal>0){
        //if($row[0]<20){
            $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (0,0,".$insert.",0,0,0,0,0)";
            //echo "<p> sql = ".$sql."</p>";
            if (mysqli_query($conn, $sql)) {
                //echo "<p>Record 20 inserted successfully</p>";
                //echo "valor ($i) = $valor";
                $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`) VALUES ($i,'20€',20,20)";
                //echo "<p>valors_ruleta sql = ".$sql."</p>";
                if (mysqli_query($conn, $sql)) {
                    $importTotal=$importTotal-20;
                    //echo "<p>Record valors_ruleta inserted successfully</p>";
                    calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores-1, $tperdedores);
                    mysqli_close($conn);
                  } else {
                    //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                  }
              } else {
                //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
              }
        }
        else{
              calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores);
        }
        mysqli_close($conn);
        return 9;
      break;
      case 10:
      case 11:
      case 12:
        //echo "<br/>Ha sortit l'4";
        $sqlselect = "Select count(id) from `prova`.`Control_valors` where `10`!=0";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        $insert=($row[0]+1);
        //echo "<br/><h1>row+1=".$insert."</h1>"."<br/>row[0] =".($row[0])."<br/>";
        //echo "valor POST[premi10]=".$_POST['premi10']."<br/> <h1>tguanyadores=".$tguanyadores."</h1>";
        if($row[0]<$_POST['premi10'] && $tguanyadores>0 && $tperdedores>0 && $importTotal>0){
        //if($row[0]<40){
            $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (0,0,0,".$insert.",0,0,0,0)";
            //echo "<p> sql = ".$sql."</p>";
            if (mysqli_query($conn, $sql)) {
                //echo "<p>Record 10 inserted successfully</p>";
                //echo "valor ($i) = $valor";
                $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`) VALUES ($i,'10€',10,10)";
                //echo "<p>valors_ruleta sql = ".$sql."</p>";
                if (mysqli_query($conn, $sql)) {
                    $importTotal=$importTotal-10;
                    //echo "<p>Record valors_ruleta inserted successfully</p>";
                    calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores-1, $tperdedores);
                    mysqli_close($conn);
                  } else {
                    //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                  }
              } else {
                //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
              }
        }
        else{
              calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores-1, $tperdedores);
        }
        mysqli_close($conn);
        return 12;
      break;
      case 13:
      case 14:
      case 15:
        //echo "<br/>Ha sortit l'5";
        $sqlselect = "Select count(id) from `prova`.`Control_valors` where `5`!=0";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        $insert=($row[0]+1);
        //echo "<br/><h1>row+1=".$insert."</h1>"."<br/>row[0] =".($row[0])."<br/> <h1>tguanyadores=".$tguanyadores."</h1>";
        //echo "valor POST[premi5]=".$_POST['premi5']."<br/>";
        if($row[0]<$_POST['premi5'] && $tguanyadores>0 && $tperdedores>0 && $importTotal>0){
        //if($row[0]<100){
            $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (0,0,0,0,".$insert.",0,0,0)";
            //echo "<p> sql = ".$sql."</p>";
            if (mysqli_query($conn, $sql)) {
                //echo "<p>Record 5 inserted successfully</p>";
                //echo "valor ($i) = $valor";
                $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`) VALUES ($i,'5€',5,5)";
                //echo "<p>valors_ruleta sql = ".$sql."</p>";
                if (mysqli_query($conn, $sql)) {
                    $importTotal=$importTotal-5;
                    //echo "<p>Record valors_ruleta inserted successfully</p>";
                    calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores-1, $tperdedores);
                    mysqli_close($conn);
                  } else {
                    //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                  }
              } else {
                //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
              }
        }
        else{
          calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores);
        }
        mysqli_close($conn);
        return 15;
      break;
      case 16:
      case 17:
      case 18:
        //echo "<br/>Ha sortit l'6";
        $sqlselect = "Select count(id) from `prova`.`Control_valors` where `1`!=0";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        $insert=($row[0]+1);
        //echo "<br/><h1>row+1=".$insert."</h1>"."<br/>row[0] =".($row[0])."<br/><h1>tguanyadores=".$tguanyadores."</h1>";
        //echo "valor POST[premi1]=".$_POST['premi1']."<br/>";
        if($row[0]<$_POST['premi1'] && $tguanyadores>0 && $tperdedores>0 && $importTotal>0){
        //if($row[0]<1000){
              $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (0,0,0,0,0,".$insert.",0,0)";
              //echo "<p> sql = ".$sql."</p>";
              if (mysqli_query($conn, $sql)) {
                  //echo "<p>Record 1 inserted successfully</p>";
                  //echo "valor ($i) = $valor";
                  $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`) VALUES ($i,'1€',1,1)";
                  //echo "<p>valors_ruleta sql = ".$sql."</p>";
                  if (mysqli_query($conn, $sql)) {
                      $importTotal=$importTotal-1;
                      //echo "<p>Record valors_ruleta inserted successfully</p>";
                      calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores-1, $tperdedores);
                      mysqli_close($conn);
                    } else {
                      //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                    }
                } else {
                  //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                }
        }
        else{
          calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores);
        }
        mysqli_close($conn);
        return 18;
      break;
      case 19:
      case 20:
      case 21:
        //echo "<br/>Ha sortit l'7";
        $sqlselect = "Select count(id) from `prova`.`Control_valors` where `TronaTirar`!=0";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        $insert=($row[0]+1);
        //echo "<br/><h1>row+1=".$insert."</h1>"."<br/>row[0] =".($row[0])."<br/><h1>tperdedores=".$tperdedores."</h1>";
        //echo "valor POST[premit]=".$_POST['premit']."<br/>";
        if($row[0]<$_POST['premit'] && $tperdedores>0 && $tperdedores>0){
        //if($row[0]<1000){
              $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (0,0,0,0,0,0,".$insert.",0)";
              //echo "<p> sql = ".$sql."</p>";
              if (mysqli_query($conn, $sql)) {
                  //echo "<p>Record TronaTirar inserted successfully</p>";
                  //echo "valor ($i) = $valor";
                  $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`)
                                  VALUES ($i,'TronaTirar',0,0)";
                  //echo "<p>valors_ruleta sql = ".$sql."</p>";
                  if (mysqli_query($conn, $sql)) {
                      //echo "<p>Record valors_ruleta inserted successfully</p>";
                      calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores-1);
                      mysqli_close($conn);
                    } else {
                      //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                    }
                } else {
                  //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                }
        }
        else{
          calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores);
        }
        mysqli_close($conn);
        return 21;
      break;
      case 22:
      case 23:
      case 24:
        //echo "<br/>Ha sortit el 8";
        //$sqlselect = "Select count(id) from `prova`.`Control_valors` where `0`!=0";
        $result = mysqli_query($conn,$sqlselect);
        //echo "result = ".$result;
        $row= mysqli_fetch_row($result);
        $insert=($row[0]+1);
        //echo "<br/><h1>row+1=".$insert."</h1>"."<br/>row[0] =".($row[0])."<br/>";
        //echo "valor POST[premi0]=".$_POST['premi0']."<br/> <h1><h1>tperdedores=".$tperdedores."</h1>";
        if($row[0]<$_POST['premi0'] && $tguanyadores>0 && $tperdedores>0){
        //if($row[0]<1000){
            $sql="INSERT INTO `prova`.`Control_valors`(`500`, `50`, `20`, `10`, `5`, `1`, `TronaTirar`, `0`) VALUES (0,0,0,0,0,0,0,".$insert.")";
            //echo "<p> sql = ".$sql."</p>";
            if (mysqli_query($conn, $sql)) {
                //echo "<p>Record Valor0 inserted successfully</p>";
                //echo "valor ($i) = $valor";
                $sql="INSERT INTO `prova`.`valors_ruleta`(`id`, `text`, `valor`, `percentatge_premi`) VALUES ($i,'0€',0,0)";
                //echo "<p>valors_ruleta sql = ".$sql."</p>";
                if (mysqli_query($conn, $sql)) {
                    //echo "<p>Record valors_ruleta inserted successfully</p>";
                    calcular_valor($i,$preguntes-1,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores-1);
                    mysqli_close($conn);
                  } else {
                    //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
                  }
              } else {
                //echo "<p>Error inserting record: " . mysqli_error($conn)."</p>";
              }
        }
        else{
          calcular_valor($i,$preguntes,$importTotal,$guanya,$perd,$tguanyadores, $tperdedores);
        }
        mysqli_close($conn);
        return 24;
        break;
      default:
        //echo "<br/>valor no possible";
        return 25;
    }
  }
  return $i;
}
//BDD prova
//User prova
//password prova
if(isset($_POST['Jugar'])){
  $servername = "localhost";
  $username = "prova";
  $password = "prova";

  // Create connection
  $conn = new mysqli($servername, $username, $password);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else{
          /*$sql="TRUNCATE `prova`.`Preguntes`";
          if (mysqli_query($conn, $sql)) {
                echo "<p>Record Preguntes deleted successfully</p>";
          }
          else {
                echo "<p>Error deleting record: " . mysqli_error($conn)."</p>";
          }*/
          $sql="TRUNCATE `prova`.`valors_ruleta`";
          if (mysqli_query($conn, $sql)) {
                //echo "<p>Record valors_ruleta deleted successfully</p>";
          }
          else {
                //echo "<p>Error deleting record: " . mysqli_error($conn)."</p>";
          }
          $sql="TRUNCATE `prova`.`Control_valors`";
          if (mysqli_query($conn, $sql)) {
                  //echo "<p>Record Control_valors deleted successfully</p>";
          }
          else {
                  //echo "<p>Error deleting record: " . mysqli_error($conn)."</p>";
          }
          $importTotal=$_POST['importTotal'];
          //echo "import = ".$importTotal;
          $preguntes=$_POST['preguntesTotals'];
          //echo "preguntes =".$preguntes;
          $guanya=$_POST['tanper100guanya'];
          //echo "guanya =".$guanya;
          $perd=$_POST['tanper100perd'];
          //echo "perd=".$perd;
          $premi500=$_POST['premi500'];
          //echo "premi500=".$premi500;
          $premi50=$_POST['premi50'];
          //echo "premi50=".$premi50;
          $premi20=$_POST['premi20'];
          //echo "premi20=".$premi20;
          $premi10=$_POST['premi10'];
          //echo "premi10=".$premi10;
          $premi5=$_POST['premi5'];
          //echo "premi5=".$premi5;
          $premi1=$_POST['premi1'];
          //echo "premi1=".$premi1;
          $premit=$_POST['premit'];
          //echo "premit=".$premit;
          $premi0=$_POST['premi0'];
          //echo "premi0=".$premi0;



      //echo "<p>prova de $tirades jugades on $guanya guanya i $perd no tindran premi<br/> valor70 = $valor70 valor30 = $valor30 <br/>";    echo "500 :".$premi500." <br/>50 :".$premi50." <br/>20 :".$premi20." <br/>10 :".$premi10." <br/>5 :".$premi5." <br/>1 :".$premi1." <br/>tirada :".$premit." <br/> 0 :".$premi0."<br/>";
          $i=1;
          for($i=0;$i<$preguntes;$i++){
            $Valorruleta1 = new ValorRuleta($i,"<u>ruleta ".$i."</u>",$i*2,$i*100);
            $cadena='String '.(2*$i);
            $valor=calcular_valor($i,$preguntes,$importTotal, $guanya,$perd,$_POST['tguanyadores'],$_POST['tperdedores']);
            //echo $Valorruleta1->Mostra_resultat();
          }
          //echo "</p>";

          //https://www.w3docs.com/snippets/css/how-to-create-loading-spinner-with-css.html


          ?>
          <!DOCTYPE html>
          <html>
          <head>
              <meta charset="utf-8">
              <title>Roda de la fortuna</title>


              <style type="text/css">
              text{
                  font-family:Helvetica, Arial, sans-serif;
                  font-size:11px;
                  pointer-events:none;
              }
              #chart{
                  position:absolute;
                  width:500px;
                  height:500px;
                  top:0;
                  left:0;
              }
              #question{
                  position: absolute;
                  width:400px;
                  height:500px;
                  top:0;
                  left:520px;
              }
              #question h1{
                  font-size: 50px;
                  font-weight: bold;
                  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                  position: absolute;
                  padding: 0;
                  margin: 0;
                  top:50%;
                  -webkit-transform:translate(0,-50%);
                          transform:translate(0,-50%);
              }
              </style>
          </head>
          <body >

              <div id="nom>">LA teva Ruleta, <?php echo $_POST['Nom']; ?></div>
              <div id="chart"></div>
              <div id="question"><h1></h1></div>

              <h1 style="position:relative;left:900px;top:0px">Preguntes </h1>
              <p id="par" style="position:relative;left:950px;top:0px" >
                <!--input type="text" name="NumTotalPregPassades"  value="<?php //echo $id; ?>"/-->
                <?php

                $id=$_POST['id']; //it has the correct number
                //echo "id =".$id;

                foreach ($_POST['array'] as $item){ //594
                    echo '<input type="text" name="PregPassades[]"  value="'.$item.'" /><br/>'; //this always show this line
                }
                ?></p>

              <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
              <script type="text/javascript" charset="utf-8">
                  var padding = {top:20, right:40, bottom:0, left:0},
                      w = 500 - padding.left - padding.right,
                      h = 500 - padding.top  - padding.bottom,
                      r = Math.min(w, h)/2,
                      rotation = 0,
                      oldrotation = 0,
                      picked = 100000,
                      oldpick = [],
                      color = d3.scale.category20();//category20c()
                      //randomNumbers = POSTRandomNumbers();

                  //http://osric.com/bingo-card-generator/?title=HTML+and+CSS+BINGO!&words=padding%2Cfont-family%2Ccolor%2Cfont-weight%2Cfont-size%2Cbackground-color%2Cnesting%2Cbottom%2Csans-serif%2Cperiod%2Cpound+sign%2C%EF%B9%A4body%EF%B9%A5%2C%EF%B9%A4ul%EF%B9%A5%2C%EF%B9%A4h1%EF%B9%A5%2Cmargin%2C%3C++%3E%2C{+}%2C%EF%B9%A4p%EF%B9%A5%2C%EF%B9%A4!DOCTYPE+html%EF%B9%A5%2C%EF%B9%A4head%EF%B9%A5%2Ccolon%2C%EF%B9%A4style%EF%B9%A5%2C.html%2CHTML%2CCSS%2CJavaScript%2Cborder&freespace=true&freespaceValue=Web+Design+Master&freespaceRandom=false&width=5&height=5&number=35#results

                  var data = [
                              <?php
                              /*foreach ($_POST['array'] as $item){ //594
                                ?>
                                {"label":"Qüestió <?php echo $i; ?>",  "value":1,  "question":" Aquesta és la pregunta : <?php echo $item; ?>"+"llegir pregunta directament amb javascript ?"
                                },
                                <?
                                  //echo '<input type="text" name="PregPassades[]"  value="'.$item.'" /><br/>'; //this always show this line
                              }*/
                                  for($i=1;$i<$preguntes;$i++){ //572

                                    ?>
                                      {"label":"Qüestió <?php echo $i; ?>",  "value":1,  "question":" Aquesta és la pregunta l604: <?php echo $i; ?>"+"com puc llegir pregunta directament amb javascript o php?"
                                      },
                                    <?php
                                  }
                                  if($i==$preguntes) {
                                    ?>
                                    {"label":"Qüestió <?php echo $i; ?>",  "value":1,  "question":" Aquesta és la última pregunta : <?php echo $i; ?>"}
                                    <?php
                                  }
                              ?>
                  ];


                  var svg = d3.select('#chart')
                      .append("svg")
                      .data([data])
                      .attr("width",  w + padding.left + padding.right)
                      .attr("height", h + padding.top + padding.bottom);

                  var container = svg.append("g")
                      .attr("class", "chartholder")
                      .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");

                  var vis = container
                      .append("g");

                  var pie = d3.layout.pie().sort(null).value(function(d){return 1;});

                  // declare an arc generator function
                  var arc = d3.svg.arc().outerRadius(r);

                  // select paths, use arc generator to draw
                  var arcs = vis.selectAll("g.slice")
                      .data(pie)
                      .enter()
                      .append("g")
                      .attr("class", "slice");


                  arcs.append("path")
                      .attr("fill", function(d, i){ return color(i); })
                      .attr("d", function (d) { return arc(d); });

                  // add the text
                  arcs.append("text").attr("transform", function(d){
                          d.innerRadius = 0;
                          d.outerRadius = r;
                          d.angle = (d.startAngle + d.endAngle)/2;
                          return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
                      })
                      .attr("text-anchor", "end")
                      .text( function(d, i) {
                          return data[i].label;
                      });

                  container.on("click", spin);


                  function spin(d){

                      container.on("click", null);

                      //all slices have been seen, all done
                      console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
                      if(oldpick.length == data.length){
                          /*console.log("done");
                          container.on("click", null);
                          return;*/
                      }

                      var  ps       = 360/data.length,
                           pieslice = Math.round(1440/data.length),
                           rng      = Math.floor((Math.random() * 1440) + 360);

                      rotation = (Math.round(rng / ps) * ps);

                      picked = Math.round(data.length - (rotation % 360)/ps);
                      picked = picked >= data.length ? (picked % data.length) : picked;


                      if(oldpick.indexOf(picked) !== -1){
                          d3.select(this).call(spin);
                          return;
                      } else {
                          //oldpick.push(picked);
                      }

                      rotation += 90 - Math.round(ps/2);

                      vis.transition()
                          .duration(3000)
                          .attrTween("transform", rotTween)
                          .each("end", function(){

                              //mark question as seen
                              /*d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                                  .attr("fill", "#111");*/

                              //populate question
                              d3.select("#question h1")
                                  .text(data[picked].question);

                              oldrotation = rotation;

                              container.on("click", spin);
                          });
                  }

                  //make arrow
                  svg.append("g")
                      .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
                      .append("path")
                      .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
                      .style({"fill":"black"});

                  //draw spin circle
                  container.append("circle")
                      .attr("cx", 0)
                      .attr("cy", 0)
                      .attr("r", 60)
                      .style({"fill":"white","cursor":"pointer"});

                  //spin text
                  //i si hi afegeixo un id i ho canvio després ?
                  container.append("text")
                      .attr("x", 0)
                      .attr("y", 15)
                      .attr("text-anchor", "middle")
                      .text("JOC")
                      .style({"font-weight":"bold", "font-size":"30px"});


                  function rotTween(to) {
                    var i = d3.interpolate(oldrotation % 360, rotation);
                    return function(t) {
                      return "rotate(" + i(t) + ")";
                    };
                  }


                  function getRandomNumbers(){
                      var array = new Uint16Array(1000);
                      var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);

                      if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                          window.crypto.getRandomValues(array);
                          console.log("works");
                      } else {
                          //no support for crypto, get crappy random numbers
                          for(var i=0; i < 1000; i++){
                              array[i] = Math.floor(Math.random() * 100000) + 1;
                          }
                      }

                      return array;
                  }

              </script>
          </body>
          </html>

          <?PHP

    }
}
else{
  //echo "error!!";
}
mysqli_close($conn);
 ?>
