# User Data Management & Twitter OAuth API

This project is a Symfony-based backend application that provides APIs for managing user data (via CSV upload) and integrating Twitter OAuth for authentication. It includes features like database backup/restore, asynchronous email notifications, and secure admin-only endpoints.

---

## **Technology Stack**
- **Language**: PHP 8.1+
- **Framework**: Symfony 6.3
- **Database**: MySQL 8.0+
- **Authentication**: Twitter OAuth 1.0a
- **Email Service**: Symfony Mailer (SMTP)
- **CSV Parsing**: League\Csv
- **Async Processing**: Symfony Messenger

---

## **Setup Instructions**

### Prerequisites
- PHP 8.1+
- MySQL 8.0+
- Composer
- Symfony CLI (optional)
- Twitter Developer Account (for OAuth keys)

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/Vins-z/User-Mangement-PHP.git
   cd user-management
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure the `.env` file:
   - Update `DATABASE_URL` with your MySQL credentials.
   - Add Twitter OAuth keys (`TWITTER_CLIENT_ID` and `TWITTER_CLIENT_SECRET`).
   - Configure `MAILER_DSN` for email notifications.

4. Run database migrations:
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

5. Start the Symfony server:
   ```bash
   symfony serve
   ```

---


## **API Endpoints**

### 1. Upload and Store Data
- **Endpoint**: `POST /api/upload`
- **Description**: Upload a CSV file to store user data.
- **Request**:
  - Method: `POST`
  - Headers: `Content-Type: multipart/form-data`
  - Body: `file` (CSV file)
- **Response**:
  ```json
  {
    "message": "CSV processed"
  }
  ```

### 2. View User Data
- **Endpoint**: `GET /api/users`
- **Description**: Retrieve all user data from the database.
- **Response**:
  ```json
  [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "username": "johndoe",
      "address": "123 Main St",
      "role": "USER"
    }
  ]
  ```

### 3. Backup Database
- **Endpoint**: `GET /api/backup`
- **Description**: Generate a backup of the database.
- **Response**: A `.sql` file for download.

### 4. Restore Database
- **Endpoint**: `POST /api/restore`
- **Description**: Restore the database from a backup file.
- **Request**:
  - Method: `POST`
  - Headers: `Content-Type: multipart/form-data`
  - Body: `file` (SQL file)
- **Response**:
  ```json
  {
    "message": "Database restored"
  }
  ```

---

## **Twitter OAuth Integration**

### 1. Initiate Twitter Authentication
- **Endpoint**: `GET /auth/twitter`
- **Description**: Redirects the user to Twitter for authentication.

### 2. Handle Twitter Callback
- **Endpoint**: `GET /auth/twitter/callback`
- **Description**: Handles the OAuth response, stores user data, and redirects back to the app.

---

## **Testing with Postman**

1. Import the provided Postman collection.
2. Update the environment variables in Postman:
   - `base_url`: `http://localhost:8000`
   - `admin_token`: Admin JWT token (if using JWT authentication).
3. Test the following endpoints:
   - `POST /api/upload`
   - `GET /api/users`
   - `GET /api/backup`
   - `POST /api/restore`
   - `GET /auth/twitter`
   - `GET /auth/twitter/callback`

---

## **Database Backup/Restore**

### Backup
- Run the following command to manually create a backup:
  ```bash
  php bin/console app:backup-db
  ```

### Restore
- Use the `/api/restore` endpoint or run:
  ```bash
  php bin/console app:restore-db backup.sql
  ```

---

## **Email Notifications**

- Emails are sent asynchronously using Symfony Messenger.
- Configure the `MAILER_DSN` in `.env` to use your SMTP provider.
- Emails are sent to users after their data is successfully stored.

---