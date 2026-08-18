

<?php
if(file_exists($inv."categories.xlsx")){
 $catLinks = viewdata($inv."categories.xlsx","Sheet1");
 if(isset($catLinks[$page])){
 $pagehead=$catLinks[$page]["title"];
 $innertheme = "templates/header_section_2.html";
 }else{
  $pagehead=$page;
  $innertheme ="templates/innerpageheader.html";
 }
  $headerSectioon=
  array(
   "title"=>$pagehead
  );
}else{
$pagehead= "Products";
}

 $headerSectioon=json_encode($headerSectioon);
 $headerSectioon=json_decode($headerSectioon);
 
  echo dataToTemplate(
        array($headerSectioon),
        $innertheme,
        [
          ["text","toptitle","XtopTitle",$comp_name,""],
          ["text","title","Xtitle","",""],
          ["text","subtitle","Xsubtitle","-",""],
          ["text","smalltext","XsmallText",$comp_expose_text,""]
        ]
      );
?>


<!-- MEN SUBCATEGORIES GRID SECTION -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  

  <!-- Subcategories Grid (3 cols on MD, 4 cols on XL) -->
  
   <?php
   if(isset($_SESSION['nimda'])=="ko"){
    $theme="subcategory_theme_admin";
   }else{
    $theme="subcategory_theme";
   }
   if(file_exists($inv.$page.".xlsx")){
    $readLinks =getls($inv,$page);
    ?><div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6"><?php
    echo dataToTemplate(
      $readLinks,
      "templates/".$theme.".html",
      [
        ["text","page","Xpage",$page,""],
        ["text","titleid","Xeid","",""],
        ["text","Title","Xtitle","",""],
        ["text","link","Xlink","",""],
        ["text","scat","Xscat","-",""],
        ["text","titleid","Xidtitle","","",$images,".jpg"]
      ]
    );    
    ?></div><?php
   }else{
   echo $page;
   }
   ?>
  
</section>

<?php





?>
<!-- CATEGORIES SECTION -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <!-- Section Header -->
  <div class="mb-8 text-center md:text-left">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 uppercase">Shop By Category</h2>
    <p class="text-sm text-gray-500 mt-1">Explore our latest collections curated for modern urban style.</p>
  </div>

  <!-- Category Cards Grid -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <?php
     if(file_exists($inv."categories.xlsx")){
      $xreadLinks =getls($inv,"categories");
      echo dataToTemplate(
        $xreadLinks,
        "templates/category_theme.html",
        [
          ["text","title","Xtitle","",""],
          ["text","link","Xlink","",""],
          ["text","image","Ximage","",""],
          ["text","alt","Xalt","",""],
          ["text","prefix","Xprefix","",""],
          ["text","sufix","Xsuffix","",""],
        ]
      );
     }else{

     }
    ?>

  </div>
</section>