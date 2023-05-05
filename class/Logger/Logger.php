<?php

namespace Logger;

class Logger
{
    public function generateLoginForm(string $username=null, $error=null): void{
        if (isset($response['error'])): ?>
            <div class="error">
                <?php echo $error ?>
            </div>
        <?php endif; ?>
        <form method="post" action="" class="login" id="login-form">
            <legend class="legend">Login</legend>
            <legend class="legend" id="admin">(Only for administrators)</legend>
            <div class="form-group">
                <input class="form" type="text" name="username" placeholder="Username" value="<?php echo $username ?>" autofocus>
                <input class="form" id="formD" type="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="submit">LOGIN</button>
        </form>
        <?php
    }

    public function log(string $username, string $password) : array{

        $user = "admin" ;
        $pwd = "coobook" ;

        $error = null ;
        $granted = false ;
        if (empty($username)){
            $error = "Username is Empty" ;
        }elseif (empty($password)){
            $error = "Password is Empty" ;
        }elseif ($user == $username and $pwd == $password){
            $granted = true ;
        }else{
            $error = "Authentication Failed" ;
        }
        return array(
            'granted' => $granted,
            'error' => $error
        ) ;

    }

}