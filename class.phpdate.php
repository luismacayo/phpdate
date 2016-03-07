<?php


	date_default_timezone_set('America/Caracas');
	
	define('HOUR_DAY',24);
	define('DAY_WEEK',7);
	define('FIRST_DAY',1); //0 DOMINGOS 1 LUNES
	define('DAY_YEAR',360);
	define('MINUTE_HOUR',60);
	define('SECOND_MINUTE',60);

class Fecha {

	
	public function __construct(){
		$this->day_name = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
		$this->month_name = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	}
	
	public function fecha($time = null){
		$time = ($time)? $time : time();
		$fecha = getdate($time);
	return $fecha['mday'].'/'.$fecha['mon'].'/'.$fecha['year'];
	}
	
	public function getDate($time = null){
		$time = ($time)? $time : time();
	return date('Y-m-d',$time);
	}
	
	private function getTime($time = null){
		$time = ($time)? $time : time();
	return date('g:i:s a',$time);
	}
	
	/*
	returns a value that match with mysql datetime type cell
	*/
	public function dateTime($time = null){
		$time = ($time)? $time : time();
	return date('Y-m-d H:i:s',$time);
	}
	
	/*
	fecha amigable
	*/
	public function dateFriendly($time){
		$time = ($time)? $time : time();
		$dia_semana = $this->day_name[$this->getWeekDay($time)];
		$mes = $this->month_name[$this->getMonth($time)];
		$dia_mes = $this->getDay($time);
		$year = $this->getYear($time);
	return "{$dia_semana}, {$dia_mes} de {$mes} de {$year}";
	}
	
	/*
	fecha y hora amigable
	*/
	public function datetimeFriendly($time = null){
		$time = ($time)? $time : time();
		$dia_semana = $this->day_name[$this->getWeekDay($time)];
		$mes = $this->month_name[$this->getMonth($time)];
		$dia_mes = $this->getDay($time);
		$year = $this->getYear($time);
		$hora = $this->getTime($time);
	return "{$dia_semana}, {$dia_mes} de {$mes} de {$year} a las {$hora}";
	}
	
	public function getDay($time){
		$time = ($time)? $time : time();
		$dia = getdate($time);
	return $dia['mday']; /* 0-6*/
	}	
	
	public function getHour(){
	return (int)date('H'); /*formato de 24 horas*/
	}
	
	public function getMinute(){
	return (int)date('i'); /*00-59*/
	}
	
	public function getWeekDay($time = null){
		$time = ($time)? $time : time();
		$dia = getdate($time);
	return $dia['wday'];
	}
	
	public function getMonth($time = null){
		$time = ($time)? $time : time();
		$mes = getdate($time);
	return $mes['mon'];
	}
	
	public function getYear($time){
		$time = ($time)? $time : time();
		$año = getdate($time);
	return $año['year'];
	}
	
	public function pastTime($elapsed){
		return ($elapsed <= time())? true : false;
	}
	
	public function inTimeSec($intervalo){
		return time()+$intervalo;
	}
	
	public function inTimeMin($intervalo){
		return $this->inTimeSec($intervalo*SECOND_MINUTE);
	}
	
	public function inTimeHour($intervalo){
		return $this->inTimeMin($intervalo*MINUTE_HOUR);
	}
	
	public function inTimeDay($intervalo){
		return $this->inTimeHour($intervalo*HOUR_DAY);
	}
	
	public function inTimeWeek($intervalo){
		return $this->inTimeDay($intervalo*DAY_WEEK);
	}
	
	public function chekTime($min){
		return (time() > $this->inTimeMin($min))? true : false;
	}
	
}/*fin de clase*/



?>
