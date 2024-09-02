### Laravel Coding Test: Customer Search Functionality

**Objective:**
The purpose of this test is to evaluate your ability to implement search functionality in a Laravel application, leveraging Eloquent relationships and applying best practices for efficient database queries.

**Task Description:**

You are working on a Laravel application that manages customers, their orders, and the items within those orders. The application needs to allow users to search through customers based on various criteria.

### Requirements:

1. **Create a Customer Listing:** Implement functionality to list all customers along with their associated orders and items.

2. **Implement a Search Feature:** Add a search option that allows users to search for customers based on:
    - Customer email
    - Order number
    - Item name

3. **Filter the Results:** The search results should filter the customers based on the search criteria provided. Ensure that the search functionality works efficiently and returns relevant results based on the input.

4. **Ensure Efficient Queries:** Consider the impact of your implementation on performance, especially regarding database queries. Your solution should be optimized to avoid unnecessary database calls and should handle large datasets efficiently.

5. **Document Your Approach:** Write a brief explanation (200 words or less) describing how you implemented the search functionality and any considerations you took into account to optimize performance.

**Deliverables:**

- The implemented search functionality.
- A brief explanation of your approach and how you optimized the search.

**Evaluation Criteria:**

- Effective implementation of the search functionality across multiple related models.
- Proper use of Eloquent relationships and query optimization techniques.
- Code clarity and maintainability.
- Consideration for scalability and performance.

**Submission:**
Submit your code and explanation via email or through a GitHub repository link.

---
This test is designed to evaluate your ability to implement complex search functionality in Laravel, optimizing for performance and adhering to best practices.


Create a branch with your name and submit your code in a pull request.

### Explantion of Implementation:
I implemented the search functionality in Laravel by allowing users to search for customers based on email, order number, or item name. The search is handled in the CustomerController, where I used Eloquent's whereHas method to filter related models efficiently. This approach ensures that only the relevant customers, along with their associated orders and items, are retrieved.

To optimize performance, I ensured that key columns like email, order_number, and item name are indexed to speed up database lookups. Eager loading (with) was applied to prevent the N+1 query problem, reducing the number of database queries needed. I also employed query scopes in the model to keep the code clean and reusable. This combination of techniques helps in handling large datasets efficiently while maintaining a responsive search experience.
### Usage:
1. **Composer Install Command:** 
run composer install , make sure you have the latest version of composer

2. **Php Artisan Migrate Command:** 
run php artisan migrate:refresh or php artisan migrate for creating tables in database

3. **Database Seeder:** 
run php artisan db:seed --class=DatabaseSeeder
if above command gives error then run commands in sequence for dumpping fake data
run php artisan db:seed --class=UserTableSeeder
run php artisan db:seed --class=ItemTableSeeder
run php artisan db:seed --class=OrderItemTableSeeder

4. **Serve Laravel:** 
run php artisan --serve to run 127.0.0.1:8000
visit website (http://127.0.0.1:8000/customers)