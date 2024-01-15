# Website Game
Prerequisites
To run this project, you'll need the following installed locally:

PHP >= 8.1, MySQL >= 8.0
Composer (>= v2.6)
NodeJS (>= v20)
Installation
Clone the repository:
```
git clone https://github.com/giauphan/youtube-video-audio.git

cd youtube-video-audio

```

Install dependencies:
```
composer install 
npm run install
```
Copy the .env.example file to .env:

```
DB_DATABASE=database_name 
DB_USERNAME=root
DB_PASSWORD=
```

After creating the database, run the migrations:

```
php artisan migrate --seed
```
Compile the frontend assets:
```
npm run dev

# or
npm run build
```
## Development Workflow

A typical workflow for developing new features looks like this:

1. Create a new branch for the feature:

   ```bash
   git checkout -b feature/feature-name
   ```

2. Make changes to the codebase.
3. Commit your changes:

   ```bash
   git add .
   git commit -m "Commit message"
   ```

   The commit message should follow the [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) specification.

