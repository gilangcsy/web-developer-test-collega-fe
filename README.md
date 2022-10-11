# Web Developer Test Collega Back End

# Pre-requisites
- PHP (>= 7.0.0)
- [Laravel](https://laravel.com)
- [Composer](https://getcomposer.org) 

# Getting started
- Clone the repository
```
git clone  <git lab template url> <project_name>
```
- Install dependencies
```
cd <project_name>
composer install
```
- Create .env file and generate the application key
```
cp .env.example .env
php artisan key:generate
```
- php artisan serve
```
  Navigate to `http://localhost:8000`
```  

# How to get an account for Login
- Assuming you've already installed and running back-end side (https://github.com/gilangcsy/web-developer-test-collega-be)
- Open your Postman, and run this API:
```
[POST] http://localhost:3001/v1/users
```
- Example response from API:
```
{
    "success": true,
    "message": "Generate user has been success.",
    "data": {
        "name": "dynamic-value",
        "email": "user7@collega.co.id",
        "password": "$2b$10$iCR1HfmkWK1FbUdcpT9FYuxu6L1jawZkIekMFQcLUp6iNsxpOo2Cm"
    }
}
```
- You can use the email for login, and type the password: 123
