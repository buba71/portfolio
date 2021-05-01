## My freelance web developper  portfolio/Blog

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/664bcdc0de4149d9aa9447bb09d7f6f1)](https://www.codacy.com/app/buba71/portfolio?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=buba71/portfolio&amp;utm_campaign=Badge_Grade)
[![Build Status](https://travis-ci.org/buba71/portfolio.svg?branch=master)](https://travis-ci.org/buba71/portfolio)

**Application built with symfony4 & Vue.js(vuex/vue-router)**

### Installation

````
composer install

php bin/console doctrine:database:create

php bin/console doctrine:schema:update --force
````

### Run tests

````
php bin/console doctrine:fixtures:load -n

php bin/phpunit

npm run test

````

Make sure PHP version is <= 7.3 .

**Version: 2.0.1**