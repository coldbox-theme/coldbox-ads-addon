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

mkdir dist
cp -r inc dist
cp -r languages dist
cp -r readme.txt dist
cp -r coldbox-ads-addon.php dist
cd dist

git init
git checkout -b dist --force
git add .
git commit -m "Update from travis $TRAVIS_COMMIT"
git push --quiet -f "https://${GH_TOKEN}@github.com/${TRAVIS_REPO_SLUG}.git" dist 2> /dev/null
