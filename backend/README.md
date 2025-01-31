# API Documentation

## Overview

Provide a brief overview of your API, its purpose, and its main features.

## Base URL

```
http://localhost:8080/api/
```

## Authentication

Describe authentication methods (e.g., API keys, OAuth, JWT, etc.).

```
Authorization: Bearer <token>
```

## Endpoints

`user`:

### 1. Get LogedIn User

**Endpoint:**

```
GET /users



```

**Description:** Retrieves current logged in user data.

**Response:**

```json
{
  "status": 200,
  "success": true,
  "message": "User Data Fetched",
  "data": {
    "id": 1,
    "name": "Subrata Mondal",
    "email": "subrata@sm.com",
    "username": "subrata",
    "role": "faculty",
    "institute": "subrata univercity of engineering",
    "createdAt": "2025-01-31 15:27:28",
    "updatedAt": "2025-01-31 15:27:28"
  }
}
```

---

### 2.Create users

**Endpoint:**

```
POST /users


```

**Description:** Retrieves details of a specific item.

**Parameters:**

- `id` (integer, required): The ID of the item.
- `name` (string ,required)
- `email` (string ,required)
- `password` (string ,required)
- `username` (string ,required)
- `role` (string ,required)
- `institute` (string ,required)

**Response:**

```json
{
  "status": 201,
  "success": true,
  "message": "User created successfully",
  "data": {
    "id": "3"
  }
}
```

---

### 3. Login

**Endpoint:**

```
POST /login
```

**Description:** Login users

**Request Body:**

```json
{
  "name": "subrata@email.com",
  "description": "student,faculty,international_partners"
}
```

**Response:**

```json
{
  "status": 200,
  "success": true,
  "message": "Logged in successfully",
  "data": {
    "id": 1,
    "name": "Subrata Mondal",
    "email": "subrata@sm.com",
    "username": "subrata",
    "role": "faculty",
    "institute": "subrata univercity of engineering",
    "createdAt": "2025-01-31 15:27:28",
    "updatedAt": "2025-01-31 15:27:28"
  }
}
```

---

### 4. Delete An user

**Endpoint:**

```
DELETE /users
```

**Description:** Delete an user.

**Response:**

```json
{
  "status": 200,
  "success": true,
  "message": "Logged out successfully",
  "data": []
}
```

---

### 5. Update Password

**Endpoint:**

```
PATCH /users/password
```

**Description:** Update the password of a user.

<!-- remove parameters -->

**Parameters:**

- `id` (integer, required): The ID of the item.
- `oldPassword` (string, required)
- `newPassword` (string, required)

<!-- add request body -->

---json
{
"oldPassword": "subrata",
"newPassword": "subrata new"
}

---

**Response:**

```json
{
  "status": 200,
  "success": true,
  "message": "Password updated successfully",
  "data": {
    "id": 1,
    "name": "Subrata Mondal",
    "email": "subrata@sm.com",
    "username": "subrata",
    "role": "faculty",
    "institute": "subrata univercity of engineering",
    "createdAt": "2025-01-31 15:27:28",
    "updatedAt": "2025-01-31 15:27:28"
  }
}
```

---

### 6. Update user Details

**Endpoint:**

```
PATCH /users
```

**Description:** Deletes an item by its ID.

<!-- add request body -->

- `email` (string,required)
- `email` (string,required)
- `email` (string,required)
- `email` (string,required)
  ---json
  {
  "email": "subrata@example.com",
  "name": "Subrata updated",
  "username": "subrataupdate",
  "password": "subrata"
  }

---

**Response:**

```json
{
  "status": 200,
  "success": true,
  "message": "User data updated successfully",
  "data": {
    "id": 1
  }
}
```

## Error Codes

| Code | Meaning               |
| ---- | --------------------- |
| 400  | Bad Request           |
| 401  | Unauthorized          |
| 403  | Forbidden             |
| 404  | Not Found             |
| 500  | Internal Server Error |

## Rate Limits

Provide rate limit information if applicable.

## Contact

Provide support or contact details for API-related queries.
