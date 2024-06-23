if($fstaus=="Mamah"){
    $mom = 1 + $mom;
    $chi = $flink;
    if($mom==1){
        $momi = "Mamah ".$chi;
    }
    else if($mom==2){
        if(substr($momi,0,11)=="Mamah Level"){
            $momi = "Mamah Level 2 ".substr($momi,14)." ".$flink;
        }
        else{
            $momi = "Mamah Level 2 ".substr($momi,6)." ".$flink;
        }
    }
    else if($mom==3){
        if(substr($momi,0,11)=="Mamah Level"){
            $momi = "Mamah Level 3 ".substr($momi,14)." ".$flink;
        }
        else{
            $momi = "Mamah Level 3 ".substr($momi,6)." ".$flink;
        }
    }
    else if($mom==4){
        if(substr($momi,0,11)=="Mamah Level"){
            $momi = "Mamah Level 4 ".substr($momi,14)." ".$flink;
        }
        else{
            $momi = "Mamah Level 4 ".substr($momi,6)." ".$flink;
        }
    }
    else if($mom==5){
        if(substr($momi,0,11)=="Mamah Level"){
            $momi = "Mamah Level 5 ".substr($momi,14)." ".$flink;
        }
        else{
            $momi = "Mamah Level 5 ".substr($momi,6)." ".$flink;
        }
    }
}



// if($fstaus=="Mamah"){
//     $this->Userviews_m->insert($fno,$fname,$fstaus,$flink,$ficon,$status_no);
// }
// else if(($fstaus=="Anak")and(substr($son, 0,4)!="Anak")){
//     if($mom!=0){
//         $this->Userviews_m->insert($fno,$fname,$fstaus.' '.$chi,$flink,$ficon,$status_no);
//     }
//     else{
//         $this->Userviews_m->insert($fno,$fname,$fstaus,$flink,$ficon,$status_no);
//     }
// }
// else if(substr($fstaus, 0,4)=="Ayah"){
//     $this->Userviews_m->insert($fno,$fname,$fstaus.' '.$chi,$flink,$ficon,$status_no);
// }
// else{
//     $this->Userviews_m->insert($fno,$fname,$son,$flink,$ficon,$status_no);
// }
