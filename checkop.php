<?php
  $aDoor = $_POST['form'];
  if(empty($aDoor)) 
  {
      echo "<script>alert('Centang salah satu sektor!'); window.location='/mainmenu.php';</script>";
  } 
  else 
  {
    $N = count($aDoor);

    echo("You selected $N door(s): ");
    for($i=0; $i < $N; $i++)
    {
      echo($aDoor[$i] . " ");
    }
  }
?>