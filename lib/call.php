<?php session_start(); error_reporting(6); require_once "inc.php";
require_once 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// CONFIG
$res = "res/";
$data = "data/";
$inv = "inv/";
$lib = "lib/";
$images = "images/";
$page=(isset($_REQUEST['page']))?$_REQUEST['page']:"home";
$filePath = "";//'data/data.xlsx'; // Path to your Excel file
function viewdata($filePath,$targetSheetName){
 try {
      $spreadsheet = IOFactory::load($filePath);
      $adminData = readxltojsonbyfrec($spreadsheet,$targetSheetName);
  } catch (\Exception $e) {
      $adminData["err"] = $e->getMessage();
  } 
  return $adminData;
}
function viewdata_array($filePath,$targetSheetName){
 try {
      $spreadsheet = IOFactory::load($filePath);
      $adminData = readxltojsonbyfrec_array($spreadsheet,$targetSheetName);
  } catch (\Exception $e) {
      $adminData["err"] = $e->getMessage();
  } 
  return $adminData;
}
function viewdata_col($filePath,$targetSheetName){
 try {
      $spreadsheet = IOFactory::load($filePath);
      $adminData = readxltojsonbyfrec_coltitle($spreadsheet,$targetSheetName);
  } catch (\Exception $e) {
      $adminData["err"] = $e->getMessage();
  } 
  return $adminData;
}
function stringrep($val){
    $val=strtolower(ltrim(rtrim($val)));
    $sc = array("/"," / ","'","' "," '","&"," & ","-","- "," -","#","# "," #","%","(",")","[","]");
    $xc = array("","","","","","","","","","","","","","","","","","");
    $fc = str_replace($sc,$xc,$val);
    $fc = str_replace("  "," ",$fc);
    $nc = str_replace(" ","",$fc);
    return $nc;
}
function createnewexcellfile($fname,$data){
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Sheet1');
    foreach($data as $k=>$v){
        $sheet->setCellValue($k, $v);
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save($fname.".xlsx");

    return "Created";
}

function viewtitles($filePath,$targetSheetName){
 try {
      $spreadsheet = IOFactory::load($filePath);
      $adminData = gettitles($spreadsheet,$targetSheetName);
  } catch (\Exception $e) {
      $adminData["err"] = $e->getMessage();
  } 
  return $adminData;
}

function addnewrecord($filePath,$targetSheetName,$data){
    $res="";
    try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getSheetByName($targetSheetName);
            $nextRow = $sheet->getHighestRow() + 1;

            $sheet->fromArray($data, null, 'A' . $nextRow);

            // 5. Save changes
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);
            $res= "Added";

        } catch (\Exception $e) {
            $res= $e->getMessage();
        }
    return $res;

}

function deleterecord($filePath,$targetSheetName,$row){
    $res="";
    try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getSheetByName($targetSheetName);
            $nextRow = $sheet->getHighestRow() + 1;

            $sheet->removeRow($row, 1);

            // 3. Save changes
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);
            $res= "Deleted";

        } catch (\Exception $e) {
            $res= $e->getMessage();
        }
    return $res;

}

function updateexcell($filePath,$targetSheetName,$targetColumnIndex,$targetRowIndex,$newValue){
    $res="";
    try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getSheetByName($targetSheetName);
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($targetColumnIndex);
            
            if ($colLetter && $targetRowIndex) {
                $sheet->setCellValue($colLetter . $targetRowIndex, $newValue);
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save($filePath);
                $res= "Updated";
            }
            else{
                if (!$colLetter) $res= "Header title  not found in Row 1.\n";
                if (!$targetRowIndex) $res.= "Row with key  not found in Column \n";
            }

        } catch (\Exception $e) {
            $res= $e->getMessage();
        }
    return $res;
}

function getls($inv,$page){
 $dataLinksfle = $inv.$page.".xlsx";
 $dataLinks = viewdata_array($dataLinksfle,"Sheet1");
 $dataLinks =  json_encode($dataLinks); 
 return json_decode($dataLinks);
}

// GETTING THE COMPANY DETAILS IN TO VARIABLE FROM THE JSON FILE
$fle = $inv."company.xlsx"; 
$comp = viewdata_col($fle,"Sheet1");
$comp =  json_encode($comp); $comp =  json_decode($comp);


$year=date("Y");
$comp_name =  $comp->comp_name;
$comp_expose_text = $comp->comp_expose_text;
$comp_welcome_puch_line= $comp->comp_welcome_puch_line;  
 $pt =  explode(" ",$comp_welcome_puch_line);
  $pt_1n2= $pt[0]." ".$pt[1]; 
  $pt_2=  $pt[2]; 
  $pt_3=  $pt[3];
$comp_welcome_text= $comp->comp_welcome_text;

// MAIN LINKS

$dataLinksfle = $inv."mainlinks.xlsx";
$dataLinks = viewdata_array($dataLinksfle,"Sheet1");
$dataLinks =  json_encode($dataLinks); $readLinks =  json_decode($dataLinks);

// FEATURED PRODUCTS
$featuredProductsData =  "";// $data."featured_products_settings.json";
$readfeaturedProductsData =  "";// jed($featuredProductsData);
$featuredProductMainTitle= "";// $readfeaturedProductsData->main_title;
$featuredProductInfoText= "";// $readfeaturedProductsData->main_title_info_text;

$featuredProductsList =  "";// $readfeaturedProductsData->products;
$showFeaturedProducts =  "";// showProducts($data,$featuredProductsList);

// NEW ARRIAVALS
$newProductsData =  "";// $data."newarrivals_products_settings.json";
$readnewProductsData =  "";// jed($newProductsData);
$newProductMainTitle= "";// $readnewProductsData->main_title;
$newProductInfoText= "";// $readnewProductsData->main_title_info_text;

$newProductsList =  "";// $readnewProductsData->products;
$showNewProducts =  "";// showProducts($data,$newProductsList);

// POPULAR PRODUCTS
$popularProductsData =  "";// $data."newarrivals_products_settings.json";
$readPopularProductsData =  "";// jed($popularProductsData);
$PopularProductMainTitle= "";// $readPopularProductsData->main_title;
$PopularProductInfoText= "";// $readPopularProductsData->main_title_info_text;

$PopularProductsList =  "";// $readPopularProductsData->products;
$showPopularProducts =  "";// showProducts($data,$PopularProductsList);

// FOOTER LINKS
$footerLinksFile =  "";// $data."footer-links.json";
$footerLinksData =  "";// jed($footerLinksFile);

// SOCIAL LINKS
$sfle = $inv."sociallinks.xlsx"; 
$sociallinks = viewdata_array($sfle,"Sheet1");
$sociallinks =  json_encode($sociallinks); $socialLinksData =  json_decode($sociallinks);
?>