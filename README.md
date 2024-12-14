<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

<h1>Blog Website API</h1>
    <p>This repository contains the backend API for a blog website, providing essential features like user registration, authentication, blog post management, comment functionality, and image uploads.</p>
    <h2>Features</h2>
    <ul>
        <li><strong>User Registration & Authentication:</strong> Secure user registration, login, and token-based authentication.</li>
        <li><strong>Blog Post Management:</strong> Authenticated users can create, view, and manage blog posts.</li>
        <li><strong>Comments:</strong> Users can add and view comments on blog posts.</li>
        <li><strong>Image Uploads:</strong> Users can upload and associate images with posts.</li>
        <li><strong>User Profile Management:</strong> View and update user profile information.</li>
        <li><strong>Error Handling:</strong> Basic error handling for invalid requests.</li>
    </ul>
    <h2>API Endpoints</h2>
    <h3>User Registration & Authentication</h3>
    <ul>
        <li><strong>POST /api/register:</strong> Register a new user.</li>
        <li><strong>POST /api/login:</strong> Log in and receive a token.</li>
    </ul>
    <h3>Blog Post Management</h3>
    <ul>
        <li><strong>POST /api/posts/store:</strong> Create a new blog post.</li>
        <li><strong>GET /api/posts/:</strong> View all blog posts.</li>
        <li><strong>GET /api/posts/id:id:</strong> View a specific blog post.</li>
    </ul>
    <h3>Comments</h3>
    <ul>
        <li><strong>POST /api/comments/stores:</strong> Add a comment to a blog post.</li>
        <li><strong>GET /api/posts/:</strong> View all comments for a specific post.</li>
    </ul>
    <h3>User Profile Management</h3>
    <ul>
        <li><strong>GET /api/users/</strong> View user profile.</li>
        <li><strong>PATCH /api/users/update</strong> Update user profile.</li>
    </ul>
    <h2>Security</h2>
    <p>The API uses token-based authentication (JWT) to secure all routes, requiring a valid token for access to protected resources.</p>
    <hr>
    <h2>Laravel Project Setup from GitHub</h2>
    <p>Follow these steps to set up the Laravel project from GitHub:</p>
    <ol>
        <li>
            <h2>Clone the Repository</h2>
            <p>Clone the Laravel project from GitHub using the following command:</p>
            <pre><code>git clone https://github.com/Aniket2mandal/IntujiBlog.git</code></pre>
        </li>
        <li>
            <h3>Install Dependencies</h3>
            <p>Navigate into the project directory and install the required dependencies using Composer:</p>
            <pre><code>cd repository-name
composer install</code></pre>
        </li>
        <li>
            <h2>Set Up Environment File</h2>
            <p>Copy the <code>.env.example</code> file to <code>.env</code>:</p>
            <pre><code>cp .env.example .env</code></pre>
        </li>
        <li>
            <h2>Set Up Database</h2>
            <p>Configure the <code>.env</code> file to include the correct database connection details (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).</p>
        </li>
        <li>
            <h2>Run Migrations </h2>
            <pre><code>php artisan migrate</code></pre>
        </li>
        <li>
            <h2>Seed the Database </h2>
            <pre><code>php artisan db:seed</code></pre>
        </li>
        <li>
            <h2>Serve the Application</h2>
            <p>You can now serve the Laravel application locally:</p>
            <pre><code>php artisan serve</code></pre>
            <p>By default, the application will be available at <code>http://localhost:8000</code>.</p>
        </li>
    </ol>
