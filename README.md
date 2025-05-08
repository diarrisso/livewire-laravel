<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <b>Todo App</b> - Laravel + Livewire + Tailwind + Pest  
</p>

<p align="center">
  <a href="https://github.com/ton-utilisateur/ton-projet/actions"><img src="https://github.com/ton-utilisateur/ton-projet/workflows/tests/badge.svg" alt="Tests"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Laravel Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 🚀 Présentation

A **modern Todo List application** built with:

- [Laravel](https://laravel.com/)
- [Livewire](https://laravel-livewire.com/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Pest PHP](https://pestphp.com/) pour les tests

---

## ⚙️ Installation

```bash
git clone git@github.com:diarrisso/livewire-laravel.git
cd livewire-laravel

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
php artisan migrate
