<p align="center"><a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
</p>

<p align="center">
    <a href="https://laravel.com/docs/8.x/socialite" target="_blank"><img src="https://madewithnetwork.ams3.cdn.digitaloceanspaces.com/spatie-space-production/1553/socialite.jpg" width="400"></a>
</p>

## About LaraVue

LaraVue is a starter template for Laravel and Vue Js tech stack, it offers multiple authentications, password resets, email notifications, roles, and permissions, UI Avatars, etc. Registering a normal user is made easy with Laravel socialite, currently, Socialite works in 127.0.0.1 port (for local development and testing).

It is applicable for any types of projects that needed multiple authentications and handles different types of users, like for example, a Multi-vendor E-commerce website.

Head Administrator with the highest role can create a sub-admin with the email provided by the user. A newly created user will receive an invitation email and link where they can create their password for their account, they won't be able to visit pages inside admin dashboard unless their password was created.

I'm also working on different sub-domain names for each admin user (johndoe.shooop.com/dashboard) and creating a nicely designed dashboard with tailwind css or maybe Admin LTE.

## Set up

-   Clone the repo
-   Run composer install
-   Run php artisan key:generate
-   Run npm install && npm run dev
-   Setup database credentials and Mailtrap Credentials for email testing purposes
-   Edit seeder according to your needs.
-   Run php artisan migrate --seed
-   Run php artisan serve
-   Admin login route 127.0.0.1/admin/login

## License

The LaraVue is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
