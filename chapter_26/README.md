# Platespace: the world's leading fake dog social network 🐕

This is the part of the repository that implements the project of the final chapter of the book. It brings all the explained technologies together and consists of a very basic social networking site where user's can sign up, create a profile, share messages, etc. 

Even though the structure of the project is basically the same, the implementation of the different pieces was coded using my own style and thought patterns.


## Features

- **Authentication system**:  users can **sign up** (*signup.php*) and **log in** (*login.php*) using salting and hashing for security. They can also log out in the logout.php, after visiting which their session will be destroyed.

- **Profile Editor**: users can create and edit their profile which contains an "*About me*" text and a profile picture (profile.php).

- **Members Browsing**: users can browse other users' profiles and access their messages and friends (*members.php*).

- **Friends & Followers**: users can follow other users in the members page. A user can view the users he's following and the users that are following them separately in the *friends.php* page.

- **Messaging**: users can send messages to other users in the *messages.php* page. There are two types of messages: public & private. Public messages can be viewed by all, while private messages can only be viewed by the sender & receiver of the message.

## Installation

Before using the website you need to create a data base to contain all the tables that are used. You can do so in the mysql by executing: 
> `create database platespace_db;`

You also need to create an account inside MySQL that has access to the database. To do so with the username already specified in the functions.php file execute in mysql: 
> `create user 'testApp'@'localhost' identified by 'phpApp'; grant all on platespace_db.* to 'testApp'@'localhost';`

Afterwards, to set up all the tables that will be used on the website execute ***setup.php*** by opening it up on your browser. Now you're all set up to start using the website!

## Usage

- To start using the web, you first have to sign up with a username navigating to signup.php. Afterwards, you'll be automatically redirected to the login page.

- In the log in page, enter your freshly created credentials and see the magic happen!

- You'll notice that on the top side of the website you'll see 5 buttons to navigate around the site.

- You can now navigate to "My Profile" and create your profile by writing your "About me" and uploading your profile picture.

- If you've created other users, you can view a full list of them and their following/follower status by clicking the "Members" button on the header of the page. You can also select a specific user to view their profile by clicking on their name.

- You can see your full list of friends by navigating to "Friends". You can also see a list of the friends of other users if you click on their "friends" button on their profile in the members page.

- You can send messages to other users by clicking on their "messages" button on their profiles in the members page. There, you can send both public messages (e.g messages that'll be visible by all) and private messages (e.g messages that'll be visible to only the senders and recepients of the messages). By navigating to the messages page directly from the header menu you can also see your own messages and delete any that you don't like (self mothering is the way to go!).