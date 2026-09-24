# Employee Management API

## 1. API Title

Employee Management API

## 2. Base URL

http://127.0.0.1:8000/api/v1

## 3. Description

The Employee Management API is a RESTful API designed to manage employee information. It allows users to view, add, update, delete, search, and filter employees.

## 4. Resources

* employees
* departments

## 5. Endpoint List

| HTTP Method | Endpoint                   | Description                     |
| ----------- | -------------------------- | ------------------------------- |
| GET         | /employees                 | View all employees              |
| GET         | /employees/{id}            | View one employee               |
| POST        | /employees                 | Add an employee                 |
| PUT         | /employees/{id}            | Update employee information     |
| DELETE      | /employees/{id}            | Delete an employee              |
| GET         | /employees?search=juan     | Search employee by name         |
| GET         | /employees?department_id=1 | Filter employees by department  |
| GET         | /employees?page=2          | View the next page of employees |

## 6. Sample Request Body

```json
{
    "first_name": "Juan",
    "last_name": "Dela Cruz",
    "email": "juan@example.com",
    "department_id": 1,
    "position": "Programmer"
}
```

## 7. Sample Response Body

```json
{
    "id": 1,
    "first_name": "Juan",
    "last_name": "Dela Cruz",
    "email": "juan@example.com",
    "position": "Programmer",
    "department_id": 1,
    "department": {
        "id": 1,
        "name": "IT"
    },
    "created_at": "2026-09-24T10:00:00Z"
}
```

## 8. Status Code Plan

| Status Code | Meaning               | Usage                                  |
| ----------- | --------------------- | -------------------------------------- |
| 200         | OK                    | Successful GET, PUT, or DELETE request |
| 201         | Created               | Employee successfully added            |
| 400         | Bad Request           | Invalid request                        |
| 404         | Not Found             | Employee does not exist                |
| 422         | Unprocessable Entity  | Validation error                       |
| 500         | Internal Server Error | Server error                           |

## 9. Endpoint Details

### GET /employees

Returns employees, 10 per page. Each employee includes its department.

**Status:** 200 OK

### GET /employees/{id}

Returns one employee using the employee ID.

**Status:** 200 OK

If the employee does not exist:

**Status:** 404 Not Found

### POST /employees

Creates a new employee.

**Status:** 201 Created

### PUT /employees/{id}

Updates an existing employee.

**Status:** 200 OK

### DELETE /employees/{id}

Deletes an employee.

**Status:** 200 OK

### GET /employees?search=juan

Searches for an employee by name.

**Status:** 200 OK

### GET /employees?department_id=1

Returns employees whose department_id is 1 (IT).

**Status:** 200 OK

## 10. HTTP Methods

GET is used to retrieve information.

POST is used to create a new employee.

PUT is used to update employee information.

DELETE is used to delete an employee.

## 11. Data Format

The API uses JSON for request and response data.

Content-Type: application/json
