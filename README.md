# PHP-Form-Validation-and-Database-Connectivity
## INTRODUCTION
PHP is a popular scripting language that is used in web development. Originally standing for Personal Home Page, PHP now 
stands for PHP : Hypertext Processor. PHP code is processed on a web server by a PHP interpreter, the result of which forms the HTTP 
response of the web page whole or some part of it. PHP can be used to build dynamic web applications with various contents among which 
forms are a very important part. Form Handling using PHP is a very common and useful practice for various reasons like ease of use, easy 
integration, cost efficiency and security. Form is an HTML tag that contains various types of inputs for collecting information from the 
user. After the form has been submitted, it can be handled using PHP methods i.e. GET and POST methods. The values of forms when using 
GET method are visible in the URL while the values are not visible in the URL when using POST method. Due to this, GET method has high 
performance compared to POST since, GET method simply appends values in URL while POST spends time during encapsulation of values in 
HTTP body. Due to the nature of Registration and Login forms i.e. sensitive information has to be processed, POST method is more 
suitable. Hence POST method is used in this assignment. For Database connectivity, MySQL is used through PHP.

A working demo of the website is hosted on : https://nabinadhikarilpu.000webhostapp.com/

## PROBLEM STATEMENT
The assignment deals with the building process of a registration form for any user to register on websites. The form used for 
registration has to contain First Name, Last Name, Email, Gender, Password and Agreement on Terms and Conditions of the website. These 
are the fields that must be filled by the user to continue on the registration process. The email is to be validated and the password 
should contain at least one uppercase, one lowercase, one special character and one number. The minimum password length should be more 
than six. After the form is filled properly and validation is done, the form is submitted and if successful, the website should be 
redirected to a new page with all the data/values submitted by the user must be saved/ stored in a database.

## DESCRIPTION
The problem statement highlights all the issues that are to be dealt in this assignment i.e creating a form, required fields must be 
filled by the user, values should be validated and the password should follow the given conditions. Form was created by using the “form” 
HTML tag. The various fields to be filled by the user were created using the “input” HTML tag. The form was created with the POST PHP 
method, so the validation and value checks were done with PHP. After the validation and value checks, the form, if submitted, was stored 
in a database by using MySQL. If database storage is successful, the user is redirected to a new page i.e. login page from where the 
user can login using either email or, username and the password user provided during registration. The password was stored in the 
database by using the md5 hash function for security. From the login page, if the user provides correct credentials, the user is logged 
in in the site and is redirected to the home page where the user can see their login status and also can logout. The home page is a 
simple page with user information (Username/ Email ) and links (for registration and login pages).	

## TEST CASES AND SNAPSHOTS
A workinig demo is hosted on the free web page hosting platform “000webhost”, whose link is also provided in the "INTRODUCTION"
section of this file.

