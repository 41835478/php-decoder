<?php

$info = <<<EOT
***************************************************************
����ǰ�����б���,��ʹ�ô˳�����ɵ����ݶ�ʧ,���߲��е��κ�����.
����ɱ���������,��������,����ȫ���������ж�,�������.
����:Y.L. QQ:270656184
***************************************************************

������һ���ļ����ļ���·��:
EOT;

if($argc < 2){
	echo $info;
	$file = trim(fgets(STDIN));
}else{
	$file = $argv[1];
}

exec_script($file);
echo "����!";

function exec_script($file){
	echo "{$file}\r\n";
	if(is_dir($file)){
		$path = $file;
		//��Ŀ¼�Ļ�,����
		$dir = dir($path);
		while( $file=$dir->read() ){
			if($file=='.'||$file=='..')continue;
			exec_script($path.'\\'.$file);
		}
		return;
	}elseif(is_file($file)){
		//���ļ��Ļ�,ʲôҲ����
	}else{
		echo "�������? ·��������ȷû��?\r\n����һ�ΰ�!\r\n";
		return;
	}
	
	$result_file = dirname(__FILE__).'/eval_log.txt';
	$bak_file = $file.'.xz.decode.bak';
	@unlink($result_file);
	
	$file = realpath($file);
	exec('php.exe '.escapeshellarg($file));
	
	if(file_exists($result_file)){
		rename($file,$bak_file);
		$content = file_get_contents($result_file);
		$content = explode("\r\n----------------------------------\r\n\r\n",$content);
		$content = array_pop($content);
		if(preg_match('/^\s*\?>(.+)(<\?)?\s*$/s',$content,$match))
			$content = $match[1];
		else
			$content = "<?php\r\n".$content."\r\n?>";
		file_put_contents($file,$content);
		unlink($result_file);
	}
}
