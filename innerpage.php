

<?php
$mcat = isset($_REQUEST['mcat']) ? $_REQUEST['mcat'] : "categories";
if(file_exists($inv.$mcat.".xlsx")){
 
 $catLinks = viewdata($inv.$mcat.".xlsx","Sheet1");
 //var_dump($catLinks);
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
   
   if(file_exists($inv.$page.".xlsx")){
    $readLinks =getls($inv,$page);

    
    ?><div class="w-full inline-flex uppercase flex-wrap  gap-2 bg-white p-2 border-b-2 border-orange-500 pb-2">
        <?php $nl=0;
          $spl=explode("_",$page);
          $jj=array();
          for($i=0;$i<count($spl);$i+=1){
            $nl=$i-1;
            if($nl>-1){$ll.=$spl[$nl].="_";}else{$ll="";}
            $jj[]=array(
              "title"=>$spl[$i],
              "link"=>$ll.$spl[$i]
            );
          }
          $jj=json_encode($jj); $jj=json_decode($jj);
          echo dataToTemplate(
              $jj,
              "templates/hyperlink_3.html",
              [
                ["text","title","Xtitle","",""],
                ["text","link","Xlink","","","?page=",""],
              ]
            );
        ?>
      </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
      
      <style>.navlinks a{display:block;padding:0px 8px}</style>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">Products</div>

    <br/><br/><br/><br/>
    <div class="mb-8 text-center md:text-left">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 uppercase">Shop By Category</h2>
    <p class="text-sm text-gray-500 mt-1">Explore our latest collections curated for modern urban style.</p>
  </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6"><?php
    
    if(isset($_SESSION['nimda'])=="ko"){
      $theme="subcategory_theme_admin";
      ?>
      <!-- ADD NEW CATEGORY CARD -->
      <button hx-get="admin-cat-curd.php?gg=addform&par=<?= $page ?>"
              hx-target="#modal-container"
              hx-swap="innerHTML"
              class="group relative block h-64 w-full rounded-2xl border-2 border-dashed border-slate-300 hover:border-orange-500 bg-slate-50/50 hover:bg-orange-50/30 transition-all duration-300 flex flex-col items-center justify-center gap-3 text-center p-6 cursor-pointer">
        
        <!-- Animated Plus Icon Container -->
        <div class="w-12 h-12 rounded-full bg-white group-hover:bg-orange-500 text-slate-600 group-hover:text-white shadow-md flex items-center justify-center transition-all duration-300 group-hover:scale-110">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
        </div>

        <!-- Text Details -->
        <div>
          <span class="block text-sm font-black text-slate-900 group-hover:text-orange-600 uppercase tracking-wider transition-colors">
            Add New Category
          </span>
          <span class="block text-[11px] font-semibold text-slate-400 mt-0.5">
            Create a new collection card
          </span>
        </div>

      </button>
      <?php
    }else{
      $theme="subcategory_theme";
    }    
    echo dataToTemplate(
      $readLinks,
      "templates/".$theme.".html",
      [
        ["text","page","Xpage",$page,""],
        ["text","titleid","Xeid","",""],
        ["text","title","Xtitle","",""], 
        ["text","link","Xlink","","","","&mcat=$page"],
        ["text","scat","Xscat","-",""],
        ["text","titleid","Xidtitle","","",$images,".jpg"]
      ]
    );    
    ?></div><?php
   }else{
      switch($page)
      {
        case "aboutus":
            require_once "aboutus.html";
          break;
        case "contactus":
            require_once "contactus.html";
          break;
        default:
          echo $page;
        break;
      }
   }
   ?>
  
<br/><br/><br/><br/><br/>
  <!-- Section Header -->
  <div class="mb-8 text-center md:text-left">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 uppercase">Shop By Gender</h2>
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