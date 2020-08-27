# Camagru

This is a media sharing website between users of the websites. it includes the manipulating image media, uploading of said media and the interaction with that media via comments and likes.

# Programming tech used

PHP - Back end data processing, database interaction/handling and Front end data presentation.

SQL - Database

JavaScript - Front end media capture functionality

HTML - Front end webpage creation and presentation

CSS - Front end webpage appearance

# prerequisite

Bitnami Apache Servers to host on and mysql
valid choices

MAMP - mac

WAMP - windows

LAMP - Linux

sendmail - free open source software for mail transfer

# Installing

* To enable the mail functionality on Linux and MAC 
 (bitnami MAMP/WAMP dir)/php/etc/php.ini and uncomment the `sendmail_path = "env -i /usr/sbin/sendmail -t -i"` line via find. windows has its own slightly method.

* Clone into repo into your "WAMP/apache2/htdoc/" directory.

* Modify the $DB_PASSWORD variable for the Database to the one matching your bitnami Apache server flavor under: "Camagru/config/database.php"

* Locate and run your Apache Server executable

* Start both the MySQL Database and Apache Web Server

* On browser visit the "https://localhost/camagru/config/setup.php" to create the database. then everything should be set

# File structure

Camagru ->

    config -> (database setup)
        database.php - database creation and connection variables
        setup - database creation

    css -> (webpage styling)
        mystyles.css - webpage styling

    functions -> (universally used code functions)
        sanitize - prevent harmful inputs into back end logic

    js -> (javascript code)
        postcam & postcam - frontend java code for webcam integration

    login -> (everything related to logging in)
        log_in_info - [back-end logic] validates user input and logs them in if valid
        login.php - [front-end] login page
        logout.php - [back-end logic] logouts user

    messages -> (feed back messages for font end)
        phpboxmessages.php - [front-end] contains php code to display user feedback messages ie wrong password

    Resources -> (images to use as stickers via editing)

    signup -> (everything relating to signing up)
        email_verification.php - [back-end logic] registers the newly made account if the account verification email code is valid.
        forgotpassword.php - [front-end] forgot password with email field page
        forgotpasswordinfo.php - [back-end logic] verifies if email input is valid and sends a password reset link to email
        resetpassword.php - [front-end] password reset with new password fields page
        resetpasswordinfo.php - [back-end logic] compares 
        resetverification.php - [back-end logic] verifies whether the password reset request is valid
        signup.php - [front-end] sign up page
        signupinfo.php - [back-end logic] verifies new account information, if valid issues out a validation email needed to log in

    uploads -> (contains the uploaded media by users)

    user -> (relates to all user specific interactions)
        commentinfo.php - [back-end logic]
        comments.php - [front-end] 
        deletepostinfo.php - [back-end logic] deletes post from database and upload dir
        likeinfo.php - [back-end logic] increases post like count
        newemail_verification.php - [back-end logic] verifies new email to link to account
        post.php - [front-end] page where user can create a post a new post.
        profile.php - [front-end] displays user account settings.
        profileinfo.php - [back-end logic] if user logs a setting change registers change to database.
        uploadpic.php - [back-end logic] adds stickers to image if specified and uploads picture.
        viewposts.php - [front-end] shows user all their uploaded posts

    index.php - [front-end] gallery for all user uploaded media.

# Test Outline

https://github.com/wethinkcode-students/corrections_42_curriculum/blob/master/camagru.markingsheet.pdf