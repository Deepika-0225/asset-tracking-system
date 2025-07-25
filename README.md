## Asset Tracking & Usage Management System

A **web-based asset management system** built using **PHP (Yii 1.1 Framework)** to help organizations efficiently track, assign, and manage physical assets like laptops, monitors, and other office equipment.

### Features

* **Asset Management:** Add, edit, delete, and view assets with asset type categorization.
* **Employee Management:** Manage employee records and link them with assigned assets.
* **Asset Usage Tracking:** Assign assets with start/end dates while maintaining complete usage history.
* **Date Conflict Validation:** Prevents double bookings by validating asset availability.
* **AJAX Validation:** Checks asset availability instantly while assigning without page reloads.
* **Forgot Password:** Sends reset password links via Gmail SMTP securely.
* **Efficient Data Import:** Uses `LOAD DATA INFILE` for bulk data imports into MySQL.
* **Admin Views:** User-friendly GridView and DetailView for efficient monitoring.

### Tech Stack

* PHP (Yii 1.1)
* MySQL
* JavaScript + AJAX
* HTML, CSS

### How to Run Locally

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Deepika-0225/asset-tracking-system.git
   ```

2. **Import the database:**

   * Open phpMyAdmin or MySQL CLI.
   * Import the provided SQL file (e.g., `asset_db.sql`).

3. **Configure the database:**

   * Open `/protected/config/main.php`.
   * Update the database settings:

     ```php
     'username' => 'root',
     'password' => '',
     'dbname' => 'asset_db',
     ```

4. **Run the application:**

   * Start XAMPP/WAMP.
   * Visit:

     ```
     http://localhost/asset-tracking-system/index.php?r=site/login
     ```
   * Login using your admin credentials and start managing assets.

