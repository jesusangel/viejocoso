<?php
/* CVS FILE: $Id: tractis.php,v 1.3 2010-08-28 12:11:08 jpozdom Exp $ */
/**
 * Tractis configuration file
 *
 * This file is used to define the API key needed to access to Tractis Identity
 * validation API. You will need a Tractis account (free). Go to  
 * https://www.tractis.com/identity and signup for API KEYs.
 *
 * PHP versions 4 and 5
 *
 * @filesource
 * @author			jpozdom
 * @copyright		Copyright 2009-2010 Jesús Ángel del Pozo
 * @package			catalogoPFC
 * @subpackage		catalogoPFC.app.config
 * @since			catalogoPFC v 1.1
 * @version			$Revision: 1.3 $
 * @modifiedby		$LastChangedBy: jpozdom $
 * @lastmodified	$Date: 2010-08-28 12:11:08 $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/*
 * API Key
 */
	//Configure::write('Tractis.apikey', '50a579ba89ba07b28309cbe3cd07a28c7b9d4cbc');	// http://pfc.abloque.com/
	Configure::write('Tractis.apikey', '8a307589685247da445cdc5a3b30c19f8ea1d751');	// http://jesusangel.homelinux.com/
	
/*
 * Auth URL
 */
	Configure::write('Tractis.verification_url', 'https://www.tractis.com/verifications');
/*
 * Data verification URL
 */
	Configure::write('Tractis.data_verification_url', 'https://www.tractis.com/data_verification');
/*
 * Notification callbak
 */
	Configure::write('Tractis.callback', 'http://jesusangel.homelinux.com/users/tractisok');
/*
 * Public verification flag
 */
	Configure::write('Tractis.publicverification', 'false');