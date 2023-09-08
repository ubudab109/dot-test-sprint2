# Summary
This branch is created for fulfilled sprint 1 test. This test is for get the data provinces and cities from Raja Ongkir API then save it to database. Also creating REST Api for get data provinces and cities from our database 

## Requirements
- PHP: ^8.1
- Guzzle: ^7.2
- Framework: ^10.10
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
  
## REST Api
### There's 2 endpoint in this project which is
- `/api/search/provinces` with optional paramater `id`
- `/api/search/cities` with optional paramater `id`
### Example Request and Response
- Provinces endpoint:
  ![image](https://github.com/ubudab109/dot-test-sprint-1/assets/62287144/d833a14b-8401-48c8-9e55-b32bd0aaf9d5)
- Cities endpoint:
  ![image](https://github.com/ubudab109/dot-test-sprint-1/assets/62287144/26eff701-2d5b-46d2-a815-3d3235fac2fb)
 
