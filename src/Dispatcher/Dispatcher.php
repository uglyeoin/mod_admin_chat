<?php

/**
 * @package     KindOfUseful.Module.AdminChat
 *
 * @copyright   (C) 2025-2026 Kind of Useful. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace KindOfUseful\Module\AdminChat\Administrator\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Validates the chat settings and hands the layout only clean values.
 *
 * @since  5.1.0
 */
class Dispatcher extends AbstractModuleDispatcher
{
    protected function getLayoutData(): array
    {
        $data   = parent::getLayoutData();
        $params = $data['params'];

        $type = (string) $params->get('chat_type', 'tawkto');

        $data['chat_type']   = $type;
        $data['show_notice'] = (bool) $params->get('show_notice', 1);
        $data['chat']        = null;

        switch ($type) {
            case 'tawkto':
                $data['chat'] = self::tawkto((string) $params->get('widget_id', ''));
                break;

            case 'crisp':
                $data['chat'] = self::crisp((string) $params->get('crisp_id', ''));
                break;

            case 'whatsapp':
                $data['chat'] = self::whatsapp(
                    (string) $params->get('whatsapp_number', ''),
                    (string) $params->get('whatsapp_message', '')
                );
                break;
        }

        return $data;
    }

    /**
     * Accepts "property/widget", a bare property id, the embed URL, or the whole
     * pasted Tawk.to snippet, and returns the embed URL — or null if unusable.
     */
    private static function tawkto(string $raw): ?array
    {
        $raw = trim($raw);

        if (preg_match('#embed\.tawk\.to/([A-Za-z0-9]+(?:/[A-Za-z0-9]+)?)#', $raw, $m)) {
            $raw = $m[1];
        }

        if (!preg_match('#^[A-Za-z0-9]+(?:/[A-Za-z0-9]+)?$#', $raw)) {
            return null;
        }

        return ['src' => 'https://embed.tawk.to/' . $raw];
    }

    /**
     * Crisp website IDs are UUIDs; the pasted snippet is accepted too.
     */
    private static function crisp(string $raw): ?array
    {
        if (!preg_match('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/i', $raw, $m)) {
            return null;
        }

        return ['id' => strtolower($m[0])];
    }

    /**
     * wa.me wants the full international number as digits only, no "+" or
     * leading zeros, and the message URL-encoded in ?text=.
     */
    private static function whatsapp(string $number, string $message): ?array
    {
        // "+44 (0)7700 900123": the bracketed trunk zero is not dialled internationally.
        $number = preg_replace('/\(\s*0\s*\)/', '', $number) ?? '';
        $digits = ltrim(preg_replace('/\D+/', '', $number) ?? '', '0');

        if (\strlen($digits) < 8 || \strlen($digits) > 15) {
            return null;
        }

        $url = 'https://wa.me/' . $digits;

        if (trim($message) !== '') {
            $url .= '?text=' . rawurlencode(trim($message));
        }

        return ['url' => $url];
    }
}
