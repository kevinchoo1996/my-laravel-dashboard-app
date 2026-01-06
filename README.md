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
