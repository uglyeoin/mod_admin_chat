<?php

/**
 * @package     KindOfUseful.Module.AdminChat
 *
 * @copyright   (C) 2025-2026 Kind of Useful. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/** @var string     $chat_type */
/** @var array|null $chat */
/** @var bool       $show_notice */

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();

if ($chat === null) {
    // Tell the administrator what is missing rather than failing silently.
    $key = $chat_type === 'messenger' ? 'MOD_ADMINCHAT_MESSENGER_RETIRED' : 'MOD_ADMINCHAT_NOT_CONFIGURED';
    echo '<p class="alert alert-warning m-2">' . Text::_($key) . '</p>';

    return;
}

$json = static fn ($value): string => json_encode($value, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES);

switch ($chat_type) {
    case 'tawkto':
        $wa->addInlineScript(
            'var Tawk_API=Tawk_API||{},Tawk_LoadStart=new Date();(function(){var s=document.createElement("script");'
            . 's.async=true;s.src=' . $json($chat['src']) . ';s.charset="UTF-8";s.setAttribute("crossorigin","*");'
            . 'document.head.appendChild(s);})();',
            [],
            ['type' => 'text/javascript'],
            []
        );
        break;

    case 'crisp':
        $wa->addInlineScript(
            'window.$crisp=[];window.CRISP_WEBSITE_ID=' . $json($chat['id']) . ';(function(){var s=document.createElement("script");'
            . 's.src="https://client.crisp.chat/l.js";s.async=1;document.head.appendChild(s);})();',
            [],
            ['type' => 'text/javascript'],
            []
        );
        break;

    case 'whatsapp':
        $wa->addInlineStyle(
            '.kou-adminchat-wa{position:fixed;right:20px;bottom:20px;z-index:1050;display:inline-flex;align-items:center;gap:.5rem;'
            . 'padding:.65rem 1rem;border-radius:999px;background:#25D366;color:#fff;font-weight:600;text-decoration:none;'
            . 'box-shadow:0 4px 14px rgba(0,0,0,.2)}.kou-adminchat-wa:hover,.kou-adminchat-wa:focus{background:#1ebe5b;color:#fff}'
        );
        ?>
		<a class="kou-adminchat-wa" href="<?php echo htmlspecialchars($chat['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
			<span class="fa-brands fa-whatsapp" aria-hidden="true"></span>
			<?php echo Text::_('MOD_ADMINCHAT_WHATSAPP_BUTTON'); ?>
		</a>
        <?php
        break;
}

if ($show_notice && $chat_type !== 'whatsapp') : ?>
	<p class="m-2"><?php echo Text::_('MOD_ADMINCHAT_NOTICE'); ?></p>
<?php endif;
