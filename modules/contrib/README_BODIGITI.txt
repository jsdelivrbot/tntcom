
Contrib Modules


Redirect Module: Update from 8.x-1.0-alpha2 to 8.x-1.0-beta1
Problems updating because of NGXIN setting in the /sites-available file for tntdev
https://www.drupal.org/node/2910328
  Changed location / to following....

  location / {    
    try_files $uri /index.php?$query_string;
  }

location / {                                                                   
 31     # First attempt to serve request as file, then                               
 32     # as directory, then fall back to displaying a 404.                          
 33   # try_files $uri $uri/ =404;                                                   
 34   # neh commented oct 30 2017: try_files $uri /index.php?q=$uri&$args;           
 35   try_files $uri /index.php;                                                     
 36                                                                                  
 37     # Uncomment to enable naxsi on this location                                 
 38     # include /etc/nginx/naxsi.rules                                             
 39   }             




// PREVIOUS NOTES PRIOR TO TOM NEHL Initial Module Updates 

fontyourface
  8/4 update:
    had gone back and forth with a couple different versions of Alpha and/or Dev.
    finally figured out the newest one to update to and that's what's presently installed:
    version: '8.x-3.0-alpha3'

