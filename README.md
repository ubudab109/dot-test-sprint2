# Summary
This branch is created for fulfilled sprint 2 test. This test is for get the data provinces and cities from Raja Ongkir API then save it to database. Also creating REST Api for get data provinces and cities from our database or RajaOngkir API directly with custom configurations. Also creating Authentication for accessing the API and Unit Test.

## Requirements
- PHP: ^8.1
- Guzzle: ^7.2
- Framework: Laravel 10
- Composer
- SQL Database: MySQL or PosgreeSQL (Prefer MySQL)

## Installation
- Create `.env` file in root directory project
- Copy paste value from `.env.example` to `.env`
- Change `DB_` prefix variable with Your own
- Create database in Your database host. Make sure name of database must similar with `DB_DATABASE` variable in `.env`
- Run `composer install` to install library that needed from this project
- Run `php artisan migrate` to migrate all needed table to Your database
- Run this command for inserting the datasource from RajaOngkir
- Then run this command for seed user data testing `php artisan db:seed`
<table width="100%">
  <tr>
    <th>Insert All Sources</th>
    <th>Insert Only Provinces</th>
    <th>Insert Only Cities</th>
  </tr>
  <tr>
    <td>
        <code>php artisan get:data-source</code>
    </td>
    <td>
        <code>php artisan get:data-source provinces</code>
    </td>
    <td>
        <code>php artisan get:data-source provinces</code> <br />
        <span>Please make sure You already insert provinces data first</span>
    </td>
  </tr>
</table>

## How To Running
- After installation is completed You can run this command `php artisan serve` to server this project. (Default will running on: http://localhost:8000)
- By default this project has a `local` data source config in `config/app.php`. If You want to use RajaOngkir API instead of getting data from local database, You go to this file `config/app.php` then look for `data_source` key then change value to `external`.
  There's 2 type data source that we used for this application which is `local` and `external`.
   - local: Mean that we use our database local when fetching data provinces and cities that we get from RajaOngkir
   - external: We directly call RajaOngkir API to get provinces and cities instead our local data
  
## REST Api
### There's 3 endpoint in this project which is
- `/api/login` with form body or json that passing the email and password
- `/api/search/provinces` with optional paramater `id` and required Authorization Header
- `/api/search/cities` with optional paramater `id` and required Authorization Header
### Example Request and Response
- Login API
  <table width="100%">
  <tr>
    <th colspan="3" align="center">Login API</th>
  </tr>
  <tr>
    <th colspan="3" align="center"><code>/api/login</code></th>
  </tr>
  <tr>
    <th>Parameter Body</th>
    <th>Required</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>
        <code>email</code>
    </td>
    <td>
        <code>True</code>
    </td>
    <td>
        <p>This is email for login. You can use this email for test.</p> <br />
        <b>user@mail.com</b>
    </td>
  </tr>
  <tr>
    <td>
        <code>password</code>
    </td>
    <td>
        <code>True</code>
    </td>
    <td>
        <p>This is password for login. You can use this password for test</p> <br />
        <b>123123123</b>
    </td>
  </tr>
</table>
- Provinces API
  <table width="100%">
  <tr>
    <th colspan="3" align="center">Province API</th>
  </tr>
  <tr>
    <th colspan="3" align="center"><code>/api/search/provinces?id=</code></th>
  </tr>
  <tr>
    <th colspan="3" align="center">Header Authorization: <code>Bearer: token that get from login</code></th>
  </tr>
  <tr>
    <th>Parameter</th>
    <th>Required</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>
        <code>id</code>
    </td>
    <td>
        <code>False</code>
    </td>
    <td>
        <p>ID from province data</p> <br />
    </td>
  </tr>
</table>
- Cities API
  <table width="100%">
  <tr>
    <th colspan="3" align="center">Cities API</th>
  </tr>
  <tr>
    <th colspan="3" align="center"><code>/api/search/cities?id=</code></th>
  </tr>
  <tr>
    <th colspan="3" align="center">Header Authorization: <code>Bearer: token that get from login</code></th>
  </tr>
  <tr>
    <th>Parameter</th>
    <th>Required</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>
        <code>id</code>
    </td>
    <td>
        <code>False</code>
    </td>
    <td>
        <p>ID from cities data</p> <br />
    </td>
  </tr>
</table>
 
