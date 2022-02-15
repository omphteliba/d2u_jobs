<?php
/**
 * Class managing all Personio stuff
 */
class personio
{
    /**
     * Perform Personio XML import, calls import()
     */
    public static function autoimport(): void
    {
        // Include mediapool functions when call is frontend call
        if (!rex::isBackend()) {
            require_once __DIR__ . '/../../../../mediapool/functions/function_rex_mediapool.php';
        }

        if (self::import()) {
            print \rex_view::success(\rex_i18n::msg('d2u_jobs_personio_import_success'));
        }
    }

    /**
     * Perform Personio XML import
     * @return boolean TRUE if successfull
     * @throws rex_exception
     */
    public static function import(): bool
    {
        $personio_xml_url = \rex_config::get('d2u_jobs', 'personio_xml_url', false);
        if ($personio_xml_url === false) {
            print \rex_view::error(\rex_i18n::msg('d2u_jobs_personio_settings_failure_xml_url'));
            return false;
        }
        
        $xml_stream = stream_context_create(['http' => ['header' => 'Accept: application/xml']]);
        $xml_contents = file_get_contents($personio_xml_url, false, $xml_stream);
        if ($xml_contents === false) {
            print \rex_view::error(\rex_i18n::msg('d2u_jobs_personio_import_failure_xml_url'));
            return false;
        }
        $xml_jobs = new SimpleXMLElement($xml_contents);

        self::log('***** Starting Import *****');
        // Get old stuff to be able to delete it later
        $old_jobs = self::getAllPersonioJobs();
        $old_contacts = []; // Get them later from Jobs
        $old_pictures = [];
        foreach ($old_jobs as $old_job) {
            // Pictures
            if (!in_array($old_job->picture, $old_pictures)) {
                $old_pictures[$old_job->picture] = $old_job->picture;
            }
            // D2U_Jobs\Contacts
            if ($old_job->contact !== false && !array_key_exists($old_job->contact->contact_id, $old_contacts)) {
                $old_contacts[$old_job->contact->contact_id] = $old_job->contact;
                if (!in_array($old_job->contact->picture, $old_pictures)) {
                    $old_pictures[$old_job->contact->picture] = $old_job->contact->picture;
                }
            }
        }
        
        // Get new jobs
        foreach ($xml_jobs->entry as $xml_job) {
            // Category
            $category = self::getCatByPersonioID($xml_job->berufskategorie_id->__toString());
            if ($category === false) {
                self::log('Category with personio ID '. $xml_job->berufskategorie_id->__toString() .
                    ' does not exist. Falback to default category.');
                $category = new \D2U_Jobs\Category(
                    \rex_config::get('d2u_jobs', 'personio_default_category'),
                    \rex_config::get('d2u_jobs', 'personio_default_lang')
                );
            }

            // Import job
            $personio_id = $xml_job->id->__toString();
            $job = self::getJobByPersonioID($personio_id);
            if ($job === false) {
                $job = \D2U_Jobs\Job::factory();
                $job->clang_id = \rex_config::get('d2u_jobs', 'personio_default_lang');
                $job->personio_job_id = $personio_id;
            }

            if (!in_array($category, $job->categories)) {
                $job->categories[$category->category_id] = $category;
            }

            $job->city = $xml_job->office->__toString();
            $job->date = $xml_job->createdAt->__toString();
            $job->internal_name = $xml_job->name->__toString();
            $job->name = $xml_job->name->__toString();
            $job->offer_heading = self::getHeadline($xml_job->block3_html) != '' ? self::getHeadline($xml_job->block3_html) : \Sprog\Wildcard::get('d2u_jobs_personio_offer_heading', \rex_config::get('d2u_jobs', 'personio_default_lang'));
            $job->offer_text = self::trimString(self::stripHeadline($xml_job->block3_html));
            $job->online_status = "online";
            $job->profile_heading = self::getHeadline($xml_job->block2_html) != '' ? self::getHeadline($xml_job->block2_html) : \Sprog\Wildcard::get('d2u_jobs_personio_profile_heading', \rex_config::get('d2u_jobs', 'personio_default_lang'));
            $job->profile_text = self::trimString(self::stripHeadline($xml_job->block2_html));
            $job->reference_number = $xml_job->id->__toString();
            $job->tasks_heading = self::getHeadline($xml_job->block1_html) != '' ? self::getHeadline($xml_job->block1_html) : \Sprog\Wildcard::get('d2u_jobs_personio_tasks_heading', \rex_config::get('d2u_jobs', 'personio_default_lang'));
            $job->tasks_text = self::trimString(self::stripHeadline($xml_job->block1_html));
            if ((int) $xml_job->stellenart_id->__toString() == 3) {
                $job->type = "VOLUNTEER";
            } elseif ((int)$xml_job->stellenart_id->__toString() == 5) {
                $job->type = "CONTRACTOR";
            } elseif (in_array((int) $xml_job->stellenart_id->__toString(), [6, 8])) {
                $job->type = "FULL_TIME";
            } elseif (in_array((int) $xml_job->stellenart_id->__toString(), [7, 9, 10])) {
                $job->type = "PART_TIME";
            } else {
                $job->type = "OTHER";
            }
            $job->translation_needs_update = 'no';
            $job->save();

            if (array_key_exists($job->personio_job_id, $old_jobs)) {
                unset($old_jobs[$job->personio_job_id]);
                self::log('Job '. $job->name .' already exists. Updated.');
            } else {
                self::log('Job '. $job->name .' added.');
            }
        }

        // Delete unused old jobs
        foreach ($old_jobs as $old_job) {
            $old_job->delete(true);
            self::log('Job '. $old_job->name .' deleted.');
        }
        
        // Delete unused old contacts
        foreach ($old_contacts as $old_contact) {
            $old_contact->delete();
            self::log('Contact '. $old_contact->name .' deleted.');
        }

        // Delete unused old pictures
        foreach ($old_pictures as $old_picture) {
            $delete_result = \rex_mediapool_deleteMedia($old_picture);
            if ($delete_result['ok'] === false) {
                // File seems to be in use
                self::log('Picture '. $old_picture .' deletion requested, but is in use.');
            } else {
                self::log('Picture '. $old_picture .' deleted.');
            }
        }

        return true;
    }

