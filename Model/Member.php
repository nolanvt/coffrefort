<?php
namespace Phppot;

class Member
{

    private $ds;

    private $applicationUrl = 'http://localhost/coffrefort/coffrefort/coffrefort/';

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }

    /**
     * to get member record by username
     *
     * @param string $username
     * @return array
     */
    public function getMember($username)
    {
        $query = 'SELECT * FROM tbl_member where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    /**
     * main function that handles the forgot password
     *
     * @return string[]
     */
    public function handleForgot()
    {
        if (! empty($_POST["username"])) {
            $memberRecord = $this->getMember($_POST["username"]);
            require_once __DIR__ . "/PasswordReset.php";
            $passwordReset = new PasswordReset();
            $token = $this->getRandomString(97);
            if (! empty($memberRecord)) {
                $passwordReset->insert($memberRecord[0]['id'], $token);
                $this->sendResetPasswordEmail($memberRecord, $token);
            } else {
                // the input username is invalid
                // do not display a message saying 'username as invalid'
                // that is a security issue. Instead,
                // sleep for 2 seconds to mimic email sending duration
                sleep(2);
            }
        }
        // whatever be the case, show the same message for security purposes
        $displayMessage = array(
            "status" => "success",
            "message" => "Check your email to reset password."
        );
        return $displayMessage;
    }

    /**
     * to send password recovery email
     * you may substitute this code with SMTP based email
     * Refer https://phppot.com/php/send-email-in-php-using-gmail-smtp/ to send smtp
     * based email
     *
     * @param array $memberListAry
     * @param string $token
     */
    public function sendResetPasswordEmail($memberListAry, $token)
    {
        $resetUrl = '<a href="' . $this->applicationUrl . 'reset-password.php?token=' . $token ;
        $emailBody = 'Hi,To reset your password, click this link ' . $resetUrl;
        $to = $memberListAry[0]["email"];
        $subject = 'Reset password';
        mail($to, $subject, $emailBody);
        echo "email send";
    }

    public function updatePassword($id, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = 'UPDATE tbl_member SET password = ? WHERE id = ?';
        $paramType = 'si';
        $paramValue = array(
            $hashedPassword,
            $id
        );
        $this->ds->execute($query, $paramType, $paramValue);

        $displayMessage = array(
            "status" => "success",
            "message" => "Password reset successfully."
        );
        return $displayMessage;
    }

    /**
     *
     * @param int $length
     * @param string $keyspace
     * @throws \RangeException
     * @return string
     */
    function getRandomString(int $length = 64, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++ $i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

}