# Attendence
## 1. Create database 
  Run the below command on the phpmyadmin -> SQL
    
    CREATE DATABASE organization;

    Import the .sql file for creating the tables in the organization database and inserting data in them.
In the attendence table have added the table fields like sign_in_location, sign_in_lat, sign_in_long and similar fields for sign_out as well.
These fields are added for furture use, if we want to track the user locations for their respective sign_in and sign_out actions

## 2. File Structure   
Admin folder contains all the code of the admin side while the client folder contains all the code of the client side.
Considering that the admin folder would be the subdomain and the client folder would be the main domain, have kept the folders separate(with separate codeigniter setup).

## 3. Setup
Considering the application would be tested on xampp or wamp. Follow the steps to get the further setup done.
Inside htdocs create folder project/attendence/ and in attendence folder add the admin and client folders.

## 4. Admin Navigation and purpose of each page

- Dashboard - Listing the count of all the employees and today's attendence count. On clicking each of them, it will take the user to the respective pages.
Each module of the application can be added here which is helpful when the left panel has more links and pages.
- Add employees - On this page employess can be added. After adding, status of the same would be reflected at the top.
- List Employees - All the employees are listed on this page. There a column of action, which provides the ability to delete, edit and get the current month attendence of each employee.
- Today's Attendence - This page will list the today's attendence status

## 5. Client navigation 
The home page contains the sign in form, on success user will be taken to the sign out page. Since we want to track the attendence only after sign in, user is redirected to sign out.
If there is other functionality(like checking the user activity after sign in) user can be accordingly redirected to the respective pages. For now have kept users navigation limited to sign in and sign out pages only.

## 6. Updating the user with the unique token 
When the admin adds the user, currently the unique token is generated and kept in DB.
To update the user about the unique token, an automated email and sms could be sent for the same.
