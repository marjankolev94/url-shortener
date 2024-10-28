# PrimeYear App

PrimeYear App is a PHP/Laravel & Vue.JS application designed to generate short hashed and unique version of given URL in a format: example.com/[hash], and check if the shortened Url is detected as safe from Google Safe Browsing.

## Features

- **Create URL**: Form for Creating an URL. The app will store the original URL and from it will generate unique hashed version using Str library.
- **Edit URL**: Form for Editing previously stored URL, the original one, from which will create new hashed and unique version.
- **Delete URL**: Easy-to-use button for deleting previously entered URL.

## Getting Started

### Prerequisites
- PHP and Laravel installed on your system
- A web server environment (such as XAMPP or Laravel Sail)
- Vue 3 and Inertia installed on your system

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/marjankolev94/primeyear-app.git

2. Navigate to the project directory:
   ```bash
   cd primeyear-app

3. Install dependencies:
   ```bash
   composer install

4. Set up environment variables:
- Copy .env.example to .env and configure your database and application settings as needed.

5. Run migrations:
   ```bash
   php artisan migrate

6. Serve the application
   ```bash
   php artisan serve

   The app will be available at http://localhost:8000.

### Usage
- Open the app in your browser.
- Enter a starting year in the input field.
- Click "Submit" to view the first 30 prime years counted backward from the entered year.
### Technologies Used
- PHP: Server-side scripting language.
- Laravel: PHP framework for building modern web applications.
- Vue.JS v3
- Inertia (Used for Laravel MIX)
- Google and Laravel Safe Browsing API 
### Contributing
Contributions are welcome! Please fork the repository and create a pull request with any improvements or bug fixes.

### License
This project is open-source and available under the MIT License.