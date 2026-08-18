<?php

$for = isset($_REQUEST["for"]) ? $_REQUEST["for"] : "";
if($_SESSION['nimda']=="ko"){
?>

<!-- FIXED FULL-WIDTH TOP ADMIN BAR -->
<div class="fixed bottom-0 left-0 right-0 z-50 bg-white border-b border-slate-200/80 px-4 sm:px-8 py-2.5 shadow-[0_25px_60px_15px_rgba(15,23,42,0.25)]">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    
    <!-- Left Side: Brand / Dashboard Tag -->
    <div class="flex items-center gap-3">
      <span class="font-black text-slate-900 uppercase tracking-tight text-sm sm:text-base">
        HAVEN <span class="text-orange-500">&</span> HUE
      </span>
      <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase tracking-wider border border-emerald-200">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
        Admin Panel
      </span>
    </div>

    <!-- Right Side: User Profile & Logout -->
    <div class="flex items-center gap-3">
      <!-- Admin Avatar & Info -->
      <div class="flex items-center gap-2.5">
        <div class="relative flex items-center justify-center shrink-0">
          <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-orange-500 to-amber-400 text-white font-bold text-xs flex items-center justify-center uppercase shadow-xs">
            AD
          </div>
          <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full"></span>
        </div>
        <div class="hidden sm:block text-left">
          <span class="block text-xs font-bold text-slate-900 leading-tight">Admin User</span>
          <span class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Super Admin</span>
        </div>
      </div>

      <!-- Divider -->
      <div class="h-5 w-px bg-slate-200"></div>

      <!-- Logout Button (HTMX) -->
      <button hx-post="admin-logout.php"
              hx-confirm="Are you sure you want to log out?"
              title="Sign Out"
              class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 text-xs font-bold transition-all cursor-pointer">
        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        <span class="hidden md:inline uppercase tracking-wider text-[11px]">Logout</span>
      </button>
    </div>

  </div>
</div>

<!-- Spacer to prevent top page content from being overlapped by fixed bar -->
<div id="modal-container" class="relative z-100"></div>
<?php
}
if($for=="myadmin" and !isset($_SESSION['nimda'])){
?>
<!-- HTMX ADMIN LOGIN MODAL OVERLAY -->
<div id="admin-login-modal" 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm transition-opacity duration-300">
  
  <!-- Modal Card Frame -->
  <div class="relative w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl border border-slate-100 p-8 sm:p-10 animate-in fade-in zoom-in-95 duration-200">
    
    <!-- Top Close Button -->
    <button type="button" 
            onclick="document.getElementById('admin-login-modal').remove()" 
            class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition cursor-pointer">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <!-- Header Section -->
    <div class="text-center mb-8"> 
      <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-bold uppercase tracking-widest mb-3">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
        Admin Portal
      </div>
      <h2 class="text-2xl sm:text-3xl font-black text-slate-900 uppercase tracking-tight">
        HAVEN <span class="text-orange-500">&</span> HUE
      </h2>
      <p class="text-xs text-slate-500 mt-1 font-medium">Please authenticate to access administrative controls.</p>
    </div>

    <!-- Error/Alert Target Box for HTMX Response -->
    <div id="login-alert" class="mb-4"></div>

    <!-- Login Form (HTMX Enabled) -->
    <form hx-post="admin-login.php" 
          hx-target="#login-alert" 
          hx-swap="innerHTML"
          class="space-y-5">

      <!-- Username / Email Field -->
      <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username or Email</label>
        <div class="relative">
          <input type="text" 
                 name="username" 
                 required 
                 placeholder="admin@havenandhue.com" 
                 class="w-full px-4 py-3 pl-11 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
          <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
        </div>
      </div>

      <!-- Password Field -->
      <div>
        <div class="flex items-center justify-between mb-2">
          <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Password</label>
          <a href="#" class="text-xs font-semibold text-orange-500 hover:text-orange-600 transition">Forgot?</a>
        </div>
        <div class="relative">
          <input type="password" 
                 name="password" 
                 required 
                 placeholder="••••••••••••" 
                 class="w-full px-4 py-3 pl-11 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-transparent outline-none transition text-sm text-slate-900 placeholder:text-slate-400">
          <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" 
              class="w-full py-3.5 px-6 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold text-sm uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition cursor-pointer flex items-center justify-center gap-2 mt-2">
        <span>Sign In To Dashboard</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
        </svg>
      </button>

    </form>

    <!-- Modal Footer Note -->
    <div class="mt-6 pt-4 border-t border-slate-100 text-center">
      <p class="text-[11px] text-slate-400 font-medium">
        Protected by Haven & Hue Access Management • 2026
      </p>
    </div>

  </div>
</div>
<?php
}
?>