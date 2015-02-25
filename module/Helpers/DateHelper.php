<?php

namespace Helpers;

class DateHelper {

	public function getDateActual()
	{
		return date("Y-m-d");
	}

	public function dateUsToBr($date)
	{
		list($ano, $mes, $dia) = explode("-", $date);
		return "{$dia}/{$mes}/{$ano}";
	}

}

?>