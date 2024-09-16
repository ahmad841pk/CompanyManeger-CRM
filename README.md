# Company-Employee Management (CRM) API
## Setup Instructions
- Install composer.
- Run Command composer install/update.
- Copy the .env.example to .env.
- Add your database info.
- Run Command php artisan migrate:fresh
- Run Command php artisan db:seed (to create admin user).
## Admin Credentials 
- email = admin@admin.com
- password = password

## Company Api (protected)
 - host/api/compnay (POST/GET/PATCH/DELETE)

#### Company Fillable
 -  [  name (required) , email (required), logo(min 100x100), website ]

## Employee Api (protected)
 - host/api/employee (POST/GET/PATCH/DELETE)

#### Employee Fillable
- [ first_name (required), last_name (required), email (required), phone, company_id (reference on companies.id) ]
 




