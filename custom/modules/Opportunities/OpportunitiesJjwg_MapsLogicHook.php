<?php

// custom/modules/Opportunities/OpportunitiesJjwg_MapsLogicHook.php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

class OpportunitiesJjwg_MapsLogicHook {

    var $jjwg_Maps;
    function OpportunitiesJjwg_MapsLogicHook() {
        $this->jjwg_Maps = get_module_info('jjwg_Maps');
    }

    function updateGeocodeInfo(&$bean, $event, $arguments) {
        // before_save
        if ($this->jjwg_Maps->settings['logic_hooks_enabled']) {
            $this->jjwg_Maps->updateGeocodeInfo($bean);
        }
    }

    function updateRelatedProjectGeocodeInfo(&$bean, $event, $arguments) {
        // after_save
        if ($this->jjwg_Maps->settings['logic_hooks_enabled']) {
            // Find and Update the Related Projects - save() Triggers Logic Hooks
            require_once('modules/Project/Project.php');
            $projects = $bean->get_linked_beans('project', 'Project');
            foreach ($projects as $project) {
                $project->custom_fields->retrieve();
                $this->jjwg_Maps->updateGeocodeInfo($project, true);
                if ($project->jjwg_maps_address_c != $project->fetched_row['jjwg_maps_address_c']) {
                    $project->save(false);
                }
            }
        }
    }

    function updateRelatedMeetingsGeocodeInfo(&$bean, $event, $arguments) {
        // after_save
        if ($this->jjwg_Maps->settings['logic_hooks_enabled']) {
            $this->jjwg_Maps->updateRelatedMeetingsGeocodeInfo($bean);
        }
    }

    function addRelationship(&$bean, $event, $arguments) {
        // after_relationship_add
        $GLOBALS['log']->info(__METHOD__.' $arguments: '.print_r($arguments, true));
        // $arguments['module'], $arguments['related_module'], $arguments['id'] and $arguments['related_id'] 
        if ($this->jjwg_Maps->settings['logic_hooks_enabled']) {
            $focus = get_module_info($arguments['module']);
            if (!empty($arguments['id'])) {
                $focus->retrieve($arguments['id']);
                $focus->custom_fields->retrieve();
                $this->jjwg_Maps->updateGeocodeInfo($focus, true);
                if ($focus->jjwg_maps_address_c != $focus->fetched_row['jjwg_maps_address_c']) {
                    $focus->save(false);
                }
            }
        }
    }
    
    function deleteRelationship(&$bean, $event, $arguments) {
        // after_relationship_delete
        $GLOBALS['log']->info(__METHOD__.' $arguments: '.print_r($arguments, true));
        // $arguments['module'], $arguments['related_module'], $arguments['id'] and $arguments['related_id'] 
        if ($this->jjwg_Maps->settings['logic_hooks_enabled']) {
            $focus = get_module_info($arguments['module']);
            if (!empty($arguments['id'])) {
                $focus->retrieve($arguments['id']);
                $focus->custom_fields->retrieve();
                $this->jjwg_Maps->updateGeocodeInfo($focus, true);
                if ($focus->jjwg_maps_address_c != $focus->fetched_row['jjwg_maps_address_c']) {
                    $focus->save(false);
                }
            }
        }
    }
    
}
