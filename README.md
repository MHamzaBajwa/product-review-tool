Follow These Steps for testing or viewing

Plateform Requirements
This task is done by using PHP 8.1 and Laravel 10.

1- Run Command "composer update".
2- Make sure all dependencies are installed properly.
3- Create a new database and make connection in .env file.
4- Run command "php artisan migrate:refresh --seed" or "php artisan migrate --seed" for database migration.
5- Here is demo accounts and passwords (admin@gmail.com/admin123, user@gmail.com/admin123)

6- Login with Admin account
7- After login you will see simple dashboard having sidebar options (users,roles,products,feedback and category)
8- On User section admin can see all users and roles with active/inactive feature as well as can create new user.
9- On Role section admin can manage user access to dashboard
10- On Product section admin can view all products list after click on "Show" button admin can see relative feedbacks of product, vote,comments on feedback or add new feedback.
11- On Feedback section admin can see all feedbacks with user name,vote count and comments enable/disable feature on specific feedback.
12- List section in admin is Category where Admin can see Feedback Categories or add new category

13- Login with User account
14- User can visit home page and see all products
15- After clicking on detail button user can able to send feedback to admin or comment on existing feedback as well can vote on existing feedback.
16- User can edit or delete own feedback and can see details of other feedbacks.
17- In dashboard can see all feedbacks and thier comments also vote on feedback.


Note: Please create user role from admin dashboard and assign to user from edit user. If you face any issue regarding testing then I am attaching(database folder) my local database for backup you can use it for testing.
