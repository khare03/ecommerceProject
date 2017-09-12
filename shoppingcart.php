<?php

class usershoppingcart {

     public $items = array();

    //Logout
    public function userLogOut()
    {
        destroySession("shppoingcart");
    }

    public function addToCart($id,$q){
        $max = count($this->items);
        $this->items[$max]['qty'] = $q;
        $this->items[$max]['id'] = $id;
}
}
?>