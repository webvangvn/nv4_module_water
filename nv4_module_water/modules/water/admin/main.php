<?php

/**
 * @Project NUKEVIET 4.x
 * @Author hongoctrien (01692777913@yahoo.com)
 * @Update to 4.x webvang (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2012 by hongoctrien
 * @Createdate July 05, 2012 10:47:41 AM
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];

global $module_file, $lang_module, $module_info;

$xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'IMP_ACTION', NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "" );

$data = array();
function add( $mkh, $hoten, $addold, $addnew, $mobile, $mont, $numlast, $timelast, $status,  $nummont, $flow, $price, $totalmont, $debt, $total)
{
	global $data;
	$data[] = array(
        'mkh'=>trim($mkh),
        'hoten'=>trim($hoten),
        'addold'=>trim($addold),
        'addnew'=>trim($addnew),
        'mobile'=>trim($mobile), 
        'mont'=>$mont, 
        'numlast'=>$numlast, 
        'timelast'=>trim($timelast), 
        'status'=>trim($status),
        'nummont'=>$nummont,
        'flow'=>$flow,
        'price'=>$price,
		'totalmont'=>$totalmont,
        'debt'=>$debt,
        'total'=>$total);
}

if (isset($_FILES['file']['tmp_name']))
{
    $notice = "";
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName('Row');;
    $first_row = true;
    foreach ($rows as $row)
    {
        if( !$first_row)
        {
            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell )
            {
                $ind = $cell->getAttribute( 'Index' );
				if ( $ind != null ) $index = $ind;

				if ( $index == 1 ) $mkh = $cell->nodeValue;
				if ( $index == 2 ) $hoten = $cell->nodeValue;
				if ( $index == 3 ) $addold = $cell->nodeValue;
				if ( $index == 4 ) $addnew = $cell->nodeValue;
				if ( $index == 5 ) $mobile = $cell->nodeValue;
				if ( $index == 6 ) $mont = $cell->nodeValue;
				if ( $index == 7 ) $numlast = $cell->nodeValue;
				if ( $index == 8 ) $timelast = $cell->nodeValue;
				if ( $index == 9 ) $status = $cell->nodeValue;
				   
				if ( $index == 10 ) $nummont = $cell->nodeValue;
				if ( $index == 11 ) $flow = $cell->nodeValue;
				if ( $index == 12 ) $price = $cell->nodeValue;
				if ( $index == 13 ) $totalmont = $cell->nodeValue;
				if ( $index == 14 ) $debt = $cell->nodeValue;
				if ( $index == 15 ) $total = $cell->nodeValue;
				  
				$index += 1;
            }

            
            add( $mkh, $hoten, $addold, $addnew, $mobile, $mont, $numlast, $timelast, $status, $nummont, $flow, $price, $totalmont,  $debt, $total);
        }
        $first_row = false;
    }
}

foreach($data as $row)
{   
    /*
            if( ! empty( $row['mobile'] ) and preg_match( "/^([0-9]{1,2})\\/([0-9]{1,2})\/([0-9]{4})$/", $row['mobile'], $m ) )
            {
                $row['mobile1'] = mktime( 0, 0, 0, $m[2], $m[1], $m[3] );
            }
    */
    
//Neu gia tri khong phai la so thi gan mac dinh =0
if(!is_numeric($row['mont'])) $row['mont'] = 1;
if(!is_numeric($row['numlast'])) $row['numlast'] = 0;
if(!is_numeric($row['nummont'])) $row['nummont'] = 0;
if(!is_numeric($row['flow'])) $row['flow'] = 0;
if(!is_numeric($row['price'])) $row['price'] = 0;
if(!is_numeric($row['totalmont'])) $row['totalmont'] = 0;
if(!is_numeric($row['debt'])) $row['debt'] = 0;
if(!is_numeric($row['total'])) $row['total'] = 0;


$sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . " ( mkh, hoten, addold, addnew, mobile, mont, numlast, timelast, status, nummont, flow, price, totalmont, debt, total) VALUES (
				:mkh,
				:hoten,
				:addold,
				:addnew,
				:mobile,
				:mont,
				:numlast,
				:timelast,
				:status,
				:nummont,
				:flow,
				:price,
				:totalmont,
				:debt,
				:total
			)";

			$data_insert = array();

	$data_insert['mkh'] = $row['mkh'];
	$data_insert['hoten'] = $row['hoten'];
	$data_insert['addold'] = $row['addold'];
	$data_insert['addnew'] = $row['addnew'];
	$data_insert['mobile'] = $row['mobile'];
	$data_insert['mont'] = $row['mont'];
	$data_insert['numlast'] = $row['numlast'];
	$data_insert['timelast'] = $row['timelast'];
	$data_insert['status'] = $row['status'];
	$data_insert['nummont'] = $row['nummont'];
	$data_insert['flow'] = $row['flow'];
	$data_insert['price'] = $row['price'];
	$data_insert['totalmont'] = $row['totalmont'];
	$data_insert['debt'] = $row['debt'];
	$data_insert['total'] = $row['total'];



    if($db->insert_id( $sql, 'mkh', $data_insert ))
    {
        $notice = $lang_module['error_csdl'];
    }
    else
    {
        $notice = $lang_module['ok_csdl'];        
    }
$xtpl->assign( 'NOTICE', $notice );

}
$from=NV_PREFIXLANG . "_" . $module_data;
$where="";
$db->sqlreset()->select( 'COUNT(*)' )->from( $from )->where( $where );
$num_row = $db->query( $db->sql() )->fetchColumn();

$xtpl->assign( 'NUM_ROW', $num_row );



$del = $nv_Request->get_string('del', 'get','');

if($del == 'ok')
{
   $sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '';
	if( $db->exec( $sql ) )
	{
		header('Location:'.NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . ""); 
	}
}


$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

