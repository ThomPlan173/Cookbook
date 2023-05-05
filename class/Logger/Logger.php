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
            <legend style="text-align: center">Login</legend>
            <legend style ="text-align: center;color: red;font-size: 0.5em">(Only for administrators)</legend>
            <div class="form-group">
                <input type="text" name="username" placeholder="username" value="<?php echo $username ?>" autofocus>
                <input type="password" name="password" placeholder="password">
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
            $error = "username is empty" ;
        }elseif (empty($password)){
            $error = "password is empty" ;
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