
1) Place images that are to be converted into sprite, into directory: images/sprite-these

2) Name the sprite output file and css selectors by editing gulpfile.js: imgName ... cssName

3) Run *** gulp sprite ***.  This will execute gulpfile.js and:
  -create sprite scss and image files based on the files placed into directory: images/sprite-these
  -the IMAGE file will be saved to directory: /images
  -the SPRITE SCSS file will be saved to directory: /style/scss/init/sprites

4) Open sprite scss file (created in step 3) and edit the mixin's background-image URL to the
   correct URL path so when the SCSS file outputs the CSS file the CSS file references
   the appropriate URL path:

   @mixin sprite-image($sprite) {
     $sprite-image: nth($sprite, 9);
     background-image: url(../../images/#{$sprite-image});
   }

5) Add the new sprite scss file to styles.scss using @import like all other scss files

////////////////////////////////
6) Following the above steps makes sprite available as mixin in scss stylesheets.
////////////////////////////////

  // Example 
  6a. create a new SCSS file with styles for the sprite for use in the website's 
      HTML to display the sprite images:

      .sprite-battery-logo-1 { 
          @include sprite($ac-delco-battery-logo);
          display: inline-block; 
        }

  6b. Add the CSS selectors to the appropriate markup within the website to get
      the sprite's images to show on the website

7) The files that need to be uploaded to Production server are found in:
    /css
    /images/

