<?php
/**
 * Offers helper functions for language issues
 */
class d2u_jobs_lang_helper extends \D2U_Helper\ALangHelper {
	/**
	 * @var string[] Array with chinese replacements. Key is the wildcard,
	 * value the replacement. 
	 */
	protected $replacements_chinese = [
		'd2u_jobs_announcement' => '招标',
		'd2u_jobs_application_link' => '在线申请表',
		'd2u_jobs_footer' => '请将您的完整求职资料与可行的入职日期和薪水要求一并发送至电子邮箱：',
		'd2u_jobs_module_attachment' => '申请文件：如履历、证书',
		'd2u_jobs_module_form_thanks' => '感谢您的申请。 我们的人力资源部门会尽快与您联系。',
		'd2u_jobs_module_form_your_data' => '申请资料概要',
		'd2u_jobs_phone' => '电话',
		'd2u_jobs_questions' => '如果您对该职位有任何疑问，请联系我们：',
		'd2u_jobs_reference_number' => '参考号',
		'd2u_jobs_region' => '市',
		'd2u_jobs_vacancies' => '招聘岗位',
	];
	
	/**
	 * @var string[] Array with netherlands replacements. Key is the wildcard,
	 * value the replacement. 
	 */
	protected $replacements_dutch = [
		'd2u_jobs_announcement' => 'Naar openstaande vacatures',
		'd2u_jobs_application_link' => 'Solliciteer direct',
		'd2u_jobs_footer' => 'U kunt uw motivatiebrief met CV onder vermelding van vroegst mogelijke opzegtermijn en salaris wens per E-Mail, met in het onderwerp „Sollicitatie <Vacature nummer>” sturen naar:',
		'd2u_jobs_module_attachment' => 'Sollicitatiedocumenten: bijv. curriculum vitae, certificaten',
		'd2u_jobs_module_form_thanks' => 'Bedankt voor uw sollicitatie, we nemen op korte termijn contact met u op.',
		'd2u_jobs_module_form_your_data' => 'Uw gegevens',
		'd2u_jobs_phone' => 'Telefoon:',
		'd2u_jobs_questions' => 'Indien u naar aanleiding van deze vacature nog vragen heeft kunt u contact opnemen met:',
		'd2u_jobs_reference_number' => 'Referentie',
		'd2u_jobs_region' => 'Stad',
		'd2u_jobs_vacancies' => "Vacatures",
	];

	/**
	 * @var string[] Array with english replacements. Key is the wildcard,
	 * value the replacement. 
	 */
	protected $replacements_english = [
		'd2u_jobs_announcement' => 'Complete announcement',
		'd2u_jobs_application_link' => 'Online application form',
		'd2u_jobs_footer' => 'Please send us your complete application documents with the possible starting date and your salary expectations via email to:',
		'd2u_jobs_module_attachment' => 'Application documents: e.g. CV, certificates',
		'd2u_jobs_module_form_thanks' => 'Merci pour votre candidature. Notre service RH vous contactera dans les plus brefs délais.',
		'd2u_jobs_module_form_your_data' => 'pplication data summary',
		'd2u_jobs_phone' => 'Phone',
		'd2u_jobs_questions' => 'If you have questions regarding this position, please contact:',
		'd2u_jobs_reference_number' => 'Reference number',
		'd2u_jobs_region' => 'City',
		'd2u_jobs_vacancies' => 'Vacancies',
	];
	
	/**
	 * @var string[] Array with french replacements. Key is the wildcard,
	 * value the replacement. 
	 */
	protected $replacements_french = [
		'd2u_jobs_announcement' => 'annonce complète',
		'd2u_jobs_application_link' => 'Formulaire de demande en ligne',
		'd2u_jobs_footer' => 'Veuillez nous envoyer vos documents de demande complets avec la date de début possible et vos attentes de salaire par courrier électronique à:',
		'd2u_jobs_module_attachment' => 'Documents de candidature : par exemple, curriculum vitae, certificats',
		'd2u_jobs_module_form_thanks' => 'Merci pour votre candidature. Notre service RH vous contactera dans les plus brefs délais.',
		'd2u_jobs_module_form_your_data' => "Résumé des données d'application",
		'd2u_jobs_phone' => 'Tél.',
		'd2u_jobs_questions' => 'Si vous avez des questions concernant ce poste, veuillez contacter:',
		'd2u_jobs_reference_number' => 'Numéro de réference',
		'd2u_jobs_region' => 'Ville',
		'd2u_jobs_vacancies' => "Offres d'emploi",
	];

