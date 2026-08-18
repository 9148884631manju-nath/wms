<!-- HERO SECTION -->
  <section class="relative bg-gradient-to-b from-slate-50 to-white py-20 lg:py-28 overflow-hidden border-b border-brandCardBorder">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
      <span class="inline-block text-accentGreen font-bold tracking-wider text-xs uppercase px-3.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 mb-4">
        New Drop 2026 Collection
      </span>
      <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-brandDarkText tracking-tight uppercase max-w-4xl mx-auto leading-none">
        <?= $pt_1n2 ?> <span class="text-transparent bg-clip-text bg-gradient-to-r from-accentOrange to-amber-500"><?= $pt_2 ?></span> <?= $pt_3 ?>
      </h1>
      <p class="mt-6 text-brandMutedText text-lg sm:text-xl max-w-2xl mx-auto font-medium">
        <?= $comp_welcome_text ?>
      </p>
      <div class="mt-8 flex justify-center gap-4">
        <a href="#new-arrivals" class="bg-accentOrange hover:bg-accentOrangeHover text-white font-bold px-8 py-3.5 rounded-lg shadow-lg shadow-accentOrange/25 transition transform hover:-translate-y-0.5">
          Explore New Arrivals
        </a>
        <a href="#featured" class="border border-slate-300 bg-white hover:bg-slate-50 text-slate-800 font-bold px-8 py-3.5 rounded-lg transition shadow-sm">
          View Featured
        </a>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT AREA -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-24">

    <!-- 1. FEATURED PRODUCTS SECTION -->
    <section id="featured">
      <div class="flex justify-between items-end mb-8">
        <div>
          <h2 class="text-2xl sm:text-3xl font-black text-brandDarkText uppercase tracking-wider"><?= $featuredProductMainTitle ?></h2>
          <p class="text-brandMutedText text-sm mt-1"><?= $featuredProductInfoText ?></p>
        </div>
        <a href="#" class="text-accentOrange hover:underline text-sm font-bold flex items-center gap-1">
          View All &rarr;
        </a>
      </div>

      <!-- Product Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php
         // echo dataToTemplate(              $showFeaturedProducts,              "templates/product_card.html",              [                ["","product_image","XmainTitle","",""],                ["","product_expose","XSpecial","",""],                ["","product_category","Xcategory","",""],                ["","product_main_title","Xproduct","",""],                ["","product_price","Xprice","",""]              ]            );
        ?>
        

      </div>
    </section>

    <!-- 2. NEW ARRIVALS SECTION -->
    <section id="new-arrivals" class="bg-brandCard border border-brandCardBorder rounded-2xl p-6 sm:p-10 shadow-sm">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
        <div>
          <span class="text-accentOrange font-bold text-xs uppercase tracking-widest"><?= $newProductInfoText ?></span>
          <h2 class="text-2xl sm:text-3xl font-black text-brandDarkText uppercase tracking-wider mt-1"><?= $newProductMainTitle ?></h2>
        </div>
        <button class="bg-accentOrange hover:bg-accentOrangeHover text-white font-bold text-sm px-6 py-2.5 rounded-lg transition shadow-md shadow-accentOrange/20">
          Shop All New Releases
        </button>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
      
        <?php
          //echo dataToTemplate(              $showNewProducts,              "templates/product_card_2.html",             [                ["","product_category","Xcategory","",""],                ["","product_main_title","Xproduct","",""],                ["","product_price","Xprice","",""]              ]            );
        ?>
        
      </div>
    </section>

    <!-- 3. MOST POPULAR PRODUCTS -->
    <section id="popular">
      <div class="mb-8">
        <h2 class="text-2xl sm:text-3xl font-black text-brandDarkText uppercase tracking-wider"><?= $PopularProductMainTitle ?></h2>
        <p class="text-brandMutedText text-sm mt-1"><?= $PopularProductInfoText ?></p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <?php
         //echo dataToTemplate(              $showPopularProducts,              "templates/product_card_3.html",              [                ["","product_category","Xcategory","",""],                ["","product_main_title","Xproduct","",""],                ["","product_price","Xprice","",""],                ["","product_rating","Xrating","4.2",""],                ["","product_views","Xviews","21",""]              ]            );
        ?>

        

      </div>
    </section>

  </main>