<!doctype html>
<?php
$active = htmlspecialchars($_GET["page"]);
?>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>Insan3 sepatool</title>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li class=<?php if ( $active == 'home' ) { ?> 'active' <?php } else { } ?>><a href='index.php?page=home'><span>Home</span></a>
   <li class=<?php if ( $active == 'overzicht' ) { ?> 'active has-sub' <?php } else { ?> 'has-sub' <?php } ?> ><a href='#'><span>Overzichten</span></a>
      <ul>
         <li><a href='index.php?page=overzicht&view=creditors'><span>Crediteuren</span></a>
         </li>
         <li><a href='index.php?page=overzicht&view=debtors'><span>Debiteuren</span></a>
         </li>
	 <li><a href='index.php?page=overzicht&view=membertype'><span>Lidmaatschappen</span></a>
         </li>
      </ul>
   </li>
   <li class=<?php if ( $active == 'invoeren' ) { ?> 'active has-sub' <?php } else { ?> 'has-sub' <?php } ?>><a href='#'><span>Toevoegen</span></a>
      <ul>
         <li><a href='index.php?page=invoeren&invoeren=hond'><span>Honden</span></a>
         </li>
         <li><a href='index.php?page=invoeren&invoeren=lid'><span>Leden</span></a>
         </li>
		 <li><a href='index.php?page=invoeren&invoeren=instructeur'><span>Instructeurs</span></a>
         </li>
         <li><a href='index.php?page=invoeren&invoeren=cursus'><span>Cursussen</span></a>
         </li>
      </ul>
   </li>
   <li class=<?php if ( $active == 'beheer' OR $active == 'updateform') { ?> 'active has-sub' <?php } else { ?> 'has-sub' <?php } ?>><a href='#'><span>Beheer</span></a>
      <ul>
         <li><a href='index.php?page=updateform&update=user'><span>Wachtwoord</span></a>
         </li>
         <li><a href='register.php?page=beheer'><span>Gebruikers</span></a>
         </li>
		 <li><a href='index.php?logout'><span>Uitloggen</span></a>
         </li>
      </ul>
   </li>
</ul>
</div>

</body>
<html>
