# KC report test

## Overview
KC Report Test is a web application built using the **Spiral Framework** and **Cycle ORM**. It provides a set of APIs to generate business reports for analyzing sales data across different regions and categories.

This application is optimized for performance, ensuring that reports run efficiently within MySQL 8.0. It supports batch data updates and is designed to handle scalable data growth.


To set up the project, run the following commands:
```bash
composer install
```

Now you can configure the `Database`.
To do this, open the .env file and set up the database access credentials.
```dotenv
# Database
DB_CONNECTION=mysql
DB_DATABASE=cycle_test
DB_USERNAME=****
DB_PASSWORD=****
```

And run migrations:
```bash
php app.php cycle:migrate
```

And run seeds:
```bash
php app.php db:seed
```

After the installation is complete, you can start the application using the following command:
```bash
rr serve
```

# KC Report Test

## Overview
KC Report Test is a web application built using the **Spiral Framework** and **Cycle ORM**. It provides a set of APIs to generate business reports for analyzing sales data across different regions and categories.

This application is optimized for performance, ensuring that reports run efficiently within MySQL 8.0. It supports batch data updates and is designed to handle scalable data growth.

## Installation
To set up the project, run the following commands:
```bash
composer install
```

### Database Configuration
Open the `.env` file and set up the database access credentials:
```dotenv
# Database
DB_CONNECTION=mysql
DB_DATABASE=cycle_test
DB_USERNAME=****
DB_PASSWORD=****
```

Then, run the migrations:
```bash
php app.php cycle:migrate
```

### Running the Application
Start the application using:
```bash
rr serve
```

## Available APIs
The project includes three APIs to generate key business reports:

### 1. **Show Orders**
- **Endpoint:** `GET /show-orders`
- **Description:** Fetches a list of all orders from the database.
- **Response Format:**
  ```json
  {
      "data": [
          {
              "orderId": 1,
              "customerId": 5,
              "orderDate": "2024-01-15",
              "storeID": 4
          },
          ...
      ]
  }
  ```

### 2. **Monthly Sales by Region**
- **Endpoint:** `GET /monthly-sales-by-region`
- **Description:** Provides total sales amount and number of orders, grouped by **year, month, and region**.
- **Response Format:**
  ```json
  {
      "data": [
          {
              "year": 2024,
              "month": 1,
              "region_id": 1,
              "total_sales_amount": 25000.00,
              "number_of_orders": 100
          },
          ...
      ]
  }
  ```

### 3. **Top Categories by Store**
- **Endpoint:** `GET /top-categories-by-store`
- **Description:** Provides top-selling product categories and its rank per store within date range.
- **Query Parameters:**
    - `start_date` (required) – Start date of the range
    - `end_date` (required) – End date of the range
- **Response Format:**
  ```json
  {
      "data": [
          {
              "store_id": 1,
              "category_id": 3,
              "total_sales_amount": 12000.00,
              "category_rank": 1
          },
          ...
      ]
  }
  ```

## Project Features
- **Efficient Report Generation**: Optimized SQL queries ensure that reports run within 1 second.
- **Cycle ORM Integration**: Uses Cycle ORM for managing database entities.
- **Docker Compatibility**: Can be containerized for deployment.
- **Scalability**: Designed to handle growing data requirements.

## License
This project is open-source and available under the **MIT License**.

---

### Contributors
We welcome contributions! Feel free to submit pull requests or open issues in the repository.

---

This project is now **ready to be made public** on GitHub! 🚀



### Contributors
We welcome contributions! Feel free to submit pull requests or open issues in the repository.

---

This project is now **ready to be made public** on GitHub! 🚀

