<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);
	#
	# Atribut a modificar --> Número d'idenficador d'usuari
	#
	if($_GET['ou'] && $_GET['usr']){	    
	    
	    $atribut=$_GET['MyRadio']; # El número identificador d'usuar té el nom d'atribut uidNumber
    	$nou_contingut=$_GET['valor'];
    	#
    	# Entrada a modificar
    	#
    	$uid = $_GET['usr'];
    	$unorg = $_GET['ou'];
    	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    	#
    	#Opcions de la connexió al servidor i base de dades LDAP
    	$opcions = [
    		'host' => 'zend-adfega.fjeclot.net',
    		'username' => 'cn=admin,dc=fjeclot,dc=net',
    		'password' => 'fjeclot',
    		'bindRequiresDn' => true,
    		'accountDomainName' => 'fjeclot.net',
    		'baseDn' => 'dc=fjeclot,dc=net',		
    	];
    	#
    	# Modificant l'entrada
    	#
    	$ldap = new Ldap($opcions);
    	$ldap->bind();
    	$entrada = $ldap->getEntry($dn);
    	if ($entrada){
    		Attribute::setAttribute($entrada,$atribut,$nou_contingut);
    		$ldap->update($dn, $entrada);
    		echo "Atribut modificat"; 
    	}
	}else echo "<b>Aquest usuari no existeix</b><br><br>";
	
?>

<html>
	<head>
		<title>MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP</title>
	</head>
	<body>
		<form action="http://zend-adfega.fjeclot.net/zendldapCU/modifica.php" method="GET">
			Unitat organitzativa: <input type="text" name="ou"><br>
			Usuari: <input type="text" name="usr"><br><br><br>
			
			Atribut a modificar
			<input type="radio" name="MyRadio" value="uidNumber">uidNumber<br>
			<input type="radio" name="MyRadio" value="gidNumber">gidNumber<br>
			<input type="radio" name="MyRadio" value="homeDirectory">Directori personal<br>
			<input type="radio" name="MyRadio" value="loginShell">Shell<br>
			<input type="radio" name="MyRadio" value="cn">cn<br>
			<input type="radio" name="MyRadio" value="sn">sn<br>
			<input type="radio" name="MyRadio" value="givenName">givenName<br>
			<input type="radio" name="MyRadio" value="postalAddress">PostalAdress<br>
			<input type="radio" name="MyRadio" value="mobile">Movil<br>
			<input type="radio" name="MyRadio" value="telephoneNumber">Telefon<br>
			<input type="radio" name="MyRadio" value="title">Title<br>
			<input type="radio" name="MyRadio" value="description">Descripcio<br><br>
			
			Valor: <input type="text" name="valor"><br>
			
			
			<input type="submit"/>
		</form>
		
				<br><br>Tornar al inici <button><a href="menu.php">INICI</a></button> <br><br>
		
	</body>
</html>

