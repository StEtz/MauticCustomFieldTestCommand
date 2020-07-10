Steps to repoduce:

### Prerequisites

Before running the test, ensure that a custom field: "mycustomfield" (type: text) has been added to the lead table (other attributes, like "Is Unique Identifier", can stay as they are).


### Install the plugin

1. Copy the folder into Mautic/plugins
2. Remove the cache in var/cache/dev
3. Rebuild the cache: `bin/console cache:warmup --env=dev`

### Check if it is installed

4. Execute: `bin/console --env=dev`

This should output the list of available commands including this one:

  * mautic:campaigns:trigger                Trigger timed events for published campaigns.
  * mautic:campaigns:validate               Validate if a contact has been inactive for a decision and execute events if so.
  * mautic:citrix:sync                      Synchronizes registrant information from Citrix products
  * mautic:contacts:deduplicate             Merge contacts based on same unique identifiers
  * <span style="color:blue"> **mautic:customfield:test                 Does a query with a filter for "customField = 5"**</style>
  * mautic:email:fetch                      [mautic:emails:fetch] Fetch and process monitored email.
  * mautic:emails:send                      Processes SwiftMail's mail queue
  * mautic:import                           Imports data to Mautic
  * mautic:install:data                     Installs Mautic with sample data
  * mautic:integration:fetchl

### Perform the test

5. 	Execute the command: `bin/console mautic:customfield:test --env=dev`



   This triggers the following query (DatabaseModel.php):
````
     public function performCustomFieldTest()
     {
   	    $key = "5";
	       $leadRepository = $this->em->getRepository(Lead::class); 

	       // Testing with a custom field => fails!
	       //$filter = [ 'mycustomfield' => $key ]; 
		
	       // Testing with a non-custom field => works!
	       $filter = [ 'email' => $key ]; 
	    
	    $result = $leadRepository ->findOneBy( $filter );
    }
````

This call runs a query against the Mautic DB trying to find a Lead with an email = "5". 
The result is empty, which is clear, however the point is that the query does not raise an error because the field "email" is a 
standard field of Mautic.

6. Disable the query for the email and enable the filter for a customfield:

````
     public function performCustomFieldTest()
     {
   	    $key = "5";
	       $leadRepository = $this->em->getRepository(Lead::class); 

	       // Testing with a custom field => fails!
	       $filter = [ 'mycustomfield' => $key ]; 
		
	       // Testing with a non-custom field => works!
	       // $filter = [ 'email' => $key ]; 
	    
	    $result = $leadRepository ->findOneBy( $filter );
    }
````

7. Run the command again: `bin/console mautic:customfield:test --env=dev`

This time there will be an exception raised:
````
ERROR     [console] Error thrown while running command "mautic:customfield:test --env=dev". Message: "Unrecognized field: mycustomfield" ["exception" => Doctrine\ORM\ORMException { …},"command" => "mautic:customfield:test --env=dev","message" => "Unrecognized field: mycustomfield"]
WARNING   [mautic] Command `mautic:customfield:test` exited with status code 1
````