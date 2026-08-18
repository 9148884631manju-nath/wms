<?php
function jed($fle){
 if(file_exists($fle)){
  $rf = file_get_contents($fle);
  $js = json_decode($rf);
  return $js; 
 }
 else{
  return "<err>! Data Source Not Found ".$fle."</err>";
 }
}
function createLink($data,$page,$prefix,$active,$deactive){
 $res="";
 for($i=0;$i<count($data);$i+=1)
  {
   if($data[$i]->link==$page){$class=$active;}else{$class=$deactive;}
   $res.='<a href="'.$prefix.$data[$i]->link.'" class="'.$class.'" >'.$data[$i]->title.'</a>';
  }
  return $res;
}
function showProducts($source,$da){
  $product=array();
  for($i=0;$i<count($da);$i+=1)
    {
      $spl = explode("|",$da[$i]);
      $file = $spl[0];
      $pid = $spl[1];
      $spcl = $spl[2];
      $getData = jed($source.$file.".json");
      $product[]=$getData->$pid;
    }
    return $product;
}
function bulklinks($temp,$file){
  $res="";
  $temp = file_get_contents($temp);
  $data = jed($file);
  for($i=0;$i<count($data);$i+=1){

  }
}
function dataToTemplate($data,$template,$array){
  $res="";$newvals=array(); $flds=array(); $vars=array(); $defs=array(); $extr=array();
  for($x=0;$x<count($array);$x+=1){
    $type[] = $array[$x][0];
    $flds[] = $array[$x][1];
    $vars[] = $array[$x][2];
    $defs[] = $array[$x][3];
    $extr[] = $array[$x][4];
    $prefix[] = isset($array[$x][5])?$array[$x][5]:"";
    $suffix[] = isset($array[$x][6])?$array[$x][6]:"";
  }
  $temp = file_get_contents($template); 
  for($i=0;$i<count($data);$i+=1){
    for($j=0;$j<count($flds);$j+=1){ 
      $fld = $flds[$j]; 
      if(isset($data[$i]->$fld)){
        switch($type[$j]){
          case "readfiletotemp":
            $arraydata = jed($data[$i]->$fld);
            $newvals[$i][$j] = dataToTemplate($arraydata,$defs[$j],$extr[$j]);
            break;
          default:
            $newvals[$i][$j] = $prefix[$j].$data[$i]->$fld.$suffix[$j];
          break;
        }
      }else{
        $newvals[$i][$j] = $defs[$j];
      }
    }
    $res.=str_replace($vars,$newvals[$i],$temp);
  }
  return $res;
}



function dataToTemplateXl($data,$template,$array){
  $res="";$newvals=array(); $flds=array(); $vars=array(); $defs=array(); $extr=array();
  for($x=0;$x<count($array);$x+=1){
    $type[] = $array[$x][0];
    $flds[] = $array[$x][1];
    $vars[] = $array[$x][2];
    $defs[] = $array[$x][3];
    $extr[] = $array[$x][4];
  }
  $temp = file_get_contents($template); 
  for($i=0;$i<count($data);$i+=1){ 
    for($j=0;$j<count($flds);$j+=1){ 
      $fld = $flds[$j]; 
      if(isset($data[$i][$fld])){
        switch($type[$j]){
          case "readfiletotemp":
            $arraydata = jed($data[$i][$fld]);
            $newvals[$i][$j] = dataToTemplateXl($arraydata,$defs[$j],$extr[$j]);
            break;
          default:
            $newvals[$i][$j] = $data[$i][$fld];
          break;
        }
      }else{
        $newvals[$i][$j] = $defs[$j];
      }
    }
    $res.=str_replace($vars,$newvals[$i],$temp);
  }
  return $res;
}

function readxltojsonbyfrec($spreadsheet,$targetSheetName){ 
      // Get sheet directly by name
      $sheet = $spreadsheet->getSheetByName($targetSheetName);
      $nadat = array();
      if ($sheet !== null) {
          // Convert sheet data to array
          $sheetData = $sheet->toArray(); 
        
          for($i=1;$i<count($sheetData);$i+=1){ 
              for($j=0;$j<count($sheetData[$i]);$j+=1){
              $nadat[$sheetData[$i][0]]['rowid'] = $i;  
              $nadat[$sheetData[$i][0]][$sheetData[0][$j]] = $sheetData[$i][$j];
                
              }
          }
          return $nadat;
      } else {
          $nadat["err"] = "Sheet named '" . htmlspecialchars($targetSheetName) . "' was not found!";
      }
 return $nadat;
}

function readxltojsonbyfrec_array($spreadsheet,$targetSheetName){ 
      // Get sheet directly by name
      $sheet = $spreadsheet->getSheetByName($targetSheetName);
      $nadat = array();
      if ($sheet !== null) {
          // Convert sheet data to array
          $sheetData = $sheet->toArray(); 
        
          for($i=1;$i<count($sheetData);$i+=1){
              
              for($j=0;$j<count($sheetData[$i]);$j+=1){
                $nadat[$i][$sheetData[0][$j]] = $sheetData[$i][$j];
              }
          }
          $ar=array();
          foreach($nadat as $kk=>$vv){$ar[]=$vv;}
          return $ar;
      } else {
          $nadat["err"] = "Sheet named '" . htmlspecialchars($targetSheetName) . "' was not found!";
      }
 return $nadat;
}

function readxltojsonbyfrec_coltitle($spreadsheet,$targetSheetName){ 
      // Get sheet directly by name
      $sheet = $spreadsheet->getSheetByName($targetSheetName);
      $nadat = array();
      if ($sheet !== null) {
          // Convert sheet data to array
          $sheetData = $sheet->toArray(); 
        
          for($i=1;$i<count($sheetData);$i+=1){
              for($j=0;$j<count($sheetData[$i]);$j+=1){
                $nadat[$sheetData[$i][0]] = $sheetData[$i][1];
              }
          }
          return $nadat;
      } else {
          $nadat["err"] = "Sheet named '" . htmlspecialchars($targetSheetName) . "' was not found!";
      }
 return $nadat;
}


function gettitles($spreadsheet,$targetSheetName){ 
      // Get sheet directly by name
      $sheet = $spreadsheet->getSheetByName($targetSheetName);
      $nadat = array();
      if ($sheet !== null) {
          // Convert sheet data to array
          $sheetData = $sheet->toArray();             
          for($i=0;$i<count($sheetData[0]);$i+=1){
              $nadat[]=$sheetData[0][$i];
          }
      } else {
          $nadat["err"] = "Sheet named '" . htmlspecialchars($targetSheetName) . "' was not found!";
      }
 return $nadat;
}





function getdatabykey($key,$spreadsheet,$targetSheetName){
  $newjson=array();
  $jsondata = readxltojsonbyfrec($spreadsheet,$targetSheetName);
  if(isset($jsondata[$key])){
    $newjson = json_encode($jsondata[$key]);
    unset($jsondata[$key]);
  }else{
    $newjson['err']="invalid";
  }
  return json_encode($newjson);
}
?>