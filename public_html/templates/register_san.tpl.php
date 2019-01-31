<?
#################################################################
## PHP Pro Bid v6.11															##
##-------------------------------------------------------------##
## Copyright �2007 PHP Pro Software LTD. All rights reserved.	##
##-------------------------------------------------------------##
#################################################################

if (!defined('INCLUDED')) {
    die("Access Denied");
}
?>
<script language="javascript">
    function checkEmail() {
        var email_check = document.getElementById('email_check').value;
        var email = document.getElementById('email').value;
        if (email == email_check)
        {
            document.getElementById('email_img').style.display = 'inline';
        }
        else
        {
            document.getElementById('email_img').style.display = 'none';
        }
    }

    function checkEmailSan() {

        var email = document.getElementById('email').value;
        var reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
        if (!email.match(reg)) {
            document.getElementById('emailCheckResult').innerHTML =
                    "<img src='images/failed.jpg'  height='40' width='40'><font color='red'>Некорректный E-Mail!</font>";
        } else {
            document.getElementById('emailCheckResult').innerHTML = "<img src='images/check_green.png'>";
        }
    }
    
    


    function checkPass() {
        if (document.registration_form.password.value == document.registration_form.password2.value)
            document.registration_form.pass_img.style.display = "inline";
        else
            document.registration_form.pass_img.style.display = "none";
    }

    function form_submit() {
        document.registration_form.operation.value = '';
        document.registration_form.edit_refresh.value = '1';
        document.registration_form.submit();
    }

    function copy_email_value() {
        document.getElementById('email_check').value = document.getElementById('email').value;
    }

    function copy_password_value() {
        document.registration_form.password2.value = document.registration_form.password.value;
    }

    function check_username()
    {
        var xmlHttp;

        if (window.XMLHttpRequest)
        {
            var xmlHttp = new XMLHttpRequest();

            if (XMLHttpRequest.overrideMimeType)
            {
                xmlHttp.overrideMimeType('text/xml');
            }
        }
        else if (window.ActiveXObject)
        {
            try
            {
                var xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
                try
                {
                    var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e) {
                }
            }
        }
        else
        {
            alert('Your browser does not support XMLHTTP!');
            return false;
        }

        var uname = document.getElementById('username').value;
        var url = 'check_username.php';
        var action = url + '?username=' + uname;

        // modified by Sanzhar Modified also check_username.php
        // if (uname != '') 
        // {
        xmlHttp.onreadystatechange = function() {
            showResult(xmlHttp, usernameResult);
        };
        xmlHttp.open("GET", action, true);
        xmlHttp.send(null);
        // }
        // else 
        // {
        // document.getElementById('usernameResult').innerHTML = '<?= MSG_ENTER_USERNAME; ?>' + 11111111111;
        // }
    }
</script>
<?= $header_registration_message; ?>
<br>
<?= $banned_email_output; ?>
<?= $display_formcheck_errors; ?>
<?= $check_voucher_message; ?>

