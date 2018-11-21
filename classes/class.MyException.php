<?php

class MyException extends Exception {
    private $stacktrace;
    private $exceptionscope;
    private $maskarg;

    public function __construct($message, $e = false, $maskarg = false) {
        $this->maskarg = $maskarg;
        $this->exceptionscope = $this;
        if($e instanceof Exception) {
            $this->exceptionscope = $e;
        }

        parent::__construct($message);
        $this->setStackTrace($this->exceptionscope->getTrace());
    }

    public function getTime() {
        return date('Y-m-d H:i:s');
    }

    public function setStackTrace($stacktrace) {
        if(count($stacktrace) > 0) {
            $this->stacktrace = $stacktrace;
        }
    }

    public function getError($trace) {
        // On retourne un message d'erreur complet pour nos besoins.
        $return  = 'Une exception a été gérée :<br/>';
        $return .= '<strong>Message : ' . $this->getMessage() . '</strong><br/>';
        $return .= 'A la ligne : ' . $this->getLine() . '<br/>';
        $return .= 'Dans le fichier : ' . $this->getFile() . '<br/>';
        $return .= 'Il était : ' . $this->getTime();

        return $return;
    }
    public function getStackTrace() {
        $it = 0;
        $stacktracetxt = '#' . $it . ' ' . $this->exceptionscope->file . '(' . $this->exceptionscope->line . '): ' . $this->exceptionscope->message . "\r\n";
        $it++;
        foreach($this->stacktrace as $stack) {
        	$argss = '';
        	$sep = '';
			foreach($stack['args'] as $val){
				$argss .= $sep.print_r($val, true);
				$sep = '" ,"';
			}
            $args = $this->maskarg ? 'xxx' : $argss;
            $class = isset($stack['class']) ? $stack['class'] : '';
            $type = isset($stack['type']) ? $stack['type'] : '';
            $stacktracetxt .= '#' . $it . ' ' . $stack['file'] . '(' . $stack['line'] . '): ' . $class . $type . $stack['function'] . '("' . $args . '")' . "\r\n";
            $it++;
        }
        return $stacktracetxt;
    }
}


?>