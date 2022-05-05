<?php   

$mem  = new Memcached();
      // List memcache servers
$mem->addServer('host.docker.internal',11211);

if($mem->getVersion() === FALSE){
	
}else{

}

function doQuery($mem, $pdo, $sql){
	$key = base64_encode($sql);
	$ret = $mem->get($key);
	if($ret !== FALSE){
		return $ret;
	}else{ // not in memcache!!!!!
		if($pdo === FALSE){
			
		}
		$statement = $pdo->query($sql);
		$ret = $statement->fetchAll();
		$mem->set($key, $ret, 5);
		echo $mem->getResultMessage();
		return $ret;
	}
	
}

?>