	/**
	 * @var string[] Array with german replacements. Key is the wildcard,
	 * value the replacement. 
	 */
	protected $replacements_german = [
		'd2u_jobs_announcement' => 'Zur Ausschreibung',
		'd2u_jobs_application_link' => 'Online Bewerbungsformular',
		'd2u_jobs_footer' => 'Bitte senden Sie uns Ihre kompletten Bewerbungsunterlagen mit dem frühestmöglichen Eintrittstermin und Ihrer Gehaltvorstellung per E-Mail mit dem Stichwort „Karriere“ im Betreff an:',
		'd2u_jobs_module_attachment' => 'Bewerbungsunterlagen: z.B. Lebenslauf, Zeugnisse',
		'd2u_jobs_module_form_thanks' => 'Vielen Dank für Ihre Bewerbung. Unsere Personalabteilung wird umgehend mit Ihnen Kontakt aufnehmen.',
		'd2u_jobs_module_form_your_data' => 'Zusammenfassung Bewerbungsdaten',
		'd2u_jobs_phone' => 'Tel.',
		'd2u_jobs_questions' => 'Wenn Sie Fragen zur ausgeschriebenen Stelle haben, wenden Sie sich bitte an:',
		'd2u_jobs_reference_number' => 'Referenznummer',
		'd2u_jobs_region' => 'Ort',
		'd2u_jobs_vacancies' => 'Stellenangebote',
	];
	
	/**
	 * @var string[] Array with spanish replacements. Key is the wildcard,
	 * value the replacement. 
	 */
	protected $replacements_spanish = [
		'd2u_jobs_announcement' => 'Anuncio completo',
		'd2u_jobs_application_link' => 'Formulario online',
		'd2u_jobs_footer' => 'Por favor, envíenos sus documentos completos de solicitud con la posible fecha de inicio y sus expectativas salariales por correo electrónico a:',
		'd2u_jobs_module_attachment' => 'Documentos de solicitud: p. Ej., Curriculum vitae, certificados',
		'd2u_jobs_module_form_thanks' => 'Gracias por tu aplicación . Nuestro departamento de RRHH se pondrá en contacto contigo lo antes posible.',
		'd2u_jobs_module_form_your_data' => 'Resumen de los datos de la aplicación ',
		'd2u_jobs_phone' => 'Teléfono',
		'd2u_jobs_questions' => 'Si tiene preguntas relativas a esto, por favor contáctenos',
		'd2u_jobs_reference_number' => 'Número de referencia',
		'd2u_jobs_region' => 'Ciudad',
		'd2u_jobs_vacancies' => 'Vacantes',
	];
	
	/**
	 * @var string[] Array with russian replacements. Key is the wildcard,
	 * value the replacement. 
	 */
	protected $replacements_russian = [
		'd2u_jobs_announcement' => 'Отправить заявку',
		'd2u_jobs_application_link' => 'Онлайн-заявка',
		'd2u_jobs_footer' => 'Присылайте Ваше резюме и документы с возможной датой начала работы и ваши ожидания по зарплате по электронной почте:',
		'd2u_jobs_module_attachment' => 'Документы для подачи заявки: например, биографические данные, сертификаты.',
		'd2u_jobs_module_form_thanks' => 'Спасибо за вашу заявку . Наш отдел кадров свяжется с вами в ближайшее время.',
		'd2u_jobs_module_form_your_data' => 'Сводка данных приложения',
		'd2u_jobs_phone' => 'тел.',
		'd2u_jobs_questions' => 'Если у вас есть вопросы относительно этой вакансии, мы всегда к Вашим услугам:',
		'd2u_jobs_reference_number' => 'ссылка',
		'd2u_jobs_region' => 'город',
		'd2u_jobs_vacancies' => 'Вакансии',
	];

	/**
	 * Factory method.
	 * @return d2u_jobs_lang_helper Object
	 */
	public static function factory() {
		return new self();
	}
	
	/**
	 * Installs the replacement table for this addon.
	 */
	public function install() {
		foreach($this->replacements_english as $key => $value) {
			foreach (rex_clang::getAllIds() as $clang_id) {
				$lang_replacement = rex_config::get('d2u_jobs', 'lang_replacement_'. $clang_id, '');

				// Load values for input
				if($lang_replacement === 'chinese' && isset($this->replacements_chinese) && isset($this->replacements_chinese[$key])) {
					$value = $this->replacements_chinese[$key];
				}
				else if($lang_replacement === 'french' && isset($this->replacements_french) && isset($this->replacements_french[$key])) {
					$value = $this->replacements_french[$key];
				}
				else if($lang_replacement === 'german' && isset($this->replacements_german) && isset($this->replacements_german[$key])) {
					$value = $this->replacements_german[$key];
				}
				else if($lang_replacement === 'dutch' && isset($this->replacements_dutch) && isset($this->replacements_dutch[$key])) {
					$value = $this->replacements_dutch[$key];
				}
				else if($lang_replacement === 'russian' && isset($this->replacements_russian) && isset($this->replacements_russian[$key])) {
					$value = $this->replacements_russian[$key];
				}
				else if($lang_replacement === 'spanish' && isset($this->replacements_spanish) && isset($this->replacements_spanish[$key])) {
					$value = $this->replacements_spanish[$key];
				}
				else { 
					$value = $this->replacements_english[$key];
				}

				$overwrite = rex_config::get('d2u_jobs', 'lang_wildcard_overwrite', FALSE) === "true" ? TRUE : FALSE;
				parent::saveValue($key, $value, $clang_id, $overwrite);
			}
		}
	}
}