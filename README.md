[![Build Status](https://travis-ci.org/calderawp/caldera-forms-query.svg?branch=master)](https://travis-ci.org/calderawp/caldera-forms-query)

This library provides for developer-friendly ways to query for or delete Caldera Forms entry data.

## Why?
* [To provide the types of queries we need for reporting and deleting data in order to add GDPR compliance to Caldera Forms](https://github.com/CalderaWP/Caldera-Forms/issues/2108)
* To provide the types of queries we need for improving Caldera Forms features such as entry viewer, entry export, entry editing and Connected Forms.

## Install
`composer require calderawp/caldera-forms-query`

## Requires
* WordPress - tested with 4.8, latest and trunk
* PHP 5.6+ - tested with PHP 7.1 and 7.2
* Caldera Forms 1.6.0+ - tested with Caldera Forms 1.6.1 beta 1

## Status
* Works
* Does not yet select/delete by date range
* **Prepared SQL needs to be sanitized better.**
## Usage

```php
/**
 * Examples of simple queries
 *
 * Using the class: \calderawp\CalderaFormsQuery\Features\FeatureContainer
 * Via the static accessor function: calderawp\CalderaFormsQueries\CalderaFormsQueries()
 */

/** First make the function usable without a full namespace */
use function calderawp\CalderaFormsQueries\CalderaFormsQueries;

/** Do Some Queries */
//Select all data by user ID
$entries = CalderaFormsQueries()->selectByUserId(42);

//Select all entries that have a field whose slug is "email" and the value of that field's value is "delete@please.eu"
$entries = CalderaFormsQueries()->selectByFieldValue( 'email', 'delete@please.eu' );

//Select all entries that do not have field whose slug is "size" and the value of that field's value is "big"
$entries = CalderaFormsQueries()->selectByFieldValue( 'size', 'big', false );

//Delete all data by Entry ID
CalderaFormsQueries()->deleteByEntryIds([1,1,2,3,5,8,42]);

//Delete all data by User ID
CalderaFormsQueries()->deleteByUserId(42);
```



## Development
### Install
Requires git and Composer

* `git clone git@github.com:calderawp/caldera-forms-query.git`
* `cd caldera-forms-query`
* `composer install`

### Local Development Environment
A  local development environment is included, and provided. It is used for integration tests. Requires Composer, Docker and Docker Compose.

* Install Local Environment And WordPress "Unit" Test Suite
- `composer wp-install`

You should know have WordPress at http://localhost:8888/

* (re)Start Server: Once server is installed, you can start it again
- `composer wp-start`

### Testing

#### Install
Follow the steps above to create local development environment, then you can use the commands listed in the next section.

#### Use
Run these commands from the plugin's root directory.

* Run All Tests and Code Sniffs and Fixes
    - `composer tests`
* Run Unit Tests
    - `composer unit-tests`
* Run WordPress Integration Tests
    - `composer wp-tests`
* Fix All Code Formatting
    - `composer formatting`

## Stuff.
Copyright 2018 CalderaWP LLC. License: GPL v2 or later.
