<?php
namespace Phppot;

class PasswordReset
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }

    public function insert($memberId, $token)
    {
        $query = 'INSERT INTO tbl_password_reset (member_id, password_recovery_token) VALUES (?, ?)';
        $paramType = 'ss';
        $time = date('Y-m-d H:i:s');

        $paramValue = array(
            $memberId,
            $token
        );
        $memberId = $this->ds->insert($query, $paramType, $paramValue);
    }

    public function getMemberForgotByResetToken($token)
    {
        $query = 'SELECT * FROM tbl_password_reset where password_recovery_token = ?';
        $paramType = 's';
        $paramValue = array(
            $token
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }
}
