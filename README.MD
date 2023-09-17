# Web Development Basics by jacomof

Are you trying to learn web development, but don't know where to start? Then, start with the **basics**! This repository is a comprehensive set of **examples** and **exercises** designed to demonstrate how to write web applications using a classical LAMP (Linux, Apache, MySQL and PHP) setup. 

It contains exercises on all the basic elements of classical web development, including:

- **Server side scripting** using PHP.
- **Client side scripting** using JavaScript.
- **UI and Design** using HTML5 and CSS.
- **Database Management** using MySQL.
- **AJAX Requests**.
- **Server side File and Image Processing**.
- **Input Validation**.
- **Session Management and authentication**

## Background and disclosure

The story of this project ironically begins with a finale; the end of my bachelor's degree. This event, as you can imagine, left me with a lot of free time on my hands that I wanted to make good use of. That's when I came up with the idea of developing a blog/portfolio website to showcase all my previous and future work in Computer Science related stuff (specially the field I'm entering now: Machine Learning and AI).

However, after spending some time thinking about it I quickly encountered a problem: despite my shiny new diploma, I sadly had never learned anything on web development! I'd been taught all about the underlying technologies that make up the Internet, including topics like routing algorithms, TCP, HTTP, IPv6, but not a single HTML tag. That's when I embarked in this journey to develop a series of exercises and small applications while reading **Learning PHP, MySQL, JavaScript, CSS & HTML5** by **Robin Nixon**.

Although most of the exercises I developed independently to test the different pieces of information given by the book, for some of them (specially the social network prototype from the final chapter) I took heavy inspiration on the practical examples showcased in the books. That said, I never directly copied any code, rather, whenever I took inspiration from the book I read and digested the information and tried to replicate it using my own writing style and thought processes. **I strongly recommend you follow a similar approach and use these exercises as inspiration to develop your own code**. I also recommend reading the book alongside implementing the exercises for details on the used technologies and practices. 

Additionally, I used the book to structure the repository, creating one folder for each of the chapters (or sometimes group of chapters) that deals with a certain topic. 

I would like to end this section by encouraging you to support the author of the book and buy it if you can! It's a great resource that's both easy to read and very comprehensive as it englobes almost all aspect of web development. It also has a very hands-on approach that encourages you to write code ASAP and it even has text-book like questions to solidify your knowledge after finishing every chapter.

## Contents Index

### PHP

- **chapter_3** - Basic syntax, variables and constants

- **chapter_4** - Loops, conditionals, functions and types

- **chapter_5** - Classes, objects and function argument types

- **chapter_6** - Arrays

- **chapter_7** - Form handling, input validation and file processing

- **chapter_8-11** - MYSQL & PHP

- **chapter_13** - Session management and authentication

### JavaScript

- **chapter_14** - Basic syntax, variables, operators, arrays, DOM, browser history, etc.

- **chapter_15** - Conditionals, loops, weak typing, with statement

- **chapter_16** - Associative arrays, classes, sorting and queues

- **chapter_17** - Client-side input validation

- **chapter_18** - AJAX Requests

- **chapter_21** - Timeouts, intervals and modifying HTML & CSS

- **chapter_23** - Canvas API

### CSS

- **chapter_19** - Stylesheet types, syntax, selectors, colors, pseudo-classes, specificity, text properties, HTML identifiers (div and span) and the Box-Model (margins, border & padding)

- **chapter_20** - Text effects, web fonts, transforms, animations, backgrounds and advanced borders

### HTML5

- **chapter_12** - New input types

- **chapter_24** - Media tags

- **chapter_25** - Geolocation, drag and drop, cross-site messaging, web workers, local storage and microdata

- **chapter_26** - Final Project: Platespace, the world's leading fake dog social network 🐕*

*This chapter has its own dedicated README inside of the folder with instructions on how to use and install it. This is because it's its own dedicated project that brings all the chapters together and is thus more complicated. 

## Installation

To set up your development environment you'll need to install a LAMP stack on your computer or server or some equivalent with the same (or compatible) technologies. This will allow you to execute any of the .php programs by visiting them with your browser.

### Installing LAMP stack

#### Debian based systems

To install the LAMP stack in debian based distributions we can use tasksel, which is a tool that allow us to install multiple selected packages as a coordinated task. Open a terminal emulator and execute:

> `sudo apt-get update`
>
> `sudo apt-get install -y tasksel`
>
> `sudo tasksel install lamp-server`
>
> `sudo systemctl enable httpd mysqld`

The last command will enable the MySQL and Apache servers on system startup so you don't have to do it yourself every time you reboot.

#### Arch

Unfortunately, I wasn't able to find a full packaged solutions to intall the LAMP stack in other Linux distributions. However, we can install them one by one. Here, I'll show an example using Arch:

To install Apache, open a terminal emulator and execute:

> `sudo pacman -Syu`
>
> `sudo pacman -S apache`

To install MySQL execute (the last command configures MySQL and will ask you several questions about default configurations, enter yes on all of them to prevent security risks created by the default test configurations):

> `sudo pacman -S mysql`
>
> `sudo systemctl start mysqld`
>
> `sudo mysql_secure_installation`

To install PHP execute:

> `sudo pacman -S php php-apache`

Now, we need to add php to the apache configuration file by editing `/etc/httpd/conf/httpd.conf`. Paste the following at the end of the file:

> `# Use for PHP 5.x: LoadModule php5_module modules/libphp5.so AddHandler php5-script php Include conf/extra/php5_module.conf`

Finally, add apache and mysql to the list of daemons executed at startup with the following line (this will prevent you from having to start the services manually each time you reset your server or computer):

> `sudo systemctl enable mysqld httpd`

#### Windows

You can install a WAMP stack (the equivalent of a LAMP stack on Windows) installing WampServer in the following URL: https://www.wampserver.com/en/. There you'll find download links and installation instructions for the stack.

#### Configuring Apache

To configure the website inside apache, you'll need to navigate to the sites-available directory inside of your apache installation (usually `/etc/apache2/sites-available` on Linux) and copy the joaq_website.conf configuration file inside of it. This configurations creates a new virtual host that will host your site with the name www.joaqwebsite.com on your local computer on port 80. It will also expect the website to be located in the document root directory for debian distributions:  `/var/www/html/` in a folder named `joaq_website`. If your distribution has another document root directory (for example, in arch it's usually /srv/http/) change the DocumentRoot property to the correct path.

Then, copy the contents of this repository to the document root previously specified inside a folder called joaq_website (or whatever name you wish, just remember to change the DocumentRoot property accordingly).

Finally, enable the site by executing:

`a2ensite joaq_website.conf`