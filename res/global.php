<!-- 1. Google Fonts Import (Inter) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">

  <!-- 2. Tailwind CSS CDN Script -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- 3. Tailwind Configuration for Light Theme Custom Colors -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
          colors: {
            brandLight: '#FFFFFF',
            brandCard: '#F8FAFC',
            brandCardBorder: '#E2E8F0',
            brandDarkText: '#0F172A',
            brandMutedText: '#64748B',
            accentGreen: '#10B981',
            accentOrange: '#F97316',
            accentGreenHover: '#059669',
            accentOrangeHover: '#EA580C',
          }
        }
      }
    }
  </script>

  <!-- 4. HTMX Script -->
  <script src="https://unpkg.com/htmx.org@1.9.10"></script>