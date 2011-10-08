<?php
/* CVS FILE: $Id: email.php,v 1.3 2010-08-28 12:11:08 jpozdom Exp $ */
/**
 * email component's setup.
 *
 * This file is used to configure the email component.
 *
 * PHP versions 4 and 5
 *
 * @filesource
 * @author		jpozdom
 * @copyright		Copyright 2009-2010 Jesús Ángel del Pozo
 * @package		catalogoPFC
 * @subpackage		catalogoPFC.app.config
 * @since		catalogoPFC v 1.1
 * @version		$Revision: 1.3 $
 * @modifiedby		$LastChangedBy: jpozdom $
 * @lastmodified	$Date: 2010-08-28 12:11:08 $
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/*
 * SMTP Server
 */
	Configure::write('Email.smtpHost', 'localhost');
/*
 * SMTP Type
 * 
 * Possible values: open, ssl, tls
 */
	Configure::write('Email.smtpType', null);
/*
 * SMTP Port
 * 
 * null to auto-detect, otherwise specify (eg. 25 for open, 465 for SSL, etc.) 
 */	
	Configure::write('Email.smtpPort', 25);
/*
 * SMTP Timeout
 * 
 * Seconds before timeout occurs
 */	
	Configure::write('Email.smtpTimeout', 10);
/*
 * Sendmail command
 * 
 * null to auto-detect, otherwise manually defined (e.g.: '/usr/sbin)
 */	
	Configure::write('Email.sendmailCmd', '/usr/sbin/sendmail');
/*
 * SMTP User name
 */	
	Configure::write('Email.smtpUsername', '');
/*
 * SMTP User password
 */
	Configure::write('Email.smtpPassword', '');
/*
 * Send email as (text, html or both)
 */
	Configure::write('Email.sendAs', 'both');	
/*
 * From email
 */
	Configure::write('Email.from', 'noreply@viejocoso.es');
/*
 * From name
 */
	Configure::write('Email.fromName', 'Viejocoso arquitectos');	
?>
