# afAutomailerPlugin Documentation

## Description

Plugin manages emails in application.


## Branches

Plugin works with symfony 1.2 and 1.4.
So there are 2 branches: sf1.2 and sf1.4.

	branches/
		sf1.2/
		sf1.4/


## Installation

You can add plugin as svn:external. 

	https://appflower.svn.beanstalkapp.com/appflowerplugins/afAutomailerPlugin/branches/_BRANCH_NAME_/


## Database

You need to add new table (automailer) into database.
Use symfony: build-sql and insert-sql. Or do it manually.
After build-sql you will have table definition in /data/sql/plugins.afAutomailerPlugin.lib.model.schema.sql.


## Configuration

You must define your application domain in application configuration file 
apps/_APP_NAME_/config/app.yml

	all:
	  domain: my_app_domain

You can optionally use 'delete_on_success' option.
When it is set on true - emails will be automatically deleted from database after successfully sent.
When it is set on false - emails will be stored in database. Only is_sent flag will be changed on '1'.
Default value is true.

	all:
	  afAutomailerPlugin:
	    delete_on_success: false


### For symfony 1.4

You need to define your delivery strategy in apps/_APP_NAME_/config/factories.yml

	mailer:
	  param:
	    delivery_strategy: realtime


## Required parameters:

There are some required parameters for sending emails:

 * email - user email, whom you send a message
 * from - from who (name) is email sent (email is created as 'no-reply@my_app_domain')
 * subject - email subject

You can also give other parameters to email template.

## Email templates

Emails body are defined as partials. Optionally you can also create template for altBody
(in file name you need to add 'altbody'). 
Partials are stored in modules in templates folder.

## Example

Use method saveMail to save emails in database.
For example type in some action:

	<?php
		$moduleName = 'mails';
		$template = 'new_user';
		$parameters = array(
		    'email'       => 'new_user@example_domain.com',
		    'subject'     => 'new user added',
		    'from'        => 'administrator',
		    'other_parameter' => 'lorem ipsum'
		);
	
		afAutomailer::saveMail($moduleName, $template, $parameters);
	?>

Templates which will be used are:

	apps/
	  frontend/
	    modules/
	      mails/
	        templates/
	           _new_user.php
	           _new_user.altbody.php


## Sending emails

Emails are sent with symfony task:

	./symfony afAutomailerPlugin:send


