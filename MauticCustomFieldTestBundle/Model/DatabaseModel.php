<?php

namespace MauticPlugin\MauticCustomFieldTestBundle\Model;

use Mautic\CoreBundle\Model\FormModel;
use Mautic\LeadBundle\Entity\Lead;

class DatabaseModel extends FormModel
{
    /**
     * The constructor
     *
     * @var LeadModel database interface to the Lead entities
     *
     */
    public function __construct()
    {
    }

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

}
