# Infrastrukt

Infrastrukt is WordPress theme built on [Foundation 5](http://foundation.zurb.com/), by [Zurb](http://zurb.com/).

Big props go to [drewsymo](http://github.com/drewsymo/) for his work on the [Foundation for WordPress](https://github.com/drewsymo/Foundation) theme. Infrastrukt was originally forked from the FWP repository.

Infrastrukt features a resource loader, which will allow you load your JS assets locally or via CDN.

## Note
- This README is only partially up-to-date.


## Preparing
Make sure you have the most recent NPM installed.
In the infrastrukt directory, run these commands:

- `npm install`
- `bower install`
- `bower prune`

## Grunt Tasks
- `grunt build` (builds CSS and JS files)
- Use `grunt tasks` to view available tasks.

## Adding Additional Dependencies
- JavaScript library: `bower install -S [package]`
- NodeJS package: `npm install --save-dev [package]`
