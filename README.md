Expense Tracker

Getting Started:
1. Make sure you have XAMPP installed.
2. Move whole "expenseTracker" folder to htdocs folder on your local drive (C:\xampp\htdocs)
3. Run XAMPP control panel and start Apache and MySQL.
4. Open phpmyAdmin and create a new database.
5. Name new database "cs602finalproject".
6. Open the file "createdb.sql" located in the "expenseTracker" folder.
7. Copy the first three lines "Privileges for ... " and run that on SQL on the phpMyAdmin website to create the proper permission credentials.
8. Copy and run on SQL the two create table (create table userData and create table expense) located in that same createdb.sql file.
9. You can run the insert SQL statements underneath the two create table statements.
10. Open new browser and go to: "http://localhost/expensetracker/"

Features:
1. Functional login page (uses sessions to identify whether a user is logged in or not)
2. Functional register page (creates new user and insert information into userData database.
3. Expenses.php will show a list of all the expenses associated with the logged in user.
4. Users can edit the expense information.
5. Summary.php sums all the expenses and incomes for the user.
6. searchExpense.php lets users search all their expenses by categories.
7. Logoff.php page will clear all sessions and bring user back to login page.

Author:
Danny Chiu

Version:
1.0
