<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class Jjwg_MapsViewConfig extends SugarView {

    function Jjwg_MapsViewConfig() {
        parent::SugarView();
    }

    function display() {

        global $sugar_config;
        global $jjwg_config_defaults;
        global $jjwg_config;
        
        global $currentModule;
        global $current_user;
        global $valid_geocode_modules;
        global $theme;
        global $mod_strings;
        global $app_strings;
        global $app_list_strings;

        // Language Needed!
        
        // Language Arrays
        $address_types_billing_or_shipping = array(
            'billing' => $mod_strings['LBL_BILLING_ADDRESS'],
            'shipping' => $mod_strings['LBL_SHIPPING_ADDRESS']
        );
        $address_types_primary_or_alt = array(
            'primary' => $mod_strings['LBL_PRIMARY_ADDRESS'],
            'alt' => $mod_strings['LBL_ALTERNATIVE_ADDRESS']
        );
        $address_types_flex_relate = array(
            'flex_relate' => 'Flex Relate'
        );
        $enabled_disabled = array(
            '0' => $mod_strings['LBL_DISABLED'],
            '1' => $mod_strings['LBL_ENABLED']
        );
        
        $unit_types = $app_list_strings['map_unit_type_list'];
        ?>

        <p style="margin: 15px 0px 15px 0px; font-size: 1.7em;"><strong>Please consider donating to this project!</strong></p>

        <p style="margin: 15px 0px 15px 0px; font-size: 1.25em; width: 790px;">
            If you've found this project helpful, please donate!<br />
            Donations from users like you will help keep this project alive.
        </p>
        
        <div style="margin: 15px 0px 15px 0px;">
            <span style="font-size: 1.7em;"><strong>$5, $20, $100 or even $500 &nbsp;</strong></span>
            <form style="display:inline;" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="FZENX6PLHKX2L">
                <input style="border:0;" type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
        
        <p>&nbsp;</p>

        <p style="margin: 15px 0px 15px 0px; font-size: 1.7em;"><strong><?php echo $mod_strings['LBL_CONFIG_TITLE']; ?></strong></p>

        <?php if (!empty($_REQUEST['config_save_notice'])) { ?>
            <p style="margin: 15px 0px 15px 0px; font-size: 1.5em;"><strong><?php echo $mod_strings['LBL_CONFIG_SAVED']; ?></strong></p>
        <?php } ?>

<form name="settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="module" value="<?php echo $currentModule; ?>">
<input type="hidden" name="action" value="config" />

<table class="edit view" cellpadding="0" cellspacing="12" border="0">
    <tr>
        <td colspan="2">
            <?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_SETTINGS_TITLE']; ?>
        </td>
    </tr>
    <tr>
        <td width="20%" nowrap="nowrap">
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_ACCOUNTS']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Accounts" tabindex="111" 
                name="address_type_Accounts" title="">
                <?php foreach ($address_types_billing_or_shipping as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Accounts']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($address_types_billing_or_shipping[$jjwg_config_defaults['geocode_modules_to_address_type']['Accounts']]); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_CONTACTS']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Contacts" tabindex="112" 
                name="address_type_Contacts" title="">
                <?php foreach ($address_types_primary_or_alt as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Contacts']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($address_types_primary_or_alt[$jjwg_config_defaults['geocode_modules_to_address_type']['Contacts']]); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_LEADS']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Leads" tabindex="113" 
                name="address_type_Leads" title="">
                <?php foreach ($address_types_primary_or_alt as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Leads']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($address_types_primary_or_alt[$jjwg_config_defaults['geocode_modules_to_address_type']['Leads']]); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_OPPORTUNITIES']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Opportunities" tabindex="114" 
                name="address_type_Opportunities" title="">
                <?php foreach ($address_types_billing_or_shipping as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Opportunities']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($address_types_billing_or_shipping[$jjwg_config_defaults['geocode_modules_to_address_type']['Opportunities']]); ?>
                <?php echo $mod_strings['LBL_CONFIG_OF_RELATED_ACCOUNT']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_CASES']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Cases" tabindex="115" 
                name="address_type_Cases" title="">
                <?php foreach ($address_types_billing_or_shipping as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Cases']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($address_types_billing_or_shipping[$jjwg_config_defaults['geocode_modules_to_address_type']['Cases']]); ?> 
                <?php echo $mod_strings['LBL_CONFIG_OF_RELATED_ACCOUNT']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_PROJECTS']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Project" tabindex="116" 
                name="address_type_Project" title="">
                <?php foreach ($address_types_billing_or_shipping as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Project']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($address_types_billing_or_shipping[$jjwg_config_defaults['geocode_modules_to_address_type']['Project']]); ?> 
                <?php echo $mod_strings['LBL_CONFIG_OF_RELATED_ACCOUNT_OPPORTUNITY']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_MEETINGS']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Meetings" tabindex="117" 
                name="address_type_Meetings" title="">
                <?php foreach ($address_types_flex_relate as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Meetings']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_RELATED_OBJECT_THRU_FLEX_RELATE']; ?>
        </td>
    </tr>
    <tr>
        <td width="20%" nowrap="nowrap">
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_TYPE_FOR_PROSPECTS']; ?> </strong>
        </td>
        <td>
            <select id="address_type_Prospects" tabindex="118" 
                name="address_type_Prospects" title="">
                <?php foreach ($address_types_primary_or_alt as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['geocode_modules_to_address_type']['Prospects']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($address_types_primary_or_alt[$jjwg_config_defaults['geocode_modules_to_address_type']['Prospects']]); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    
    
    <tr>
        <td colspan="2">
            <?php echo $mod_strings['LBL_CONFIG_MARKER_GROUP_FIELD_SETTINGS_TITLE']; ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_ACCOUNTS']; ?> </strong></td>
        <td><input type="text" name="grouping_field_Accounts" id="grouping_field_Accounts" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Accounts'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Accounts']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Accounts']); ?>" 
            title='' tabindex='121' size="25" maxlength="75">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Accounts']); ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_CONTACTS']; ?> </strong></td>
        <td><input type="text" name="grouping_field_Contacts" id="grouping_field_Contacts" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Contacts'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Contacts']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Contacts']); ?>" 
            title='' tabindex='122' size="25" maxlength="32">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Contacts']); ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_LEADS'];?> </strong></td>
        <td><input type="text" name="grouping_field_Leads" id="grouping_field_Leads" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Leads'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Leads']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Leads']); ?>" 
            title='' tabindex='123' size="25" maxlength="32">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Leads']); ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_OPPORTUNITIES']; ?> </strong></td>
        <td><input type="text" name="grouping_field_Opportunities" id="grouping_field_Opportunities" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Opportunities'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Opportunities']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Opportunities']); ?>" 
            title='' tabindex='124' size="25" maxlength="32">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Opportunities']); ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_CASES']; ?> </strong></td>
        <td><input type="text" name="grouping_field_Cases" id="grouping_field_Cases" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Cases'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Cases']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Cases']); ?>" 
            title='' tabindex='125' size="25" maxlength="32">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Cases']); ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_PROJECTS']; ?> </strong></td>
        <td><input type="text" name="grouping_field_Project" id="grouping_field_Project" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Project'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Project']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Project']); ?>" 
            title='' tabindex='126' size="25" maxlength="32">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Project']); ?>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_MEETINGS']; ?> </strong></td>
        <td><input type="text" name="grouping_field_Meetings" id="grouping_field_Meetings" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Meetings'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Meetings']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Meetings']); ?>" 
            title='' tabindex='127' size="25" maxlength="32">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Meetings']); ?>
            &nbsp; (Limited to Meetings Module Fields)
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GROUP_FIELD_FOR_PROSPECTS']; ?> </strong></td>
        <td><input type="text" name="grouping_field_Prospects" id="grouping_field_Prospects" 
            value="<?php echo (isset($jjwg_config['map_markers_grouping_field']['Prospects'])) ? 
                htmlspecialchars($jjwg_config['map_markers_grouping_field']['Prospects']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Prospects']); ?>" 
            title='' tabindex='128' size="25" maxlength="32">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_grouping_field']['Prospects']); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="2">
            <strong><?php echo $mod_strings['LBL_CONFIG_GEOCODING_SETTINGS_TITLE']; ?></strong>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GEOCODING_LIMIT_TITLE']; ?> </strong></td>
        <td><input type="text" name="geocoding_limit" id="geocoding_limit" 
            value="<?php echo (isset($jjwg_config['geocoding_limit'])) ? 
                htmlspecialchars($jjwg_config['geocoding_limit']) : 
                htmlspecialchars($jjwg_config_defaults['geocoding_limit']); ?>" 
            title='' tabindex='141' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($jjwg_config_defaults['geocoding_limit']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_GEOCODING_LIMIT_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_GOOGLE_GEOCODING_LIMIT_TITLE']; ?> </strong></td>
        <td><input type="text" name="google_geocoding_limit" id="google_geocoding_limit" 
            value="<?php echo (isset($jjwg_config['google_geocoding_limit'])) ? 
                htmlspecialchars($jjwg_config['google_geocoding_limit']) : 
                htmlspecialchars($jjwg_config_defaults['google_geocoding_limit']); ?>" 
            title='' tabindex='142' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($jjwg_config_defaults['google_geocoding_limit']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_GOOGLE_GEOCODING_LIMIT_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_EXPORT_ADDRESSES_LIMIT_TITLE']; ?> </strong></td>
        <td><input type="text" name="export_addresses_limit" id="export_addresses_limit" 
            value="<?php echo (isset($jjwg_config['export_addresses_limit'])) ? 
                htmlspecialchars($jjwg_config['export_addresses_limit']) : 
                htmlspecialchars($jjwg_config_defaults['export_addresses_limit']); ?>" 
            title='' tabindex='143' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> 
                <?php echo htmlspecialchars($jjwg_config_defaults['export_addresses_limit']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_EXPORT_ADDRESSES_LIMIT_DESC']; ?></td>
    </tr>



    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="2">
            <strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_CACHE_SETTINGS_TITLE']; ?></strong>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_CACHE_GET_ENABLED_TITLE']; ?> </strong></td>
        <td>
            <?php $enabled = !empty($jjwg_config['address_cache_get_enabled']) ? '1' : '0'; ?>
            <select id="address_cache_get_enabled" tabindex="145" 
                name="address_cache_get_enabled" title="">
                <?php foreach ($enabled_disabled as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $enabled) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($enabled_disabled[$jjwg_config_defaults['address_cache_get_enabled']]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_ADDRESS_CACHE_GET_ENABLED_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_ADDRESS_CACHE_SAVE_ENABLED_TITLE']; ?> </strong></td>
        <td>
            <?php $enabled = !empty($jjwg_config['address_cache_save_enabled']) ? '1' : '0'; ?>
            <select id="address_cache_save_enabled" tabindex="146" 
                name="address_cache_save_enabled" title="">
                <?php foreach ($enabled_disabled as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $enabled) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($enabled_disabled[$jjwg_config_defaults['address_cache_save_enabled']]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_ADDRESS_CACHE_SAVE_ENABLED_DESC']; ?></td>
    </tr>

    
    
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="2">
            <strong><?php echo $mod_strings['LBL_CONFIG_LOGIC_HOOKS_SETTINGS_TITLE']; ?></strong>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_LOGIC_HOOKS_ENABLED_TITLE']; ?> </strong></td>
        <td>
            <?php $enabled = !empty($jjwg_config['logic_hooks_enabled']) ? '1' : '0'; ?>
            <select id="logic_hooks_enabled" tabindex="148" 
                name="logic_hooks_enabled" title="">
                <?php foreach ($enabled_disabled as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $enabled) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($enabled_disabled[$jjwg_config_defaults['logic_hooks_enabled']]) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_LOGIC_HOOKS_ENABLED_DESC']; ?></td>
    </tr>



    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
        <td colspan="2">
            <strong><?php echo $mod_strings['LBL_CONFIG_MARKER_MAPPING_SETTINGS_TITLE']; ?></strong>
        </td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_MARKERS_LIMIT_TITLE']; ?> </strong></td>
        <td><input type="text" name="map_markers_limit" id="map_markers_limit" 
            value="<?php echo (isset($jjwg_config['map_markers_limit'])) ? 
                htmlspecialchars($jjwg_config['map_markers_limit']) : 
                htmlspecialchars($jjwg_config_defaults['map_markers_limit']); ?>" 
            title='' tabindex='150' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_markers_limit']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_MARKERS_LIMIT_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_CENTER_LATITUDE_TITLE']; ?> </strong></td>
        <td><input type="text" name="map_default_center_latitude" id="map_default_center_latitude" 
            value="<?php echo (isset($jjwg_config['map_default_center_latitude'])) ? 
                htmlspecialchars($jjwg_config['map_default_center_latitude']) : 
                htmlspecialchars($jjwg_config_defaults['map_default_center_latitude']); ?>" 
            title='' tabindex='151' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_default_center_latitude']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_CENTER_LATITUDE_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_CENTER_LONGITUDE_TITLE']; ?> </strong></td>
        <td><input type="text" name="map_default_center_longitude" id="map_default_center_longitude" 
            value="<?php echo (isset($jjwg_config['map_default_center_longitude'])) ? 
                htmlspecialchars($jjwg_config['map_default_center_longitude']) : 
                htmlspecialchars($jjwg_config_defaults['map_default_center_longitude']); ?>" 
            title='' tabindex='152' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_default_center_longitude']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_CENTER_LONGITUDE_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_UNIT_TYPE_TITLE']; ?> </strong></td>
        <td>
            <select id="map_default_unit_type" tabindex="153" 
                name="map_default_unit_type" title="">
                <?php foreach ($unit_types as $key=>$value) { ?>
                    <option value="<?php echo htmlspecialchars($key); ?>" <?php 
                    if ($key == $jjwg_config['map_default_unit_type']) echo 'selected="selected"';
                    ?>><?php echo htmlspecialchars($value); ?>
                <?php } ?>
            </select>
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_default_unit_type']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_UNIT_TYPE_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_DISTANCE_TITLE']; ?> </strong></td>
        <td><input type="text" name="map_default_distance" id="map_default_distance" 
            value="<?php echo (isset($jjwg_config['map_default_distance'])) ? 
                htmlspecialchars($jjwg_config['map_default_distance']) : 
                htmlspecialchars($jjwg_config_defaults['map_default_distance']); ?>" 
            title='' tabindex='154' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_default_distance']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_DEFAULT_DISTANCE_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_DUPLICATE_MARKER_ADJUSTMENT_TITLE']; ?> </strong></td>
        <td><input type="text" name="map_duplicate_marker_adjustment" id="map_duplicate_marker_adjustment" 
            value="<?php echo (isset($jjwg_config['map_duplicate_marker_adjustment'])) ? 
                rtrim(number_format($jjwg_config['map_duplicate_marker_adjustment'], 8), '0.') : 
                rtrim(number_format($jjwg_config_defaults['map_duplicate_marker_adjustment'], 8), '0.'); ?>" 
            title='' tabindex='155' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo rtrim(number_format($jjwg_config_defaults['map_duplicate_marker_adjustment'], 8), '0.'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_DUPLICATE_MARKER_ADJUSTMENT_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_CLUSTER_GRID_SIZE_TITLE']; ?> </strong></td>
        <td><input type="text" name="map_clusterer_grid_size" id="map_clusterer_grid_size" 
            value="<?php echo (isset($jjwg_config['map_clusterer_grid_size'])) ? 
                htmlspecialchars($jjwg_config['map_clusterer_grid_size']) : 
                htmlspecialchars($jjwg_config_defaults['map_clusterer_grid_size']); ?>" 
            title='' tabindex='156' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_clusterer_grid_size']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_CLUSTER_GRID_SIZE_DESC']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo $mod_strings['LBL_CONFIG_MAP_MARKERS_CLUSTERER_MAX_ZOOM_TITLE']; ?> </strong></td>
        <td><input type="text" name="map_clusterer_max_zoom" id="map_clusterer_max_zoom" 
            value="<?php echo (isset($jjwg_config['map_clusterer_max_zoom'])) ? 
                htmlspecialchars($jjwg_config['map_clusterer_max_zoom']) : 
                htmlspecialchars($jjwg_config_defaults['map_clusterer_max_zoom']); ?>" 
            title='' tabindex='157' size="10" maxlength="25">
            &nbsp; <?php echo $mod_strings['LBL_CONFIG_DEFAULT']; ?> <?php echo htmlspecialchars($jjwg_config_defaults['map_clusterer_max_zoom']) ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $mod_strings['LBL_CONFIG_MAP_MARKERS_CLUSTERER_MAX_ZOOM_DESC']; ?></td>
    </tr>
</table>

<br />

<input type="submit" class="button" tabindex="211" name="submit" value="  <?php echo $app_strings['LBL_SAVE_BUTTON_LABEL']; ?>  " align="bottom">
&nbsp;
<input type="button" class="button" tabindex="212" name="cancel" value="  <?php echo $app_strings['LBL_CANCEL_BUTTON_LABEL']; ?>  " align="bottom"
        onclick="document.location.href='index.php?module=Administration&amp;action=index'" title="">

</form>

     
        <p style="margin: 25px 0px 15px 0px; font-size: 1em; width: 700px;">
            <?php echo $mod_strings['LBL_CONFIG_CUSTOM_CONTROLLER_DESC']; ?>
        </p>
        
        <p>&nbsp;</p>
        <br />
        
<pre>
<?php
//var_dump($sugar_config);
//var_dump($jjwg_config_defaults);
//var_dump($jjwg_config);
//var_dump($current_user);
//var_dump($mod_strings);
//var_dump($app_strings);
//var_dump($app_list_strings);
?>
</pre>

        <?php

    }

}
?>