# Local Setup for XAMPP

1. Clone repo:
   git clone <repo-url>

2. Copy folder to XAMPP htdocs:
   C:\xampp\htdocs\advertising-media-agency-php

3. Start Apache & MySQL in XAMPP

4. Open phpMyAdmin and create database:
   Name: ad_agency_db

5. Import `ad_agency_db.sql` (included in repo)

6. Update database connection in:
   config/database.php
   if MySQL password is not empty

7. Open browser:
   Public site: http://localhost/advertising-media-agency-php/public
   Admin login: http://localhost/advertising-media-agency-php/admin/login.php
