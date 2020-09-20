<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Short Description
This is a simple Online Shopping Web Application using php (Laravel) as backend and Vue js for front end. <br/>
It Also use single action classes inspired by this article https://medium.com/@remi_collin/keeping-your-laravel-applications-dry-with-single-action-classes-6a950ec54d1d

<hr/>

## How to Setup
<ul>
    <li>Copy .env.example file to .env and edit database,paypal and passport credentials</li>
<li>Run composer install</li>
<li>Run php artisan key:generate</li>
<li>Run php artisan migrate/import ashop.sql</li>
<li>Run php artisan passport:install</li>
<li>Run npm install</li>
<li>Run npm run dev</li>
</ul>

