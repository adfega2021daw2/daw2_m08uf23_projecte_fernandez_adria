<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;

	ini_set('display_errors', 0);
	#Dades de la nova entrada
	#
	if($_GET['usr'] && $_GET['ou'] && $_GET['numid'] && $_GET['gidnumber'] && $_GET['shell'] && $_GET['dirper'] && $_GET['cn'] && $_GET['sn'] && $_GET['givenName'] && $_GET['mb'] && $_GET['Postal'] && $_GET['tph'] && $_GET['title'] && $_GET['descp']) {
	$uid=$_GET['usr'];
	$unorg=$_GET['ou'];
	$num_id=$_GET['numid'];
	$grup=$_GET['gidnumber'];
	$dir_pers=$_GET['dirper'];
	$sh=$_GET['shell'];
	$cn=$_GET['cn'];
	$sn=$_GET['sn'];
	$nom=$_GET['givenName'];
	$mobil=$_GET['mb'];
	$adressa=$_GET['Postal'];
	$telefon=$_GET['tph'];
	$titol=$_GET['title'];
	$descripcio=$_GET['descp'];
	$objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
	#
	#Afegint la nova entrada
	$domini = 'dc=fjeclot,dc=net';
	$opcions = [
        'host' => 'zend-adfega.fjeclot.net',
		'username' => "cn=admin,$domini",
   		'password' => 'fjeclot',
   		'bindRequiresDn' => true,
		'accountDomainName' => 'fjeclot.net',
   		'baseDn' => 'dc=fjeclot,dc=net',
    ];	
	$ldap = new Ldap($opcions);
	$ldap->bind();
	$nova_entrada = [];
	Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
	Attribute::setAttribute($nova_entrada, 'uid', $uid);
	Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
	Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
	Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
	Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
	Attribute::setAttribute($nova_entrada, 'cn', $cn);
	Attribute::setAttribute($nova_entrada, 'sn', $sn);
	Attribute::setAttribute($nova_entrada, 'givenName', $nom);
	Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
	Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
	Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
	Attribute::setAttribute($nova_entrada, 'title', $titol);
	Attribute::setAttribute($nova_entrada, 'description', $descripcio);
	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
	if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
	} 
?>

<html>
	<head>
		<title>CREACIO D'USUARIS DE LA BASE DE DADES LDAP</title>
	</head>
	<body>
		<form action="http://zend-adfega.fjeclot.net/zendldapCU/creacio.php" method="GET">
			Unitat organitzativa: <input type="text" name="ou"><br>
			Usuari: <input type="text" name="usr"><br>
			uidNumber: <input type="text" name="numid"><br>
			gidNumber: <input type="text" name="gidnumber"><br>
			Directori personal: <input type="text" name="dirper"><br>
			Shell: <input type="text" name="shell"><br>
			cn: <input type="text" name="cn"><br>
			sn: <input type="text" name="sn"><br>
			givenName: <input type="text" name="givenName"><br>
			PostalAdress: <input type="text" name="Postal"><br>
			mobile: <input type="text" name="mb"><br>
			telephoneNumber: <input type="text" name="tph"><br>
			title: <input type="text" name="title"><br>
			description: <input type="text" name="descp"><br>

			<input type="submit"/>
			<input type="reset"/>
		</form>
		
		<br><br>Tornar al inici <button><a href="menu.php">INICI</a></button> <br><br>
		
	</body>
</html>