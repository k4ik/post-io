/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,vue}",
  ],  theme: {
    extend: {
      colors: {
        'purple': 'rgba(98, 82, 143, 1)',
        'hpurple': 'rgba(72, 59, 109, 1)',
        'form': 'rgba(27, 27, 27, 0.60)',        
        'placeholder-color': 'rgba(238, 232, 232, 0.5)',
        'text-color': '#EEE8E8',
      },
      height: {
        '156': '39em'
      },
      borderRadius: {
        '10': '40px',
        '3': '12px'
      },
      fontFamily: {
        'poppins': ["Poppins", "sans-serif"],
        'jetbrains': ["JetBrains Mono", "monospace"],
      },
      inset: {
        '7p': '7%',  
        '19p': '19%',
      },
    },
  },
  plugins: [],
}

