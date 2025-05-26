### **1\. Project Documentation **


1.  **Database Setup**
    

*   Start XAMPP and launch MySQL
    
*   Access phpMyAdmin at http://localhost/phpmyadmin
    
*   Create new database: competition
    
*   Import sql/schema.sql
    

1.  **Configure Database Connection**Edit includes/db.php:
    


`   $host = 'localhost';  $user = 'root';  $password = '';  // XAMPP default  $database = 'competition';   `

1.  **Copy Files to XAMPP**
    

*   Move project folder to xampp/htdocs/
    

1.  **Access Application**
    

*   Admin Panel: http://localhost/competition-system/admin/judges.php
    
*   Judge Portal: http://localhost/competition-system/judges/scoring.php
    
*   Scoreboard: http://localhost/competition-system/public/scoreboard.php
    

Database Schema
---------------

 -- See sql/schema.sql for full details  Tables:  - users (participants)  - judges (judge credentials)  - scores (scoring records)   `

Assumptions
-----------

1.  No authentication required for demo purposes
    
2.  Pre-registered users exist in database
    
3.  Single judge session (hardcoded judge\_id=1)
    

Design Choices
--------------

1.  **PHP Procedural Style**: Chosen for simplicity and direct database interaction
    
2.  **Plain CSS**: Avoid framework dependencies
    
3.  **Auto-Refresh**: Vanilla JavaScript for scoreboard updates
    
4.  **Input Validation**: Basic PHP filtering in forms
    

Future Enhancements
-------------------

*   User authentication system
    
*   Real-time updates using WebSockets
    
*   CSV export functionality
    
*   Judge-specific scoring history
