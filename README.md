# EXAMPLE NOTES API

### Installation

1. Clone the repository:
   ```bash
   gh repo clone VaclavKlima/example-notes-api
    ``` 
   On local machine, use Laravel <a href="https://herd.laravel.com/">Laravel Herd</a> or Valet for development.
2. Create .env file:
   ```bash
   cp .env.example .env
   ```
3. Create schema in the database and fill the `.env` file with the database connection details.
4. Install composer dependencies:
   ```bash
   composer install
   ```
5. Run migrations:
   ```bash
    php artisan migrate
    ```

### Rest API

- **Get all notes**: `GET /api/notes?priority={priority}`
  - `priority` is optional and can be used to filter notes by priority (e.g., `high`, `medium`, `low`, `urgent`).
- Returns:
  ```json
    {
      "data": [
        {
          "id": 2,
          "title": "Simple note",
          "description": "Description",
          "priority": "low",
          "created_at": "2025-07-06T12:11:34.000000Z",
          "updated_at": "2025-07-06T12:11:34.000000Z"
        }, {
          ...        
        } 
      ]
    }
  ```
- **Get a note by ID**: `GET /api/notes/{id}`
  - Returns a single note by its ID.
  - Example response:
  ```json
    {
      "data": {
          "id": 1,
          "title": "Simple note",
          "description": "Description",
          "priority": "high",
          "created_at": "2025-07-06T12:11:31.000000Z",
          "updated_at": "2025-07-06T12:13:39.000000Z"
      }
    }
  ```
- **Create a new note**: `POST /api/notes`
  - Request body should contain `title`, `content`, and `priority`.
  - Example:
    ```json
    {
      "title": "Note Title", // Required, max 255 characters
      "content": "Note content goes here.", // Required, text content
      "priority": "high" // Required, one of: high, medium, low, urgent
    }
    ```
    - Returns the created note with a 201 status code.
    - Example response:
    ```json
    {
      "data": {
          "id": 1,
          "title": "Note Title",
          "description": "Note content goes here.",
          "priority": "high",
          "created_at": "2025-07-06T12:11:31.000000Z",
          "updated_at": "2025-07-06T12:13:39.000000Z"
      }
    }
    ```
- **Update a note**: `PUT /api/notes/{id}`
  - Request body should contain `title`, `content`, and `priority`.
  - Example:
    ```json
    {
      "title": "Updated Note Title", // Required, max 255 characters
      "content": "Updated note content.", // Required, text content
      "priority": "medium" // Required, one of: high, medium, low, urgent
    }
    ```
    - Returns the updated note with a 200 status code.
    - Example response:
    ```json
    {
      "data": {
          "id": 1,
          "title": "Updated Note Title",
          "description": "Updated note content.",
          "priority": "medium",
          "created_at": "2025-07-06T12:11:31.000000Z",
          "updated_at": "2025-07-06T12:13:39.000000Z"
      }
    }
    ```
# What were your key design choices and why?
- **Notes priority as Enum**: I used an enum for the priority field to ensure that only valid values are stored in the database. This helps maintain data integrity and makes it easier to handle priority-related logic in the application.
- **Validation rules**: I implemented validation rules for the request data to ensure that the required fields are present and that the data types are correct. This helps prevent errors and ensures that the API behaves as expected.
- **Laravel**: I chose Laravel for its robust features, ease of use. It provides a solid foundation for building RESTful APIs with built-in support for routing, validation, and database interactions.
- **Resource responses**: I used resource responses to format the API responses consistently. This makes it easier to handle the responses on the client side and ensures that the API adheres to a standard structure.
