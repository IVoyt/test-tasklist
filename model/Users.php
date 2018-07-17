<?php

    /**
     * Class Users
     */
    class Users extends DB {

        /**
         * @param $user
         *
         * @return string
         */
        public function getUserPass($user)
        {
            $query = mysqli_query($this->db, 'SELECT * FROM `users` WHERE `username` = "'.$user.'"');
            $result = '';
            foreach ($query as $item) {
                $result = $item;
            }
            return $result;
        }

    }