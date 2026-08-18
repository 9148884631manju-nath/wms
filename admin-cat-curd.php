<!-- EDIT CATEGORY POPUP MODAL -->
<div id="edit-category-modal" 
     class="fixed inset-0 z-200 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm transition-opacity">
  
  <div class="relative w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-[0_25px_60px_-15px_rgba(15,23,42,0.3)] border border-slate-100 p-6 sm:p-8 animate-in fade-in zoom-in-95 duration-200">
    
    <!-- Close Button -->
    <button type="button" 
            onclick="document.getElementById('edit-category-modal').remove()" 
            class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition cursor-pointer">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
   <?php
     require_once "lib/call.php";
     $gg=isset($_REQUEST['gg']) ? $_REQUEST['gg']:"";
     $id= $_REQUEST['id'];
     switch($gg){
      case "save":
        
        $id= $_REQUEST['id'];
        $par= $_REQUEST['par'];
        $category_name= $_POST['category_name'];
        $category_link= $_POST['category_link'];
        
        if(file_exists($inv.$par.".xlsx")){
         $dat = viewdata($inv.$par.".xlsx","Sheet1");

         $pdata = $dat[$id]; 
         $targetRowIndex = $pdata['rowid']+1;
         $i=0;$nx=array();
         foreach($pdata as $k=>$v){$nx[$k]=$i;$i+=1;}
         $filePath=$inv.$par.".xlsx";
         $targetSheetName="Sheet1";
         $targetColumnIndex=$nx["Title"];
         $newValue= $category_name;
         $res = updateexcell($filePath,$targetSheetName,$targetColumnIndex,$targetRowIndex,$newValue);

         if($res=="Updated"){
          ?><script>window.location.reload();</script><?php
         }else{
          echo $res." - ";
         }
         
        }else{}
        
       break;
      case "update":
        $par= $_REQUEST['par'];
       $title= $_REQUEST['title'];
       $link= $_REQUEST['link'];
       ?>
       <!-- Header -->
    <div class="mb-6">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-[11px] font-bold uppercase tracking-wider mb-2">
        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
        Category Management
      </div>
      <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Update Category</h2>
    </div>

    <!-- Alert Response Container -->
    <div id="update-alert" class="mb-4"></div>

    <!-- Edit Form (HTMX Supported) -->
    <form hx-post="admin-cat-curd.php?gg=save&id=<?= $id ?>&par=<?= $par ?>" 
          hx-target="#modal-container" 
          hx-swap="innerHTML"
          class="space-y-4">
      
      <!-- Category Name Field -->
      <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Category Title</label>
        <input type="text" 
               name="category_name" 
               value="<?= $title ?>" 
               required 
               class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition text-sm text-slate-900 font-semibold">
      </div>

      <!-- Subtitle / Tag Field -->
      <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Link</label>
        <input type="text" 
               name="category_link" 
               value="<?= $link ?>" 
               required 
               class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition text-sm text-slate-900">
      </div>

      

      <!-- Action Buttons -->
      <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
        <button type="button" 
                onclick="document.getElementById('edit-category-modal').remove()" 
                class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider transition cursor-pointer">
          Cancel
        </button>
        <button type="submit" 
                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition cursor-pointer">
          Save Changes
        </button>
      </div>
       <?php
       break;
      case "delete":
       ?>
       <!-- Header -->
    <div class="mb-6">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-[11px] font-bold uppercase tracking-wider mb-2">
        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
        Category Management
      </div>
      <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Delete Category</h2>
    </div>

    <!-- Alert Response Container -->
    <div id="update-alert" class="mb-4"></div>

    <!-- Edit Form (HTMX Supported) -->
    <form hx-post="update_category.php?id=12" 
          hx-target="#update-alert" 
          hx-swap="innerHTML"
          class="space-y-4">
      
      <!-- Category Name Field -->
      

      <!-- Action Buttons -->
      <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 mt-6">
        <button type="button" 
                onclick="document.getElementById('edit-category-modal').remove()" 
                class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider transition cursor-pointer">
          Cancel
        </button>
        <button type="submit" 
                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition cursor-pointer">
          Delete
        </button>
      </div>
       <?php
       break;
      default:
      echo "Nill";
      break;
     }
   ?>
    

    </form>

  </div>
</div>