    /**
     * Isolates headline from text
     * @param string $string String potenially containing headline
     * @return string headline text without tags
     */
    private static function getHeadline(string $string): string
    {
        if ($string === '') {
            return '';
        }

        $doc = new DOMDocument();
        $doc->loadHTML($string);

        foreach ($doc->getElementsByTagName(\rex_config::get('d2u_jobs', 'personio_headline_tag')) as $item) {
            return utf8_decode($item->textContent);
        }

        return '';
    }

    /**
     * Get mediapool new filename by old filename
     * @param string $old_filename Old media filename before import into mediapool
     * @return string filename used in mediapool, if not found, empty string is returned
     */
    private static function getMediapoolFilename(string $old_filename): string
    {
        $query = "SELECT filename FROM `". \rex::getTablePrefix() ."media` "
            . "WHERE originalname = '". $old_filename ."'";
        $result = \rex_sql::factory();
        $result->setQuery($query);

        if ($result->getRows() > 0) {
            return $result->getValue("filename");
        }
        
        return "";
    }
    
    /**
     * Removes headline from text
     * @param string $string String with text potentially containing headline
     * @return string text without headline
     */
    private static function stripHeadline(string $string): string
    {
        $headline = self::getHeadline($string);

        $h_tag = \rex_config::get('d2u_jobs', 'personio_headline_tag');
        return str_replace('<' . $h_tag . '>' . $headline . '</' . $h_tag . '>', '', $string);
    }
    
    /**
     * Removes not allowed tags and other stuff from string.
     * @param string $string String to be prepared
     * @return string Prepared string
     */
    private static function trimString(string $string): string
    {
        $string = strip_tags($string, '<ul></ul><li></li><b></b><i></i><strong></strong><br><br /><p></p><small></small>');
        $string = trim(preg_replace('/\t+/', '', $string));
        $string = str_replace(['&nbsp;', '&crarr;'], ' ', $string);
        $string = preg_replace("/\s+/", " ", $string);
        return str_replace(["\r", "\n"], '', $string);
    }
    
    /**
     * Logs message
     * @param string $message Message to be logged
     */
    private static function log(string $message): void
    {
        $log = file_exists(rex_path::addonCache('d2u_jobs', 'personio_import_log.txt')) ? file_get_contents(rex_path::addonCache('d2u_jobs', 'personio_import_log.txt')) : "";
        
        $log .= PHP_EOL. date('d.m.Y H:i:s', time()) .": ". $message;

        // Write to log
        if (!is_dir(rex_path::addonCache('d2u_jobs'))) {
            if (!mkdir($concurrentDirectory = rex_path::addonCache('d2u_jobs'), 0755, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
        file_put_contents(rex_path::addonCache('d2u_jobs', 'personio_import_log.txt'), $log);
    }

    /**
     * Get all jobs imported by Personio Plugin
     */
    public static function getAllPersonioJobs(): array
    {
        $query = "SELECT job_id, personio_job_id FROM ". \rex::getTablePrefix() ."d2u_jobs_jobs "
            ."WHERE personio_job_id > 0";
        $result = \rex_sql::factory();
        $result->setQuery($query);

        $jobs = [];
        for ($i = 0; $i < $result->getRows(); $i++) {
            $jobs[$result->getValue('hr4you_job_id')] = new Job($result->getValue('job_id'), \rex_config::get('d2u_jobs', 'hr4you_default_lang'));
            $result->next();
        }

        return $jobs;
    }

    /**
     * Get Cat object by Personio ID
     * @param int $personio_id Personio ID
     * @return \D2U_Jobs\Category Category object, if available, otherwise FALSE
     * @throws rex_sql_exception
     */
    public static function getCatByPersonioID(int $personio_id): bool|\D2U_Jobs\Category
    {
        if (\rex_plugin::get('d2u_jobs', 'personio_import')->isAvailable()) {
            $query = "SELECT category_id FROM ". \rex::getTablePrefix() ."d2u_jobs_categories "
                ."WHERE personio_category_id = ". $personio_id;
            $result = \rex_sql::factory();
            $result->setQuery($query);

            if ($result->getRows() > 0) {
                return new \D2U_Jobs\Category(
                    $result->getValue("category_id"),
                    \rex_config::get('d2u_jobs', 'personio_default_lang')
                );
            }
        }
        return false;
    }

    /**
     * Get object by Personio ID
     * @param int $personio_id Personio ID
     * @return \D2U_Jobs\Job Job object, if available, otherwise FALSE
     * @throws rex_sql_exception
     */
    public static function getJobByPersonioID(int $personio_id): bool|\D2U_Jobs\Job
    {
        if (\rex_plugin::get('d2u_jobs', 'personio_import')->isAvailable()) {
            $query = "SELECT job_id FROM ". \rex::getTablePrefix() ."d2u_jobs_jobs "
                ."WHERE personio_job_id = ". $personio_id;
            $result = \rex_sql::factory();
            $result->setQuery($query);

            if ($result->getRows() > 0) {
                return new \D2U_Jobs\Job(
                    $result->getValue("job_id"),
                    \rex_config::get('d2u_jobs', 'hr4you_default_lang')
                );
            }
        }
        return false;
    }
}
