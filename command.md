# Command List

1. laravel new ecom

2. php artisan serve

3. php artisan make:model Admin -mcr
    - For Making Admin Model and controller and migration
4. php artisan migrate
    - For Creating admins table
5. php artisan make:middleware AdminAuth
    - For Creating Admin Auth Middleware
6. php artisan make:model Category -mcr
    - For Making Category Model and controller and migration
7. php artisan migrate --path=/database/migrations/2021_10_12_063339_create_categories_table.php
   -For create category table
8. php artisan make:model Coupon -mcr
    - For Making Coupon Model and controller and migration
9. php artisan migrate
    - For Creating Coupan table
10. php artisan make:model Size -mcr
    - For Making Size Model and controller and migration
11. php artisan migrate
    - For Creating Size table
12. php artisan make:model Color -mcr
    - For Making Color Model and controller and migration
13. php artisan migrate
    - For Creating Color table
14. php artisan make:model Brand -mcr
    - For Making Brand Model and controller and migration
15. php artisan migrate
    - For Creating Brand table
16. php artisan storage:link
    - To create the symbolic link, Once a file has been stored and the symbolic link has been created.
17. php artisan make:model Product -mcr
    - For Making Product Model and controller and migration
18. php artisan migrate
    - For Creating Product table
19. composer dump-autoload
    - For using helper function
20. php artisan make:migration create_product_attrs_table
    - For Making product_attrs table
21. php artisan migrate
    - For Creating Product_attrs table
22. php artisan make:request ProductFormRequest
    - For Creating Product Request
23. php artisan make:migration create_product_images_table
    - For Making product_images table
24. php artisan make:model Tax -mcr
    - For Making Tax Model and controller and migration
25. php artisan migrate
    - For Creating Taxs table
26. php artisan make:model Customer -mcr
    - For Making Customer Model and controller and migration
27. php artisan migrate
    - For Creating Customer table
