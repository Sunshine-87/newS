<?php
class Controller
{
	private $background = ['background/header.php','background/navbar.html','background/tarbar.html'];

	private $deny = [
	'personal.php' => ['background/navbar.html'],
	'detail/qiubangzhu.php' => ['background/navbar.html'],
	'detail/xiaojishi.php' => ['background/navbar.html']
	];

	function display($tpl = '', $data=array()) {
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$$key = $value;
			}
		}

		if (array_key_exists($tpl, $this->deny)) {
			$newBack = array_diff($this->background, $this->deny[$tpl]);
			if (!empty($newBack)) {
				if (isset($newBack[2])) {
					$newBack[3] = 'background/tarbar.html';
					$newBack[2] = $tpl;
					foreach ($newBack as $back) {
						require TPL.$back;
					}
				} else {
					foreach ($newBack as $back) {
						require TPL.$back;
					}
					require TPL.$tpl;
				}
			} else {
				require TPL.$tpl;
			}
		} else {
			$newBack = $this->background;
			$newBack[3] = 'background/tarbar.html';
			$newBack[2] = $tpl;
			foreach ($newBack as $back) {
				require TPL.$back;
			}
		}
	}
}
?>