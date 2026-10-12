<?php

/**
 * @package     KindOfUseful.Module.AdminChat
 *
 * @copyright   (C) 2025-2026 Kind of Useful. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;

return new class () implements InstallerScriptInterface {
    private string $minimumPhp = '8.1.0';

    private string $minimumJoomla = '5.0.0';

    public function install(InstallerAdapter $adapter): bool
    {
        return true;
    }

    public function update(InstallerAdapter $adapter): bool
    {
        return true;
    }

    public function uninstall(InstallerAdapter $adapter): bool
    {
        return true;
    }

    public function preflight(string $type, InstallerAdapter $adapter): bool
    {
        if ($type === 'uninstall') {
            return true;
        }

        if (version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
            \Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPhp), 'error');

            return false;
        }

        if (version_compare(JVERSION, $this->minimumJoomla, '<')) {
            \Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomla), 'error');

            return false;
        }

        return true;
    }

    public function postflight(string $type, InstallerAdapter $adapter): bool
    {
        return true;
    }
};
