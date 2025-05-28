<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  admin_chat
 *
 * @copyright   (C) 2024 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace CodeAlongJug\Module\Adminchat\Administrator\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Dispatcher class for admin_chat
 *
 * @since  5.1.0
 */
class Dispatcher extends AbstractModuleDispatcher
{
    /**
     * Returns the layout data.
     *
     * @return  array
     *
     * @since   5.1.0
     */
    protected function getLayoutData()
    {
        $data = parent::getLayoutData();

        // Get the component title div
        if (Factory::getApplication()->getDocument()->getTitle() !== null) {
            $data['title'] = Factory::getApplication()->getDocument()->getTitle();
        }

        $data['chat_type'] = $data['params']->get('chat_type');
        $data['widget_id'] = $data['params']->get('widget_id');



        return $data;
    }
}
