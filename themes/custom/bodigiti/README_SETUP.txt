/**
 * DRUSH IMPORTANT SIDE-NOTE
 */
Afer intalling "node_modules" the related .INFO files can break Drush capability
Fixed by running from Theme Directory:
  $ sudo find ./node_modules -name "*.info" -type f -delete
  See https://groups.drupal.org/node/156499#comment-1117223
  And https://www.drupal.org/node/2329453

/**
 * SASS + GULP + Bower + Susy + Breakpoints 
 */

Prerequisites
Node JS = http://nodejs.org
Bower = http://bower.io
Gulp JS = http://gulpjs.com

Install - Node JS + NPM (Node package manager) 
  Multiple ways of intalling found at:
  https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-an-ubuntu-14-04-server 

Install - Bower 
  http://bower.io/ 

Install - Gulp
  https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md

/**
 * Create package.json 
 */
Use the npm init command to create the package.json
  $ npm init 

/**
 * Create bower.json
 */
Use the bower init command to create the bower.json 
  $ bower init 

/** 
 * Gulp Packages Installation 
 */
  $ npm install gulp --save-dev
  $ npm install gulp-sass --save-dev 
  $ npm install gulp-sourcemaps --save-dev
  $ npm install gulp-autoprefixer --save-dev
  $ npm install gulp-watch --save-dev
  $ npm install del --save-dev
  $ npm install es6-promise --save-dev
  $ npm install gulp.spritesmith --save-dev
  Or all at once
  npm install gulp gulp-sass gulp-sourcemaps gulp-autoprefixer gulp-watch del --save-dev 

/** 
 * Bower: Use to install Susy and Breakpoint   
 * We now have the necessary packages to compile Sass into CSS with LibSass. 
 * Let’s move on to installing our front-end dependencies with Bower.
 */

    // Susy - Install Bower Package  
    // saves susy into dir: bower_components/susy  
    $ bower install susy --save
  
    // We have to import Susy into the stylesheets to use it.
    // styles.scss
    @import "../bower_components/susy/sass/susy";

    // Breakpoint - Install Bower Package 
    // saves breakpoint into dir: bower_components/breakpoint-sass 
    $ bower install breakpoint-sass --save

    // We have to import Breakpoint into the stylesheets to use it.
    // styles.scss
    $ @import "../bower_components/breakpoint-sass/stylesheets/breakpoint";

/**
 * Gulpfile setup  
 */
  gulpfile.js

 