<form action="<?= $register_post_url; ?>" method="post" name="registration_form">
    <input type="hidden" name="operation" value="submit">
    <input type="hidden" name="do" value="<?= $do; ?>">
    <input type="hidden" name="user_id" value="<?= $user_details['user_id']; ?>">
    <input type="hidden" name="edit_refresh" value="0">
    <input type="hidden" name="generated_pin" value="<?= $generated_pin; ?>">

    <input type="hidden" name="tax_account_type" value="0">
    <input type="hidden" name="first_name" value="-">
    <input type="hidden" name="last_name" value="-">
    <input type="hidden" name="address" value="-">
    <input type="hidden" name="city"value="-" >
    <input type="hidden" name="country" value="1973">
    <input type="hidden"  name="state" value="-">
    <input type="hidden"  name="zip_code" value="-">
    <input type="hidden"  name="phone" value="-">
    <input type="hidden"  name="email_check"  id="email_check"  value="">




    <?= $birthdate_box; ?>
    <table width="100%" border="0" cellpadding="3" cellspacing="2" class="border">
        <tr class="c5">
            <td><img src="themes/<?= $setts['default_theme']; ?>/img/pixel.gif" width="1" height="1" /></td>
            <td><img src="themes/<?= $setts['default_theme']; ?>/img/pixel.gif" width="1" height="1" /></td>
        </tr>

        <tr class="c1">
            <td width="150" align="right" class="contentfont"><?= MSG_EMAIL_ADDRESS; ?>            </td>
            <td class="contentfont">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td><input name="email" type="text" class="contentfont" id="email" 
                                   value="<?= $user_details['email']; ?>" size="40" maxlength="120"  
                                   <? echo (IN_ADMIN == 1) ? 'onchange="copy_email_value();"' : ''; ?> onblur="checkEmailSan();" />
                        </td>
                        <td>&nbsp; &nbsp;</td>
                        <td id="emailCheckResult"></td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr class="reguser">
            <td>&nbsp; &nbsp;</td>
            <td><?= MSG_EMAIL_EXPLANATION; ?></td>
        </tr>
        <tr class="c1">
            <td width="150" align="right" class="contentfont"><?= MSG_SUBSCRIBE_TO_NEWSLETTER; ?>
            </td>
            <td class="contentfont"><input name="newsletter" type="checkbox" class="newsletter" id="email" value="1" <? echo ($user_details['newsletter']) ? 'checked' : ''; ?> /></td>
        </tr>
        <tr class="c1">
            <td width="150" align="right" class="contentfont"><?= MSG_CREATE_USERNAME; ?></td>
            <td class="contentfont">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td><input name="username" type="text" id="username" value="<?= $user_details['username']; ?>" size="40" maxlength="30" <?= $edit_disabled; ?> onblur="check_username();"/></td>
                        <td>&nbsp; &nbsp;</td>
                        <td id="usernameResult"><? echo (!$edit_user) ? MSG_ENTER_USERNAME : ''; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="reguser">
            <td>&nbsp;</td>
            <td><?= MSG_USERNAME_EXPLANATION; ?></td>
        </tr>
        <tr class="c1">
            <td align="right" class="contentfont"><?= MSG_CREATE_PASS; ?>
            </td>
            <td class="contentfont"><input name="password" type="password" class="contentfont" id="password" size="40" maxlength="20" <? echo (IN_ADMIN == 1) ? 'onchange="copy_password_value();"' : ''; ?> /></td>
        </tr>
        <tr class="reguser">
            <td>&nbsp;</td>
            <td><?= MSG_PASSWORD_EXPLANATION; ?></td>
        </tr>
        <tr class="c1">
            <td align="right" class="contentfont"><?= MSG_VERIFY_PASS; ?></td>
            <td class="contentfont"><input name="password2" type="password"  id="password2" size="40" maxlength="20" onkeyup="checkPass();" />
                <img src="<?= $path_relative; ?>themes/<?= $setts['default_theme']; ?>/img/system/check_img.gif" id="pass_img" align="absmiddle" style="display:none;" /></td>
        </tr>
        <tr class="c1">
            <td width="150" align="right" class="contentfont"><?= MSG_REG_PIN; ?></td>
            <td><?= $pin_image_output; ?></td>
        </tr>
        <tr class="reguser">
            <td align="right" class="contentfont">&nbsp;</td>
            <td><?= MSG_REG_PIN_EXPL; ?></td>
        </tr>
        <tr class="c1">
            <td width="150" align="right" class="contentfont"><?= MSG_CONF_PIN; ?></td>
            <td><input name="pin_value" type="text" class="contentfont" id="pin_value" value="" size="20" /></td>
        </tr>
    </table>


    <input id='show_hide_button' type='button' value='Показать соглашение' onclick='show_hide_agreement();'>
    <script>
    function show_hide_agreement() {
        if (document.getElementById("agreement").style.display != "block") {
            document.getElementById("agreement").style.display = "block";
            document.getElementById("show_hide_button").value = "Скрыть соглашение";
        } else {
            document.getElementById("agreement").style.display = "none";
            document.getElementById("show_hide_button").value = "Показать соглашение";
        }
    }
    </script>

    <div style='display:none' id="agreement"><?= $registration_terms_box; ?></div><br>
    <input type="checkbox" name="agree_terms" value="1"> <?= GMSG_CLICK_TO_AGREE_TO_TERMS; ?>

    <br />
    <table width="100%" border="0" cellpadding="3" cellspacing="2" class="border">
        <tr>
            <td width="150" class="contentfont">
                <input name="form_register_proceed" type="submit" id="form_register_proceed" value="<?= $proceed_button; ?>" onclick="copy_email_value();"/>
            </td>
            <td class="contentfont">&nbsp;</td>
        </tr>
    </table>
</form>
