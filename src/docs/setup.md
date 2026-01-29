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



✅ 1. What each column means (table explanation)
✅ duration

✔️ How long the service takes (ex: 7 days, 2 weeks, etc.)
Example: “Delivery in 5 days”

✅ platform

✔️ Where the service will be applied
Example: “Facebook”, “Instagram”, “YouTube”, “TikTok”

✅ target_audience

✔️ Who the ads will target
Example: “Young adults 18-30 in Phnom Penh”

✅ service_includes

✔️ What you will get in the package
Example:

Ad design

Audience targeting

Monthly report

✅ requirements

✔️ What customer must provide
Example:

Business logo

Product images

Website link

✅ delivery_time

✔️ Delivery time for final work
Example: “3 days after confirmation”

✅ revisions

✔️ How many edits the customer can request
Example: “2 revisions included”

✅ notes

✔️ Extra important information
Example: “Extra fee for urgent delivery”

✅ image_url

✔️ Service image for the detail page
Example: uploads/service1.jpg