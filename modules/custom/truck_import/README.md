# README #

This is a custom module for importing truck content (nodes) into Drupal 8. Visit
/admin/content/truck-import to use the import form.

### Requirements ###

* Content Type: Truck
* Modules: migrate, migrate_plus, migrate_source_csv
* An import CSV file. Download from truckpaper.com or see an example in sample-data
  directory of this module.

### Usage ###

* CSV import page is at /admin/content/truck-import
* To modify the redirect target page, run: `drush cset truck_import.settings redirect_path '/node'`
* To modify the redirect status code, run: `drush cset truck_import.settings redirect_status_code 301`

### Who do I talk to? ###

* Contact the original developer of this code - [Jitesh Doshi](mailto:jitesh@spinspire.com)
* See [this Google Doc](https://docs.google.com/document/d/1GBnfVFVQvmCyiXmdgJ9GQMXsOf0zh2pdTAcsPAor-N4/edit#) for develoepr notes.

### Troubleshooting ###
 * See this url for solution outlined below https://www.drupal.org/project/drupal/issues/2563901#comment-11888023

Problem #1: "Migration trucks is busy with another operation: Importing"
Problem #2: "Rollback failed. See logs."

The migrate process saves the status of each running migration in the database, 
any error in the code will abnormally terminate the process so the database won't be updated properly and will keep saying that "something is still running"

  A) If you are totally sure that nothing else is running, use migrate-status to see the status, for example this is a normal output of running migrate-status
     $ drush migrate-status
     # Pantheon terminus command
     $ terminus remote:drush tomnehl.test -- migrate-status
    
    * stat(): stat failed for /usr/share/nginx/html/clients/tnt/tntdev/sites/default/files/import/trucks.csv
    * Group: Trucks (trucks)  Status     Total  Imported  Unprocessed  Last imported       
    * trucks                  Importing  N/A    12        N/A          2017-12-05 12:45:36

  B) If you see status 'Importing', that is the one that is stuck.

  C) Once you have identified what is running run migrate-reset-status with the name of the task.
    $ drush migrate-reset-status <group name>
    * drush migrate-reset-status trucks
    # Pantheon terminus command
    $ terminus remote:drush tomnehl.test -- migrate-reset-status trucks

