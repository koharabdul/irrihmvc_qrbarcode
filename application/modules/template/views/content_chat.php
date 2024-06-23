<?php 
    foreach ($chats as $c) {
        $sessionuser = $this->session->userdata('nm_lengkap');
        if($c->nm_lengkap==$sessionuser){
            $bagian = 'right';
            $class = 'active';
        }
        else{
            $bagian = 'left';
            $class = '';
        }
        
        echo"<div class='".$bagian."'>
                <div class='author-name'>
                    ".$c->nm_lengkap."<small class='chat-date'>
                    10:02 am
                </small>
                </div>
                <div class='chat-message ".$class."'>
                    ".$c->content."
                </div>

            </div>";    
    }   

 ?>    


                


