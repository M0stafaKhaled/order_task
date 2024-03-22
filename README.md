
# OrderTask Project

## Installation Instructions

Follow these steps to set up the project on your machine.

### Step 1: Environment Setup

First, create a `.env` file by copying the `.env.example`. You can use the following command:

```bash
cp .env.example .env
```

### Step 2: Database Configuration

Edit the `.env` file to set your database configurations. Update the following values according to your database setup:

- `DB_DATABASE` - Your database name.
- `DB_USERNAME` - Your database username.
- `DB_PASSWORD` - Your database password.

Make sure these values match your local database properties.

### Step 3: Application Installation

Once the `.env` file is configured, run the following command to install the application:

```bash
php artisan app:install
```

After executing this command, the application should be installed successfully.

## API Documentation

For easy use of the API, we have prepared a Postman collection. You can import this collection into your Postman application to explore the API endpoints.

[![Run in Postman](https://run.pstmn.io/button.svg)](https://www.postman.com/crimson-astronaut-614147/workspace/order-demo/collection/your-collection-id?action=share&creator=5909341)


