# SimpleBannerManager

A really simple PHP banner manager, it uses a powerful API to handle text plain data, and Cloudinary for image/file uploads. It was created to simplify the banner management, the main goal is to create a simple interface for a client to change banners content by just dragging images without having to worry about HTML or any other code during the process.

## Features (unmarked are under development)

- [x] Updates / Uploads new media to existing banners
- [x] Provides authenticated interface for banners management just change users from db
- [ ] User management panel
- [ ] Banner creation panel

## Installation

1. Clone or download project
2. Configure db schema (script at folder "_DBschema")
3. Change api settings to correctly set user/password (located at: api/src/settings.php)
4. Make sure to adjust the users on the db, so you can set the proper email for your client(s)
5. Enjoy

## Built With

* [Bootstrap 4](https://getbootstrap.com/) - The most popular HTML, CSS, and JS library in the world.
* [PHP 5](https://php.net) - You know what I mean ;)
* [PHPSlim, fluentPDO and others](http://www.slimframework.com/) - All of them with the objective to create a simple and powerful API
* [Cloudinary](https://cloudinary.com/) - A leading cloud service to manage web and mobile media assets.
* [Bootstrap Cloudinary upload](https://github.com/aldaca15/Bootstrap-Cloudinary-upload) - An enhancement to bundle Cloudinary uploads to Bootstrap using modals.

## Authors

* **Ali Adame** - *Initial work, hopefully this project will get collabs, all of them are welcome* - [aldaca15](https://github.com/aldaca15)

## License

This project is licensed under the MIT License (https://opensource.org/licenses/MIT)
	