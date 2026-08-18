<!DOCTYPE html>
<?php require_once "lib/call.php"; ?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?=$comp_name;?></title>
  <?php require_once "res/global.php"?>
</head>
<body class="bg-brandLight text-brandDarkText font-sans antialiased min-h-screen flex flex-col justify-between">

  <!-- HEADER NAVBAR -->
  <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-brandCardBorder">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        
        <!-- Logo -->
        <div class="flex-shrink-0">
          <a href="#" class="text-2xl font-black tracking-widest text-brandDarkText uppercase">
            <?=$comp_name;?><span class="text-accentOrange">.</span>
          </a>
        </div>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex space-x-8 text-sm font-semibold">
          <?php
          echo dataToTemplate(
            $readLinks,
            "templates/hyperlink_2.html",
            [
              ["text","title","Xtitle","",""],
              ["text","link","Xlink","",""],
              ["text","prefix","Xprefix","",""],
              ["text","sufix","Xsuffix","",""],
            ]
          );
                    
          ?>
        </nav>

        <!-- Right Side Actions (Cart & CTA) -->
        <div class="flex items-center space-x-4">
          <!-- Cart Icon with Badge -->
          <button 
            hx-get="cart-count.html" 
            hx-trigger="load"
            class="relative p-2.5 rounded-full bg-slate-100 text-slate-700 hover:text-black hover:bg-slate-200 transition"
            aria-label="View Shopping Cart">
            
          </button>

          <!-- CTA Button (Green) -->
          <a href="#featured" class="hidden sm:inline-block bg-accentGreen hover:bg-accentGreenHover text-white font-bold text-sm px-5 py-2.5 rounded-lg shadow-md shadow-accentGreen/20 transition-all transform hover:-translate-y-0.5">
            Shop Deals
          </a>

          <!-- Mobile Hamburger Toggle -->
          <button 
            onclick="document.getElementById('mobile-drawer').classList.toggle('hidden')"
            class="md:hidden p-2 text-brandMutedText hover:text-brandDarkText focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-drawer" class="hidden md:hidden bg-brandCard border-b border-brandCardBorder px-4 pt-2 pb-6 space-y-3">
      <?php
         echo createLink(
          $readLinks,
          $page,
          "?page=",
          "block text-brandDarkText font-semibold py-2",          //Active Css
          "block text-brandMutedText hover:text-accentGreen py-2" //Deactive Css          
          );
        ?>
    </div>
  </header>

  <?php 
      if($page=="home"){
        require_once "landing.php";
      }else{
        require_once "innerpage.php";
      }
  ?>
  

  <!-- FOOTER -->
  <footer class="bg-slate-50 border-t border-brandCardBorder text-brandMutedText pt-16 pb-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-brandCardBorder">
        
        <div class="space-y-4">
          <a href="#" class="text-2xl font-black tracking-widest text-brandDarkText uppercase">
            <?=$comp_name;?><span class="text-accentOrange">.</span>
          </a>
          <p class="text-sm text-brandMutedText">
            <?=$comp_expose_text;?>
          </p>
        </div>

        <?php          
         // echo dataToTemplate(              $footerLinksData,              "templates/footer_links.html",              [                ["text","title","Xtitle","",""],                ["readfiletotemp","links","Xlinks","templates/hyperlink.html",[                  ["","title","Xtitle","",""],                  ["","link","Xlink","",""]                ]]              ]            );
        ?>

        <div>
          <h4 class="text-brandDarkText font-bold mb-4 uppercase text-sm tracking-wider">Customer Care</h4>
          <ul class="space-y-2 text-sm font-medium">
            <li><a href="#" class="hover:text-accentGreen transition">Contact Us</a></li>
            <li><a href="#" class="hover:text-accentGreen transition">Shipping & Returns</a></li>
            <li><a href="#" class="hover:text-accentGreen transition">Size Guide</a></li>
            <li><a href="#" class="hover:text-accentGreen transition">Privacy Policy</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-brandDarkText font-bold mb-4 uppercase text-sm tracking-wider">Stay Connected</h4>
          <p class="text-sm mb-3">Subscribe for exclusive drops and special offers.</p>
          <form class="flex gap-2" hx-post="/subscribe" hx-swap="none">
            <input 
              type="email" 
              placeholder="Your email address..." 
              required
              class="bg-white border border-slate-300 text-brandDarkText text-sm px-3 py-2 rounded-lg w-full focus:outline-none focus:border-accentGreen" />
            <button type="submit" class="bg-accentOrange hover:bg-accentOrangeHover text-white font-bold px-4 py-2 rounded-lg text-sm transition shadow-sm">
              Join
            </button>
          </form>
        </div>

      </div>

      <div class="mt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-brandMutedText">
        <p>&copy; <?=$year;?> <?=$comp_name;?> All rights reserved.</p>
        <div class="flex space-x-6 mt-4 sm:mt-0 font-medium">
          <?php
          echo dataToTemplate(
              $socialLinksData,
              "templates/hyperlink_2.html",
              [
                ["text","title","Xtitle","",""],
                ["text","link","Xlink","",""],
              ]
            );
          ?>
        </div>
      </div>
    </div>
  </footer>
<?php require_once  "adminp.php"; ?>
</body>
</html>