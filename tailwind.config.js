import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Corporate blue — calm, trustworthy (Stripe/Notion vibe)
                brand: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                },
                // Neutral slate for text & surfaces
                ink: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                    950: '#020617',
                },
            },
            fontSize: {
                // Tighter, more editorial display sizes
                '6xl': ['3.75rem', { lineHeight: '1.05', letterSpacing: '-0.02em' }],
                '5xl': ['3rem', { lineHeight: '1.08', letterSpacing: '-0.02em' }],
                '4xl': ['2.25rem', { lineHeight: '1.12', letterSpacing: '-0.018em' }],
                '3xl': ['1.875rem', { lineHeight: '1.2', letterSpacing: '-0.014em' }],
            },
            boxShadow: {
                // Soft, low-contrast corporate shadows
                xs: '0 1px 2px 0 rgba(15, 23, 42, 0.04)',
                soft: '0 1px 3px 0 rgba(15, 23, 42, 0.06), 0 1px 2px -1px rgba(15, 23, 42, 0.04)',
                card: '0 4px 12px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -2px rgba(15, 23, 42, 0.04)',
                lift: '0 12px 28px -8px rgba(15, 23, 42, 0.12), 0 4px 10px -4px rgba(15, 23, 42, 0.06)',
                ring: '0 0 0 1px rgba(37, 99, 235, 0.12)',
            },
            backgroundImage: {
                'brand-gradient': 'linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%)',
                'hero-fade': 'linear-gradient(180deg, #f8fafc 0%, #ffffff 100%)',
                'grid-faint': 'linear-gradient(to right, rgba(15,23,42,0.04) 1px, transparent 1px), linear-gradient(to bottom, rgba(15,23,42,0.04) 1px, transparent 1px)',
            },
            keyframes: {
                'fade-up': {
                    '0%': { opacity: '0', transform: 'translateY(12px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                'blob': {
                    '0%, 100%': { transform: 'translate(0, 0) scale(1)' },
                    '33%': { transform: 'translate(30px, -40px) scale(1.1)' },
                    '66%': { transform: 'translate(-20px, 20px) scale(0.95)' },
                },
                'float-slow': {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-18px)' },
                },
                'gradient-pan': {
                    '0%, 100%': { 'background-position': '0% 50%' },
                    '50%': { 'background-position': '100% 50%' },
                },
            },
            animation: {
                'fade-up': 'fade-up 0.5s cubic-bezier(0.16, 1, 0.3, 1) both',
                'fade-in': 'fade-in 0.6s ease-out both',
                'blob': 'blob 14s ease-in-out infinite',
                'blob-slow': 'blob 20s ease-in-out infinite',
                'float-slow': 'float-slow 6s ease-in-out infinite',
                'gradient-pan': 'gradient-pan 8s ease infinite',
            },
        },
    },

    plugins: [forms],
};
