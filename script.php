<?php
function unique_multidim_array($array, $key){
    $temp_array = array();
    $i = 0;
    $key_array = array();
    
    foreach($array as $val){
        if(!in_array($val[$key],$key_array)){
          $key_array[$i] = $val[$key];
          $temp_array[$i] = $val;
        } else {
					$temp_array[$i][0] = $temp_array[$i][0] . ' (duplicate)';
        }

        $i++;
    }

    return $temp_array;
}

// THIS IS CRF

//GET ALL ORDERS FROM CSV
$orders = array();
$file = fopen('../kkg/_orders.csv', 'r');

while (($line = fgetcsv($file)) !== FALSE) {
  //$line is an array of the csv elements
		$orders[] = array(
			$line[0], //'name'
		  $line[1], //'email'
		  $line[2], //'pass'
		  $line[3], //'comment'
		  unserialize($line[4]), //'selection'
		  $line[5], //'created'
		);

  
}
fclose($file);

$unique_orders = unique_multidim_array($orders, 0);


foreach ($unique_orders as $key => $order) {
	$fields = array(
	  'name' => $order[0],
	  'mail' => $order[1],
	  'pass' => $order[2],
	  'status' => 1,
	  'init' => 'email address',
	  'roles' => array(
	    DRUPAL_AUTHENTICATED_RID => 'authenticated user',
	  ),
	);

	$user = user_save('', $fields);

	$context_data = array(
		'uid' => $user->uid,
		'nid' => 69, 
		'comment' => $order[3],
		'selection' => $order[4],
		'amount' => 20.00, 	
		'created' => $order[5],
	);
	
	$entity = entity_create('node', array('type' => 'contribution'));
	$contribution = entity_metadata_wrapper('node', $entity);
	$contribution->author->set( $context_data['uid'] );
	$contribution->created->set( $context_data['created'] );
	$contribution->field_campaign->set( $context_data['nid'] );
	$contribution->field_comment->set( $context_data['comment'] );
	$contribution->field_fieldset->set( serialize(json_encode($context_data['selection'])) );
	$contribution->field_cost_per_field->set( number_format($context_data['amount'], 2) );

	// Create the contribution
	$contribution->save();

}