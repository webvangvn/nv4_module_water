<?php

/**
 * @Project NUKEVIET 3.4
 * @Author hongoctrien (01692777913@yahoo.com)
 * @Update to 4.x webvang (hoang.nguyen@webvang.vn)
 * @Copyright (C) 2012 by hongoctrien
 * @Createdate July 05, 2012 10:47:41 AM
 */

if( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();

$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "`";

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . " (
    mkh varchar(15) NOT NULL,
    hoten varchar(100) NOT NULL,
    addold varchar(255) NOT NULL,
    addnew varchar(255) NOT NULL,
    mobile varchar(15) NOT NULL,
	mont int(2) NOT NULL DEFAULT 1,
    numlast int(11) NOT NULL DEFAULT 0,
	timelast varchar(50) NOT NULL,
    status varchar(255) NOT NULL,
	nummont int(11) NOT NULL DEFAULT 0,
	flow int(11) NOT NULL DEFAULT 0,
	price int(11) NOT NULL DEFAULT 0,
	totalmont int(11) NOT NULL DEFAULT 0,
	debt int(11) NOT NULL DEFAULT 0,
	total int(11) NOT NULL DEFAULT 0,
    primary key (`mkh`)
) ENGINE=MyISAM";
