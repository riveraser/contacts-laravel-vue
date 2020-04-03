# contacts-laravel-vue
Creating an example on how to run Vue withing a Laravel project

I am doing this example because I usually prefer to use the [vue-cli][1] to create Vue SPA but the way Laravel works is a bit different.

---
### Results:

**auth:** *login*

![Login](/public/img/printscreens/login.png "login")

**auth:** *forgot password*

![Forgot](/public/img/printscreens/forgot-password.png "forgot")

**auth:** *new user*

![Register](/public/img/printscreens/register.png "register")

**contacts:** *home*

![Contacts](/public/img/printscreens/contacts.png "contacts")

**contacts:** *search*

![Search](/public/img/printscreens/search-tool.png "search")




---
### Setup:

Download the code, use composer to install dependencies for Laravel and npm for Vue.

Setup and create a database on your localhost named 'contacts-laravel'

Migrate the project with artisan command

---
### Run:

After all your setup is complete you need to run those 2 commands in different `cmd` .

Run  `php artisan serve` to start dev server.

In another `cmd` window run `npm run watch` to compile all the Vuejs code when modifying it.

---

***Sergio Rivera***

MEAN / MEVN Full stack developer

[sergiorivera.me][2]

[Visit my LinkedIn profile][3]



[1]: https://cli.vuejs.org/ "Vue Cli"
[2]: https://sergiorivera.me/ "Underconstruction"
[3]: https://www.linkedin.com/in/sergio-rivera-morales/ "LinkedIn Profile"
