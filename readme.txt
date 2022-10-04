User manual to use the website:
User manual

1) Download XAMMP for your relevan OS (https://www.apachefriends.org/)
2) Gain the necessary files within the zip file or on GitHub (https://github.com/s3844786/sec-practical-assessment) in dev branch
3) You should have a main folder called sec-assessment and within it contains 4 folders(client/database/resources/server), readne.txt and a pdf of database structure

Step 4 & 5 are dependant on your OS:
4) If you are on MacOS, copy the sec-assessment folder and go to Finder > Applications > XAMMP(Folder) > htdocs and paste the sec-assmenet folder in it
5) If you are on Windows, copy the sec-assessment folder and go to C:\XAMMP\htdocs and paste the sec-assmenet folder in it

6) Open the XAMMP application, called "manager-osx" located in the directory before htdocs 
    macOS -> finder > xammp > manager-osx
    Windows - C:\XAMMP\manager-osx?(I run mine on macOS so I assume name is same)
7) Once the application is opened, go to Manage Servers and start MySQL database and Apache Web Servers

Setting up database
8) Go to your web browser and go to this URL: http://localhost/phpmyadmin/
9) Create a new database called test unless there one exists
10) Within test database, create a table called:
    - cart_items
        - Columns
            - id(int(11), Auto Increment or A.I), product_id(int(11)), quantity(double), user_id(int(11))
            - where id is primary key
    - products
        - Columns
            - id(int(20), Auto Increment or A.I), name(varchar(255)), price(double(10, 2)), image(blob)
            - where id is primary key
    - users
        - Columns
            - id(int(20), Auto Increment or A.I), username(varchar(255)), password(varchar(255)), email(varchar(255)), phone(int(11)), role(int(1))
            - where id is primary key
    - An image of the database setup will be in the sec-assessment folder

Using the website
11) Once database is setup, go to web browser and go to http://localhost/sec-assessment/client/home.html
12) Go to login located at top right corner
13) Click sign up here to go to the registration page
14) Fill out the form and select your role (user or admin which will allow you to add or remove items to database)
15) Once you have registed an account, go back to login page and sign in
16) This will bring you to the home page where you are able to see the catalog and items in the database
17) If you go to items in the navigation bar, you will be able to see the item database and depending if your account is an admin or not, you are able to add and remove items from the database
18) Going to the catalog, you will be able to see the items from the catalog and be able to add items to the cart located at the bottom
