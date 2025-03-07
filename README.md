# Alumni Management System - Review

## Project Overview
The **Alumni Management System** is a web-based platform developed using **PHP and MySQL** to facilitate communication and engagement between alumni and the college. It enables alumni to register, update their profiles, share experiences, and participate in college events.

## Features Implemented
1. **User Authentication:**
   - Registration and login for alumni.
   - Password reset functionality.
2. **Profile Management:**
   - Alumni can edit and update their profiles.
   - Upload profile pictures.
3. **Event Management:**
   - Admins can create and manage alumni events.
   - Alumni can RSVP and participate in discussions.
4. **Job Posting & Opportunities:**
   - Alumni can share job openings.
   - Students can apply for opportunities.
5. **Search & Directory:**
   - Search alumni based on batch, department, and location.
6. **Admin Panel:**
   - Manage user roles and permissions.
   - Approve alumni registrations.

## Technologies Used
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP 
- **Database:** MySQL
- **Version Control:** Git

## Database Structure
- **users** (id, name, email, password, batch, department, profile_picture, etc.)
- **events** (id, title, description, date, location, organizer_id)
- **jobs** (id, company, position, location, alumni_id, description, posted_at)
- **messages** (id, sender_id, receiver_id, message, timestamp)

## Installation Guide
1. Clone the repository:
2. Import the database from `database.sql` into MySQL.
3. Configure `config.php` with database credentials.
4. Start the local server (XAMPP, WAMP, or MAMP).
5. Access the project via `http://localhost/alumnireview/`.



## Contact
For any issues, contact **[lokeshuppu4242@gmail.com]** or raise an issue on GitHub.
