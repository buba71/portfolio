test: # run all the tests.
	php bin/console doctrine:fixtures:load -n
	php bin/phpunit
	npm run test





