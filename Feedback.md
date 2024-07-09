# SaaS - Front-End Development Portfolio Part 2 - Feedback

## Contents

This file contains:

- [Before you Begin](#Before-you-begin)
- [Jobs and Listings](#Jobs-and-Listings)
- [Check and Correct](#Check-and-correct)
- [Minor Issues to be Resolved](#Minor-issues)
- [Additional Feature to Add](#New-features)
- [Other General Information](#General-information)

## Before you begin

Make sure you open the CLI and go into the folder with this project and execute:

1) `composer global update`
2) `composer update` 
3) `npm update`

Next...

In some places *TODO* items may be added to your code to highlight an issue to resolve. The
updated code, plus **Feedback.md** file will be pushed to your repository, and you will need
to perform the following tasks before updating your code:

In PhpStorm you use Menu -> View -> tools -> TODO

![img.png](img.png)

- Commit any local changes, and pull updated files from the remote.

```shell
git add .
git commit -m "A SUITABLE COMMIT MESSAGE"

git pull 
```

You may need to perform merge tasks when doing this. Make sure you check each altered file and
include the changes required.

[Back to Top](#Contents)

## Migrations in General

- The `$table->timestamps();` creates **BOTH** `created_at` and `updated_at` fields. No need to replace this with
  anything else.
- Salary should be an `string`, not an integer or decimal for this version. Presume in Australian `$`. New version 
  will have `salary_min` and `salary_max` which will be integers. If only one, then this is in `salary_min`.
- Phone numbers are not 45+ characters long. `+CCC-XXX-NNNN-NNNN` is about as long as it gets (without an 
  extension, which would be ` xtn NNNN` ).
  - Is there a package to help with the formatting of phone numbers?

## Jobs and Listings

One item that **may** have caused a little confusion is that *Listings* and *Jobs* are the same...
in fact, it may be easier to remember that this application deals with *Job Listings*!


## Check And Correct

The following are common errors that are occurring with the portfolio. Whilst these issues are
not critical, they should be carefully looked into and corrected before next semester.

> **If you notice your code has the issue, correct it!**

### Data Structures

- At the end of the assessment there were table structures.
- **ENSURE** that the fields for the Listing model are correct,
   and in your migrations, seeders, views, and methods.
- It is suggested that the User model has a "company" field (see later)

### Navigation and Links

- Check ALL LINKS in the pages to make sure they are correct
- Make sure links call correct `route('NAME')`
- Remember that links may be `<x-nav-link>`, `<x-responsive-nav-link>` or HTML's `<a>` element.

> Common error is forgetting the nav links, and so forth.
> Example 1:
> ```html
> <x-nav-link :href="{{ route('welcome') }}" :active="request()->routeIs('welcome')" class="group">
>   {{ __('Pricing') }}
> </x-nav-link>
> ```
> Example 2:
> ```html
> <a href="{{ route('welcome') }}">Listings</a>
> ```
> Example 3:
> ```html
> <a href="listings.html" class="block text-xl text-center ">
>     <i class="fa fa-arrow-alt-circle-right"></i>
>     Show All Jobs
> </a>
> ```

### User Registration

Ensure user is allocated the correct default role when they register (eg client)
[/app/Http/Controllers/Auth/RegisteredUserController.php](app/Http/Controllers/Auth/RegisteredUserController.php)


### Users

- Create an `update_user_add_company` migration that adds the user's company name. This company name will be associated
  with every listing created by the user. Allow for an empty company if Staff or Admin ONLY.
- User Seeding must be done in a `UserSeeder` file. Create this using the command below, and move ALL User seed data
  into it.

```shell
php artisan make:seeder UserSeeder
```

- Ensure that the Database seeder contains this only in the `call` method (unless additional tables have been created), 
  and note the order is important:

```php
$this->call([
    RolesAndPermissionsSeeder::class,
    UserSeeder::class,
    ListingSeeder::class,
]);
```

- Make sure that the users has a last login field (`logged_in_at`), and it is updated when the user logs in (this
  includes when they log-in by default as they verify their account).

- Make sure that the User recycle bin / trash works for the Admin as well as Staff.


### Roles and Permissions
- Make sure that the admin user CANNOT change/remove their own role.


### Listings

- Display Listings when managed as a TABLE for clients, staff and admin (as per User management)
- Listings for editing, etc. could be embedded in the DASHBOARD page leaving the Listings for all users to browse 
  jobs in a card-based view, no mater if they are unregistered (guest) or a client, staff or admin.
- Make sure that the user may edit/delete ONLY THEIR listings
- Make sure a logged in client is able to see THEIR listings ONLY. 
- Staff/Admin see all listings.
- Check and update visibility of edit and delete links in the show view are only shown for Admin/Staff and the user
  who OWNS the listing.
- Check and fix the Listings links at the bottom of the [Welcome/Home page](resources/views/pages/welcome.blade.php).
- Guests must be able to view all CURRENT (see the start/end listing below) job listings (`listings.guest` view).
- Guest Job Listings page must be a card view (See [Welcome/Home page](resources/views/pages/welcome.blade.php) but
  without the banner image).
- The [ListingsController](app/Http/Controllers/ListingController.php) must have a guest method (see below).
- Job listings should be in **Latest First** by default (most recently added first).

```php
    public function guest():View
    {
        $listings = Listing::latest()->paginate(10);
        return view('listings.guest', compact(['listings']));

    }
```

- The Listings model requires a `listing_start_at` and a `listing_end_at` field. Add using a NEW update migration. `php
  artisan make:migration update_listings_add_start_and_end`
- Create a `guestShow` method that is accessible by anyone, and linked from the `listings.guest`
  view for each job. This will render a new `listings.guest-show` view that displays the details for the job listing
  without the company or contact details.
- Listings controller should only allow the NON-GUEST accessible methods to be accessed by Admin, Staff and Clients.
- Listings index page and controller method should only provide the CURRENT USER's listings
- Staff and admin to view ALL listings from ALL clients

### Home/Welcome Page

- Show only SIX listings
- Make the listings RANDOM
- Make the listings be CURRENT only (today's date is between `listing_start_at` and `listing_end_at`)
- Links on each listing to use the `listings.guest-show` for detail view

Limiting the number of results is via the `limit(6)` method.


### ALL Controllers

- Make sure that the methods return the correct type. For example:

```php
  public function contactUs():View
```

When searching there are tricks to searching MORE THAN ONE field for data
```php
$dummyData = Listing::whereAny(['title','tags'],'like',"%$keywords%")
                       ->where('location','like',"%$location%")
                       ->paginate(10);
```

equivalent to the SQL (without pagination):
```sql
select * from listings 
         where (title like '%keywords%' or tags like '%keywords%') 
           and location like '%location%'
```

- This would (filter) match any of the title and tags fields, AND match the location field.
- Also, if either the keywords or the location were empty, then it will match ALL of those items, and use the other to filter down.
- Finally, if both are blank, no filtering happens.

### Code Comments

- Do not comment every line of code, this is a classic new progrmamer error.
- Code should be readable without lots of comments
```php
    // Show all users in the trash
    Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');

    // Empty user trash
    Route::get('users/trash/empty', [UserController::class, 'empty'])->name('users.empty');    
```

- for example, the above lines do NOT need any comments as the code is very self-explanatory. In the worst case, add 
  a single comment before these to cover them all
```php
    // User Trash routes: Show the trash, empty the trash...
    Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');
    Route::get('users/trash/empty', [UserController::class, 'empty'])->name('users.empty');    
```


### ALL New and Edited Files

- Make sure you have added references to any web pages, books, AI used to help resolve any issue above, or when
  developing the original version. 
- **This will be a REQUIRED item for SaaS BED.**
- We will use MyBib for the creation of APA6 or APA7 references.
- Insert references into the Code at the point of use:

Example:

```php
class RoleAndPermissionsController extends Controller
{
    /**
     * Using the Spatie Permission package.
     * Spatie. (n.d.). Introduction | laravel-permission. Spatie.be. https://spatie.be/docs/laravel-permission/v6/introduction
     */
```


[Back to Top](#Contents)

## Minor Issues

These are issues that may be relevant to you only.

[Back to Top](#Contents)

## General Information

Useful study on a variety of topics we touched on:

- Allen, A. (2024, June 3). The ultimate guide to Laravel Validation - Laravel News. Laravel News. https://laravel-news.com/laravel-validation
- Laracasts. (2024). 30 Days to Learn laravel. Laracasts. https://laracasts.com/series/30-days-to-learn-laravel-11
- Funda Coder. (2024, February 10). Complete Spatie user Roles & Permission management tutorial from scratch step by step in Laravel 10. YouTube. https://www.youtube.com/watch?v=GOeB0JFwoJQ&ab_channel=FundaCoder

### Seeding

- Make sure that the users have 1 Admin user and 1 Staff user for testing purposes.


[Back to Top](#Contents)

## Optional Practice Features

In preparation for next semester we are providing you with some revision tasks for you to implement. 


### Tagging of listings

To assist you we are recommending that you investigate the spatie/laravel-tags package and use this for your solution.

The following references will assist you in completing this new feature:

- Introduction | laravel-tags. (2018). Spatie.be. https://spatie.be/docs/laravel-tags/v4/introduction
- Allen, A. (2024, June 3). The ultimate guide to Laravel Validation - Laravel News. Laravel
  News. https://laravel-news.com/laravel-validation
- (2024). Laracasts. https://laracasts.com/series/30-days-to-learn-laravel-11
- Laravel Daily (2022). How to Extend Laravel Package: Spatie Tags Model Example [YouTube Video]. In YouTube.
  https://www.youtube.com/watch?v=94WSsujEyfc
- Aditya Chamim Pratama. (2024). Adityacprtm.
  Adityacprtm.dev. https://adityacprtm.dev/blog/how-to-create-a-laravel-tagging-system

### Clients from Same Company


What if two clients are from the same company?

Two Solutions (initial):

- Show the current client's job listings in a table at the top of the page. Add the company listings in a separate
  table below the first. Sort both tables in latest first order. Suggest showing 5 listings per page on top table,
  and 10 per page on second.

- Show all listings in one table, with the current user's listings first.

[Back to Top](#Contents)


