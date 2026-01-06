## Project Setup Instructions

Follow these steps to get the project running locally.

### Prerequisites
Make sure you have the following installed:
- PHP >= 8.1
- Composer
- Laravel >= 12
- MySQL or PostgreSQL
- Node.js & npm (only if using frontend assets)
- Git

### Installation Steps
1. **Clone the repository**
```bash
git clone https://github.com/your-username/project-name.git
cd project-name
```

2. **Install PHP dependencies using Composer**
```bash
composer install
```

3. Install frontend dependencies
```bash
npm install
npm run dev
```

4. Copy the environment file
```bash
cp .env.example .env
```

5. Generate application key
```bash
php artisan key:generate
```

### Database Setup
1. Create schema "my_product_dashboard" or any schema of your liking.
2. Run the following script to migrate and see the product and categories.
```bash
php artisan migrate
php artisan db:seed CategorySeeder
php artisan db:seed ProductSeeder
```

### Start The Project
1. Start the local development server by running this command:
```bash
php artisan serve
```

### Login Process
1. After setting up the database, please register an account first then you may use that account to login.

## API Endpoint Documentations
1. After the project was started from the step above, you may redirect to the following url to view the API Endpoint Documentations.
```bash
http://127.0.0.1:8000/docs
```

2. The documentation was build using *knuckleswtf/scribe* Package
3. To rebuild the API documentation after changes, please do the following:
    ```bash
   -> Update SCRIBE_AUTH_KEY to the correct API Bearer Token from calling /api/login
   -> Run php artisan scribe:generate
    ```

## Assumptions and Design Choices

1. **Authentication**  
   - Users authenticate using API tokens via `/api/login`.
   - **Laravel Breeze** is used for simple authentication setup.  
   - Laravel Sanctum is used for token-based authentication.

2. **Action Classes**  
   - Core business logic is separated into **Action classes** (Action files) to keep controllers thin and maintainable.  
   - This makes the code easier to test and reuse.

3. **API Design**  
   - Followed RESTful conventions for all endpoints (`/api/products` for CRUD operations).  
   - Responses are standardized with `message` and `data` fields.

4. **Validation**  
   - Basic request validation implemented via Laravel Form Requests.  
   - Assumed simple rules, e.g., `name` required, `price` numeric.

5. **Database**  
   - MySQL is used for local development.  

6. **Error Handling**  
   - API returns JSON responses with HTTP status codes.  
   - Default Laravel error messages are used where applicable.

7. **API Documentation**  
   - Generated using Scribe.  
   - Local `/docs` URL assumed for development access.

8. **Frontend**  
   - Minimal Blade views are implemented for testing CRUD operations.  
   - Project is API-first; frontend is secondary.
