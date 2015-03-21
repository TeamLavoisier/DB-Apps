<?php

namespace ANSR\Adapters;

/**
 * @author Ivan Yonkov <ivanynkv@gmail.com>
 */
class NoAdapter extends Database {

    protected $_result;
    protected $_content = array();

    public function connect() {

    }

    public function query($query) {
        return [];
    }

}

