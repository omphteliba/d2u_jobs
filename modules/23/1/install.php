<?php
// insert module specific email templates
$sql = rex_sql::factory();
$sql->setQuery("SELECT * FROM ". \rex::getTablePrefix() ."yform_email_template WHERE name LIKE 'd2u_jobs_%'");
if($sql->getRows() == 0) {
	$sql->setQuery("INSERT INTO `". \rex::getTablePrefix() ."yform_email_template` (`name`, `mail_from`, `mail_from_name`, `mail_reply_to`, `mail_reply_to_name`, `subject`, `body`, `body_html`, `attachments`, `updatedate`) VALUES
		('d2u_jobs_thanks_application', '". rex_config::get('phpmailer', 'from')."', '". rex::getServerName() ."', 'REX_YFORM_DATA[field=\"email\"]', 'REX_YFORM_DATA[field=\"firstname\"] REX_YFORM_DATA[field=\"name\"]', '<?= \\\\Sprog\\\\Wildcard::get(\'danke_anfrage_betreff\'); ?>', '', '<html>\r\n    <body>\r\n        <p><?= \\\\Sprog\\\\Wildcard::get(\'d2u_jobs_module_form_thanks\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?></p>\r\n        <p><b><?= \\\\Sprog\\\\Wildcard::get(\'d2u_jobs_module_form_your_data\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?></b></p>\r\n        <p><b>REX_YFORM_DATA[field=\"job_name\"]</b></p>\r\n        <p>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_name\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"name\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_street\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"address\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_zip\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()) .\" \". \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_city\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"zip\"] REX_YFORM_DATA[field=\"city\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_phone\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"phone\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_email\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"email\"]<br>\r\n            <br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_message\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"message\"]</p>\r\n    </body>\r\n</html>', '', CURRENT_TIMESTAMP),
		('d2u_jobs_application', '". rex_config::get('phpmailer', 'from')."', '". rex::getServerName() ."', 'REX_YFORM_DATA[field=\"email\"]', 'REX_YFORM_DATA[field=\"vorname\"] REX_YFORM_DATA[field=\"name\"]', 'Bewerbung als REX_YFORM_DATA[field=\"job_name\"]', '', '<html>\r\n    <body>\r\n        <p><b><?= \\\\Sprog\\\\Wildcard::get(\'d2u_jobs_module_form_your_data\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?></b></p>\r\n        <p>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_name\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"name\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_street\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"address\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_zip\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()) .\" \". \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_city\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"zip\"] REX_YFORM_DATA[field=\"city\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_phone\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"phone\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_email\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"email\"]<br>\r\n            <br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_message\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"message\"]</p>\r\n        <br>\r\n    </body>\r\n</html>', '', CURRENT_TIMESTAMP);");
}
else {
	$sql->setQuery("UPDATE `". \rex::getTablePrefix() ."yform_email_template` SET `body_html` = '<html>\r\n    <body>\r\n        <p><?= \\\\Sprog\\\\Wildcard::get(\'d2u_jobs_module_form_thanks\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?></p>\r\n        <p><b><?= \\\\Sprog\\\\Wildcard::get(\'d2u_jobs_module_form_your_data\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?></b></p>\r\n        <p><b>REX_YFORM_DATA[field=\"job_name\"]</b></p>\r\n        <p>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_name\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"name\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_street\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"address\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_zip\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()) .\" \". \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_city\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"zip\"] REX_YFORM_DATA[field=\"city\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_phone\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"phone\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_email\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"email\"]<br>\r\n            <br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_message\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"message\"]</p>\r\n    </body>\r\n</html>' WHERE `name` = 'd2u_jobs_thanks_application'");
	$sql->setQuery("UPDATE `". \rex::getTablePrefix() ."yform_email_template` SET `body_html` = '<html>\r\n    <body>\r\n        <p><b><?= \\\\Sprog\\\\Wildcard::get(\'d2u_jobs_module_form_your_data\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?></b></p>\r\n        <p>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_name\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"name\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_street\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"address\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_zip\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()) .\" \". \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_city\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"zip\"] REX_YFORM_DATA[field=\"city\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_phone\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"phone\"]<br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_email\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"email\"]<br>\r\n            <br>\r\n            <?= \\\\Sprog\\\\Wildcard::get(\'d2u_helper_module_form_message\', \'REX_YFORM_DATA[field=\"job_clang_id\"]\' ?: rex_clang::getCurrentId()); ?>: REX_YFORM_DATA[field=\"message\"]</p>\r\n        <br>\r\n    </body>\r\n</html>' WHERE `name` = 'd2u_jobs_thanks_application'");
}