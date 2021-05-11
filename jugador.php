<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ruleta</title>
  <style>
  label {display:block;}
  input {width:50%;margin-left:5%;}
  h1{text-transform: uppercase;}
  #taula { position:relative; left:36%;}
  #centra { text-align: center;}
  .nom { width: 40%;margin-left: 5px;}
  </style>
  <script>
    function ValidaFormJS(){
      //alert("document.Form.Nom.value = "+document.Form.Nom.value);
      if(document.Form.Nom.value == ""){
        alert("Si us plau, introdueix un nom");
        document.Form.Nom.focus();
        return false;
      }
      //alert(" array[0]="+document.Form.array[0].value);

      return true;
    }
  </script>
</head>
<body id="centra">
  <h1 >Introdueix el teu nom :</h1>
  <form action="ruleta.php" onsubmit="return ValidaFormJS()" method="POST" id="form" name="Form">
    <!--table id="taula" name="taula">
    <tr>
      <td-->
      <label>Introdueix el nom del jugador : </td><td><input type="text" class="nom" name="Nom" id="nomf" value="qwer"></label>
      <!--label>Pregunta 0 : <input type="text" name="array0" value="0" /></label-->
      <!--/td>
    </tr-->
    <?php for($i=0;$i<$_POST['preguntesTotals'];$i++){  ?>
    <label>Pregunta <?php echo $i; ?> : <input type="text" name="array[]" value="<?php echo htmlspecialchars($i); ?>" /></label>
    <?php } ?>
    <label>Preguntes a la ruleta : <input type="text" name="id" value="<?php echo $i; ?>" /></label>
    <label>Import total a jugar a la ruleta : <input type="text" name="importTotal" value="<?php echo $_POST['importTotal']; ?>" /></label>
    <!--label>Preguntes a la ruleta--><input type="hidden"   name="preguntesTotals" value="<?php echo $_POST['preguntesTotals']; ?>"></label>
    <!--label>% guanya--><input type="hidden" name="tanper100guanya" value="<?php echo $_POST['tanper100guanya']; ?>"></label>
    <!--label>% perd --><input type="hidden" name="tanper100perd" value="<?php echo $_POST['tanper100perd']; ?>"></label>
    <!--label>Premis de 500 :--><input type="hidden" name="premi500" value="<?php echo $_POST['premi500']; ?>"></label>
    <!--label>Premis de 50 :--><input type="hidden" name="premi50" value="<?php echo $_POST['premi50']; ?>">
    <!--label>Premis de 20 :--><input type="hidden" name="premi20" value="<?php echo $_POST['premi20']; ?>">
    <!--label>Premis de 10 :--><input type="hidden" name="premi10" value="<?php echo $_POST['premi10']; ?>">
    <!--label>Premis de 5 :--><input type="hidden" name="premi5" value="<?php echo $_POST['premi5']; ?>">
    <!--label>Premis de 1 :--><input type="hidden" name="premi1" value="<?php echo $_POST['premi1']; ?>">
    <!--label>Premis de Tirada :--><input type="hidden" name="premit" value="<?php echo $_POST['premit']; ?>">
    <!--label>Premis de 0 :--><input type="hidden" name="premi0" value="<?php echo $_POST['premi0']; ?>">
    <!--label>Calcul tirades guanyadores :--><input type="hidden" name="tguanyadores" value="<?php echo $_POST['preguntesTotals']*$_POST['tanper100guanya']/100; ?>">
      <!--label>Calcul tirades guanyadores :--><input type="hidden" name="tperdedores" value="<?php echo $_POST['preguntesTotals']*$_POST['tanper100perd']/100; ?>">
    <!--tr>
    <!-- passar les pregutnes amb javascript, cap a la ruleta.php usant awways.html-->
      <td colspan="2"--><input type="submit" name="Jugar" ><!--/td>
    </tr>
  </table-->
  </form>
</body>
</html>
