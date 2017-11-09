<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 09/11/2017
 * Time: 09:47 AM
 */

namespace Greenter\Sunat\Service;

/**
 * Class UserValidator
 * @package Greenter\Sunat\Service
 */
class UserValidator
{
    /**
     * Validate login input.
     *
     * @param array $params
     * @return array
     */
    public function login(array $params)
    {
        if (!$this->validFields($params, ['email', 'password'])) {
            return $this->withMessage('información incompleta');
        }
        if (filter_var($params['email'], FILTER_VALIDATE_EMAIL) == false) {
            return $this->withMessage('email inválido');
        }

        return ['success' => true];
    }

    /**
     * Validate register input.
     *
     * @param array $params
     * @return array
     */
    public function register(array $params)
    {
        if (!$this->validFields($params, ['email', 'password', 'repeat_password'])) {
            return $this->withMessage('información incompleta');
        }

        if (filter_var($params['email'], FILTER_VALIDATE_EMAIL) == false) {
            return $this->withMessage('email inválido');
        }

        if ($params['password'] != $params['repeat_password']) {
            return $this->withMessage('contraseñas no coinciden');
        }

        return ['success' => true];
    }

    private function withMessage($message)
    {
        return [
            'success' => false,
            'message' => $message
        ];
    }

    /**
     * @param array $arr
     * @param array $params
     * @return bool
     */
    public function validFields($arr, $params)
    {
        foreach ($params as $param) {
            if (!isset($arr[$param]) || empty($arr[$param])) {
                return false;
            }
        }

        return true;
    }
}