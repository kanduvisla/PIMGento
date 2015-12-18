<?php
/**
 * @author    Agence Dn'D <magento@dnd.fr>
 * @copyright Copyright (c) 2015 Agence Dn'D (http://www.dnd.fr)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Pimgento_Product_Model_Cron extends Pimgento_Core_Model_Cron
{

    /**
     * Cron job method
     *
     * @param Mage_Cron_Model_Schedule $schedule
     *
     * @return $this
     */
    public function run(Mage_Cron_Model_Schedule $schedule)
    {
        if (!Mage::getStoreConfig('pimdata/product/cron_enabled')) {
            return $this;
        }

        $cronFiles = Mage::getStoreConfig('pimdata/product/cron_file');

        if ($cronFiles) {
            $files = explode(';', $cronFiles);
            foreach ($files as $key => $file) {
                if ($file) {
                    $this->launch('pimgento_product', $file, ($key == count($files) - 1));
                }
            }
        }

        return $this;
    }

}