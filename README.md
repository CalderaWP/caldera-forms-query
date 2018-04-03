[![Build Status](https://travis-ci.org/calderawp/caldera-forms-query.svg?branch=master)](https://travis-ci.org/calderawp/caldera-forms-query)


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

