PROJECT=> Asset Tracking & Usage Management System

A web-based PHP Yii 1.1 application to manage assets, track assignments, 
and usage history.
This is a web-based application built using PHP (Yii 1.1 Framework) that 
helps organizations to track physical assets like laptops, monitors,and other office equipment, 
and manage how those assets are assigned and used by employees over time.

It helps answer questions like:

Who is using which asset?

When was it assigned and returned?


Features :

✅ Asset Management Module
Add new assets (e.g., Laptop #123, Monitor #001)

Assign asset types (e.g., Laptop, Printer, etc.)

Edit, delete, and view asset details

✅ Employee Management
Add, edit, and manage employee records

Link employees to assigned assets

✅ Asset Usage Tracking
Assign assets to employees with start date and end date

System checks for date conflicts to avoid double bookings

Keeps complete usage history

✅ Date Validation
Prevent assigning an asset to someone if it’s already in use

Allows editing and closing usage records

✅ AJAX Validation
When selecting asset and date, checks availability instantly using AJAX (no page reload)

✅ Efficient Data Handling
Uses LOAD DATA INFILE to import large data files quickly into MySQL

Built-in views (GridView, DetailView) for admin to easily view and manage assets

✅ Forgot Password Feature (Gmail SMTP)
Sends reset password link to user's email

Uses Gmail SMTP for sending secure emails



Tech Used :

- PHP (Yii 1.1)
- MySQL
- JavaScript + AJAX
- HTML/CSS

How to Run :

1. Clone the project or download ZIP
2. Import SQL file to your MySQL database
3. Set DB config in `/protected/config/main.php`
4. Run in browser 


▶️ 6. How to Run This Project (Locally)
Download or clone the project from GitHub:

git clone https://github.com/YourName/asset-tracking-system.git
Import the database:

Open phpMyAdmin or MySQL CLI

Import the provided SQL file (e.g., asset_db.sql)

Set database config:

Open: /protected/config/main.php

Edit database settings like:

php
Copy
Edit
'username' => 'root',
'password' => '',
'dbname' => 'asset_db',
Start XAMPP/WAMP and open browser:

url
Copy
Edit
http://localhost/asset-tracking-system/index.php?r=site/login
Login and start managing assets 



