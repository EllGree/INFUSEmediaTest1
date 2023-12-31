# INFUSEmediaTest1

INFUSEmedia PHP skills test job

The job has been completed and has been deployed:
http://ellgree.com/INFUSEmediaTest1/index.html

# Please find below a task for PHP proficiency evaluation:

The project should consist of at least the following 3 files:
- index1.html
- index2.html
- banner.php

and 1 MySQL table with the next mandatory columns:
- ip_address
- user_agent
- view_date
- page_url
- views_count

index1.html and index2.html should have an image tag that inserts some image into the page using banner.php file: 
`<img src="banner.php">`
Every time the image is loaded, the page visitor's info should be recorded in the MySQL table:

- IP address of the visitor (ip_address column)
- Their user-agent (user_agent column)
- The date and time the image was shown for this visitor (view_date column)
- URL of the page where the image was loaded (page_url column)
- Number of image loads for the same visitor (views_count column) - conditions are described below.

If a user with the same IP address, user-agent, and page URL hits the page again, 
the view_date column has to be updated with the current date and time, 
as well as views_count column has to be increased by 1.

# The task should be completed in PHP, without involving any frameworks. The result you need to deliver:
- 4 files: 2 HTML files, 1 PHP file, and a dump file (.sql) of the table (CREATE+INSERT)
- (optional) Additional PHP for classes, methods, or any other staff, if necessary
- (optional) Image files

Please provide a link to GitHub or BitBucket with the uploaded code and let us know how long it took you to complete this task.

