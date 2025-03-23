<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  admin_chat
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php if($chat_type === 'tawkto'){ ?>
    <p style="padding-left:20px">The Tawk.to chat is now available and can be found in the bottom right of the window.</p>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/<?php echo $widget_id;?>';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
<?php } elseif($chat_type === 'crisp') { ?>

<?php } elseif($chat_type === 'messenger'){ ?>

<?php } elseif($chat_type === 'whatsapp'){ ?>

<?php } ?>


