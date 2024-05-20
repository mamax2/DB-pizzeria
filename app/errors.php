<?php

/**
 * Restituisce l'output delle Eccezioni non gestite
 *
 * @param \Throwable $e Eccezione richiamata
 *
 * @return void
 */
function log_exception(\Throwable $e)
{

    $message = [
        'type'    => get_class($e),
        'message' => $e->getMessage(),
        'file'    => $e->getFile(),
        'line'    => $e->getLine()
    ];
    http_response_code(500);
    echo (json_encode(['message' => $e->getMessage(), 'body' => $message]));
    die();
}

/**
 * Trasforma un errore in una eccezione da passare alla funzione di logging
 * @param  int $num gravità dell'errore
 * @param  string $str messaggio d'errore
 * @param  string $file File di origine dell'errore
 * @param  int $line Linea d'errore
 *
 * @return bool
 */
function log_error($num, $str, $file, $line)
{
    log_exception(new \ErrorException($str, 500, $num, $file, $line));

    return true;
}

/**
 * Trasforma un errore FATALE in una eccezione da passare alla funzione di logging
 *
 * @return void
 */
function check_for_fatal()
{
    $error = error_get_last();
    if ($error != null) {
        if ($error['type'] == E_ERROR) {
            log_exception(new \ErrorException($error['message'], 500, $error['type'], $error['file'], $error['line']));
        }
    }
}

//Imposto le mie funzioni per mostrare gli errori
set_exception_handler('log_exception');
set_error_handler('log_error');
register_shutdown_function('check_for_fatal');

ini_set('display_errors', 'off');
error_reporting(E_ALL);
