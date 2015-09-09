<?php

/**
 * @Project NUKEVIET 3.4
 * @Author hongoctrien (01692777913@yahoo.com)
 * @Copyright (C) 2012 by hongoctrien
 * @Createdate July 05, 2012 10:47:41 AM
 */

if( ! defined( 'NV_IS_MOD_WATER' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
global $global_config;

$xtpl = new XTemplate( "print.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );

$xtpl->assign( 'PAGE_URL', $global_config['my_domains']);

$contents = "";

$maso = $nv_Request->get_title ('maso', 'post/get','');
$pr = $nv_Request->get_title ('pr', 'post/get','');
if (isset($maso) && !empty($maso))
{
    $maso1 = stripUnicode(chuthuong($maso));
    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '';
	
	$result = $db->query( $sql );
    $found = 0;
    
     while ( $item = $result->fetch() )
    {
		//die('2');
        if($maso1 == stripUnicode(chuthuong($item['mkh']))        
        OR $maso1 == stripUnicode(chuthuong($item['hoten']))
        OR $maso1 == stripUnicode(chuthuong($item['addnew']))
        OR $maso1 == stripUnicode(chuthuong($item['mont'])))
        {
            $found ++;
            $data[] = array (
                 "mkh" => $item['mkh'],
                 "hoten" => $item['hoten'],
                 "addold" => $item['addold'],
                 "addnew" => $item['addnew'],
                 "mobile" => $item['mobile'],
                 "mont" => $item['mont'],
                 "numlast" => $item['numlast'],
                 "timelast" => $item['timelast'],
                 "status" => $item['status'],
                 
                 "nummont" => $item['nummont'],
                 "flow" => $item['flow'],
                 "price" => $item['price'],
				"totalmont" => $item['totalmont'],
                 "debt" => $item['debt'],
                 "total" => $item['total']);
         }
    }
    
    //Hien thi ket qua tim dc
    if(!empty($data) && $maso!="")
    {
        foreach ($data as $row)
        {
            $xtpl->assign( 'TABLE', $row );
            $xtpl->parse( 'main.loop' );
			$xtpl->assign( 'PAGE__TITLE', $lang_module['f1'] . $row['hoten'] ." (".$row['mkh'].")");
        }
        $notice="";
        if($pr == 'lop')
        {
            $notice = $lang_module['ht_lop'] . $maso;
        }
        
        if($pr == 'phong')
        {
            $notice = $lang_module['ht_phong'] . $maso;
        }
                  
        //Tieu de thong bao
        $xtpl->assign( 'NOTICE', $notice);
    }
}

$xtpl->parse( 'main' );
$contents .= $xtpl->text( 'main' );


include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );


?>