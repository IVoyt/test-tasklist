<?php

    /**
     * Class Tasks
     */
    class Tasks extends DB {

//  Get methods start
//-------------------
        /**
         * @param int $offset
         * @param int $limit
         *
         * @return array
         */
        public function getTasks($offset = 0)
        {
            $query = $this->db->query('SELECT * FROM `tasklist` LIMIT '.$offset.', 3');
            $result = [];
            foreach ($query as $item) {
                $result[] = $item;
            }
            return $result;
        }

        /**
         * @param        $order
         * @param string $direction
         *
         * @return array
         */
        public function getTasksOrderBy($order, $direction = 'ASC', $offset = 0)
        {
            $query = $this->db->query('SELECT * FROM `tasklist` ORDER BY `'.$order.'` '.$direction.' LIMIT '.$offset.', 3');
            $result = [];
            foreach ($query as $item) {
                $result[] = $item;
            }
            return $result;
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function getTaskById($id)
        {
            $query = $this->db->query('SELECT * FROM `tasklist` WHERE `id` = "'.$id.'"');
            foreach ($query as $item) {
                $result = $item;
            }
            return $result;
        }

        /**
         * @return integer
         */
        public function getTasksCount()
        {
            $query = $this->db->query('SELECT COUNT(`id`) FROM `tasklist`');
            foreach ($query as $item) {
                $result = $item;
            }
            $count = ceil($result['COUNT(`id`)'] / 3);
            return $count;
        }
//-------------------
//  Get methods end

        /**
         * @param $request
         * @param $file
         *
         * @return bool
         */
        public function addTask($username, $email, $content, $img)
        {
            if (!$this->insert('tasklist', ['username' => $username, 'email' => $email, 'content' => $content, 'img' => $img])) {
                return false;
            }

            return true;
        }

        /**
         * @param $id
         * @param $content
         * @param $status
         *
         * @return bool
         */
        public function updateTask($id, $content, $status)
        {
            if (!$this->update('tasklist', ['content' => $content, 'status' => $status], ['id' => $id])) {
                return false;
            }

            return true;
        }

        /**
         * @param $request
         *
         * @return bool
         */
        public function deleteTask($id)
        {
            if (!$this->delete('tasklist', ['id' => $id])) {
                return false;
            }

            return true;
        }

    }