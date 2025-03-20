# Laravel Wallet API

A Laravel-based API for managing user wallets, allowing deposits and withdrawals with proper authentication.

## Table of Contents

-   [Features](#features)
-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Database Setup](#database-setup)
-   [Running the Application](#running-the-application)
-   [API Documentation](#api-documentation)
-   [Authentication](#authentication)
-   [Models](#models)
-   [Controllers](#controllers)
-   [Services](#services)
-   [Validation](#validation)
-   [Testing](#testing)

## Features

-   User registration and authentication using Laravel Sanctum
-   Wallet management system
-   Deposit and withdrawal operations
-   Balance checking
-   Input validation
-   Database transaction support for financial operations

## Requirements

-   PHP 8.2 or higher
-   Composer
-   MySQL or compatible database
-   Laravel 12.x

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/laravel-wallet-api.git
    cd laravel-wallet-api
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Create a copy of the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

4. Generate application key:
    ```bash
    php artisan key:generate
    ```

## Configuration

Edit the `.env` file to configure your application:

```
APP_NAME="Laravel Wallet API"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wallet_api
DB_USERNAME=root
DB_PASSWORD=
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000,127.0.0.1,127.0.0.1:8000
```

## Database Setup

1. Create a database for the application.

2. Run migrations to create the necessary tables:

    ```bash
    php artisan migrate
    ```

3. (Optional) Seed the database with test data:
    ```bash
    php artisan db:seed
    ```
    This will create a test user with email: `test@example.com`

## Running the Application

Start the development server:

```bash
composer run dev
```

The API will be available at `http://localhost:8000`.

## API Documentation

### Authentication Endpoints

#### Register a new user

-   **URL**: `/api/v1/auth/register`
-   **Method**: `POST`
-   **Body**:
    ```json
    {
        "name": "John Doe",
        "email": "john@example.com",
        "password": "password123"
    }
    ```
-   **Response**:
    ```json
    {
        "access_token": "1|abcdefghijklmnopqrstuvwxyz123456",
        "token_type": "Bearer"
    }
    ```

### Wallet Endpoints

#### Get Wallet Balance

-   **URL**: `/api/v1/wallet/balance`
-   **Method**: `GET`
-   **Headers**: `Authorization: Bearer {token}`
-   **Response**:
    ```json
    {
        "balance": 100.0
    }
    ```

#### Deposit Money

-   **URL**: `/api/v1/wallet/deposit`
-   **Method**: `POST`
-   **Headers**: `Authorization: Bearer {token}`
-   **Body**:
    ```json
    {
        "amount": 50.0
    }
    ```
-   **Response**:
    ```json
    {
        "message": "Deposit successful",
        "balance": 150.0
    }
    ```

#### Withdraw Money

-   **URL**: `/api/v1/wallet/withdraw`
-   **Method**: `POST`
-   **Headers**: `Authorization: Bearer {token}`
-   **Body**:
    ```json
    {
        "amount": 25.0
    }
    ```
-   **Response**:
    ```json
    {
        "message": "Withdrawal successful"
    }
    ```
-   **Error Response** (if insufficient balance):
    ```json
    {
        "message": "Insufficient balance"
    }
    ```

## Authentication

This API uses Laravel Sanctum for authentication. To access protected routes, include the token in the Authorization header:
Authorization: Bearer your-token-here

## Models

### User Model

The User model extends Laravel's Authenticatable class and includes:

-   Basic user attributes (name, email, password)
-   Relationship to Wallet
-   Methods for wallet operations

### Wallet Model

The Wallet model represents a user's wallet and includes:

-   Balance tracking
-   Methods for deposit and withdrawal operations
-   Relationship to User

## Controllers

### AuthController

Handles user registration and authentication.

### WalletController

Manages wallet operations:

-   Getting balance
-   Depositing funds
-   Withdrawing funds

## Services

### WalletService

Provides business logic for wallet operations:

-   Creating wallets for users
-   Handling deposits with database transactions
-   Processing withdrawals with validation

## Validation

Request validation is handled through dedicated Form Request classes:

-   `RegisterPostRequest`: Validates user registration data
-   `DepositPostRequest`: Validates deposit amount
-   `WithdrawPostRequest`: Validates withdrawal amount

## Testing

Run the tests with PHPUnit:

```bash
php artisan test
```

## Postman Collection

A Postman collection file is included in the root directory at `postman_collection.json`. Import this file into Postman to test the API endpoints.
