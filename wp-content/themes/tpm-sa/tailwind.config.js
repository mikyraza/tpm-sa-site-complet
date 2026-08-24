/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./**/*.html",
    "./assets/js/**/*.js"
  ],
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        tpm: {
          navy:       '#1C1340',
          orange:     '#D84B1F',
          terracotta: '#D84B1F',
          slate:      '#0F172A',
          surface:    '#F8FAFC',
          border:     '#E2E8F0',
          gray:       '#94A3B8'
        },
        "brand-terracotta": "#D84B1F",
        "brand-navy": "#1C1340",
        "brand-slate": "#0F172A",
        "brand-gray": "#94A3B8"
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace']
      },
      maxWidth: {
        'container-max': '1440px',
      }
    },
  },
  plugins: [],
}
