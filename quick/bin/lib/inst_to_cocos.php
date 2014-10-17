<?php

require_once(__DIR__ . '/quick/QuickInstaller.php');

function check_cocos_ver()
{
	$cocos_path = $_ENV['COCOS_CONSOLE_ROOT'];
	if (!$cocos_path) 
	{
		return;
	}

	$pos = strpos($cocos_path, '/tools/cocos2d-console/bin');
	if ($pos != false)
	{
		$cocos_path = substr($cocos_path, 0, $pos);
	}
	else
	{
		return;
	}

	if (is_dir($cocos_path . '/external/lua/quick')) 
	{
		return $cocos_path;
	}
}

// ----

$cocos_root_path = check_cocos_ver();
if (!$cocos_root_path)
{
	echo "Coscos root path not found!!!!!\n\n";
	return -1;
}
echo  "Found cocos root path: $cocos_root_path\n";

$quick_root_path = $_ENV['QUICK_V3_ROOT'];
if (!$quick_root_path)
{
	echo "Please setup Quick-cocos-x before install it to cocos2dx.\n\n";
	return -1;
}

$installer = new QuickInstaller($quick_root_path, $cocos_root_path);

$retval = $installer->run();

echo "install return value: $retval\n";
return($retval);
