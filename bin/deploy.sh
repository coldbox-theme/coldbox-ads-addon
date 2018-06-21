#!/usr/bin/env bash

set -e

if [[ "false" != "$TRAVIS_PULL_REQUEST" ]]; then
    echo "Not deploying pull requests."
    exit
fi

if [[ "master" != "$TRAVIS_BRANCH" ]]; then
    echo "Not on the 'master' branch."
    exit
fi

if [[ $TRAVIS_PHP_VERSION != "7.2" ]]; then
    echo "Not on the PHP 7.2"
    exit
fi


composer install --no-dev

mkdir dist
cp -r inc dist
cp -r languages dist
cp -r readme.txt dist
cp -r README.md dist
cp -r coldbox-ads-extension.php dist
cp -r vendor dist
#	cp -r vendor/inc2734 dist/vendor
#	cp -r vendor/erusev/parsedown dist/vendor
#	cp -r vendor/autoload.php dist/vendor
#	cp -r vendor/autoload_commands.php dist/vendor
#	cp -r vendor/autoload_framework.php dist/vendor

cd dist

git init
git add .
git commit -m "Update from travis $TRAVIS_COMMIT"
git push --quiet -f "https://${GH_TOKEN}@github.com/coldbox-theme/coldbox-ads-extension.git" master 2> /dev/null
git push --quiet -f "https://${GH_TOKEN}@github.com/mirucon/coldbox-ads-extension.git" dist 2> /dev/null

