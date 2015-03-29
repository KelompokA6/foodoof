<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package        CodeIgniter
* @author        Rick Ellis
* @copyright    Copyright (c) 2006, EllisLab, Inc.
* @license        http://www.codeignitor.com/user_guide/license.html
* @link        http://www.codeigniter.com
* @since        Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* MY Parser Class
*
* Added a feature so when a template is passed, if all the variable
* replacement tags are not replaced they are removed from the
* returned output. Thus making the returned string cleaner.
*
* @package        CodeIgniter
* @subpackage    Libraries
* @category        Parser
* @author            Adam Price
*/

class My_Parser extends CI_Parser{
    
    // --------------------------------------------------------------------
    
    /**
     *  Parse conditional statments
     * Note: This function will ignore no matched or conditional statments with errors
     *
     * @access    public
     * @param    string
     * @param    bool
     * @return    string
     */
    function conditionals($template, $data, $show_errors) {
    
        if (preg_match_all('#'.$this->l_delim.'if (.+)'.$this->r_delim.'(.+)'.$this->l_delim.'/if'.$this->r_delim.'#sU', $template, $conditionals, PREG_SET_ORDER)) {
                    
            if(count($conditionals) > 0) {
            
                foreach($conditionals AS $condition) {
                
                    $raw_code = (isset($condition[0])) ? $condition[0] : FALSE;
                    $cond_str = (isset($condition[1])) ? $condition[1] : FALSE;
                    $insert = (isset($condition[2])) ? $condition[2] : '';
                    
                    if(!preg_match('/('.$this->l_delim.'|'.$this->r_delim.')/', $cond_str, $problem_cond)) {
                        // If the the conditional statment is formated right, lets procoess it!
                        if(!empty($raw_code) OR $cond_str != FALSE OR !empty($insert)) {
                            // Get the two values
                            $cond = preg_split("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str);
                            
                            // Do we have a valid if statment?
                            if(count($cond) == 2) {
                               
                                // Get condition
                                preg_match("/(\!=|==|<=|>=|<>|<|>|AND|XOR|OR|&&)/", $cond_str, $cond_m);
                                array_push($cond, $cond_m[0]);
                                
                                // Remove quotes - they cause to many problems!                            
                                $cond[0] = preg_replace("/[^a-zA-Z0-9s]/", "", $cond[0]);    
                                $cond[1] = preg_replace("/[^a-zA-Z0-9s]/", "", $cond[1]);    
                                
                                // Test condition                            
                                eval("\$result = (\"".$cond[0]."\" ".$cond[2]." \"".$cond[1]."\") ? TRUE : FALSE;");
                            
                            } else {
                            
                            	// Looks like a if 'variable' conditional, let's make sure the variable is set
                            	
                                if (isset($data->$cond_str)) {
                                	// Check the variable isn't empty...
                                	if (!empty($data->$cond_str)) {
                                		// This adds support for using {if var}then this{/if}
                                		$result = TRUE;
                                	} else {
                                   		$result = FALSE;
                                	}
                                } else {
                                	$result = FALSE;
                                }
                                
                                //$result = (isset($data->$cond_str)) ? TRUE : FALSE;
                            
                            }
                        }
                        
                        // If the condition is TRUE then show the text block
                        $insert = preg_split('#'.$this->l_delim.'else'.$this->r_delim.'#sU', $insert);
                        if($result == TRUE)
                        {
                            $template = str_replace($raw_code, $insert[0], $template);
                        } else {
                            // Do we have an else statment?
                            if(is_array($insert))
                            {
                                $insert = (isset($insert[1])) ? $insert[1] : '';
                                $template = str_replace($raw_code, $insert, $template);    
                            } else {
                                $template = str_replace($raw_code, '', $template);        
                            }
                        }
                    } elseif(!$show_errors) {
                        // Remove any if statments we can't process
                        $template = str_replace($raw_code, '', $template);            
                    }
                     
                }
                  
            }
        }
        return $template;    
    }
    
    // --------------------------------------------------------------------
}