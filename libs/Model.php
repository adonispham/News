<?php

namespace Framework;

class Model extends DB
{
    const SLOW_LOG = 0.5;
    public $dataList = [];
    protected $connect;
    protected $table = '';
    protected $fillable = '';

    public function __construct()
    {
        $this->connect = $this->connect();
        $this->table = $this->getNameTable();
    }

    public function getNameTable()
    {
        $result = '';

        if ($this->table == '') {
            $result = str_replace('_model', '', get_class($this));
        } else {
            $result = $this->table;
        }

        return $result;
    }

    public function save($data)
    {
        //Lưu danh sách field
        $fieldList = '';
        //Lưu giá trị tương ứng với field
        $valueList = '';

        foreach ($data as $key => $value) {
            $fieldList .= ",$key";
            //mysqli_real_escape_string: Chống SQL Injection - Loại bỏ các ký tự đặc biệt khi được truyền lên
            $valueList .= ",'" . $this->connect->real_escape_string($value) . "'";
        }

        $sql = "INSERT INTO " . $this->table . "(" . trim($fieldList, ',') . ") VALUES (" . trim($valueList, ',') . ")";

        return $this->_query($sql);
    }

    private function _query($sql)
    {
        //run query
        $result = mysqli_query($this->connect, $sql);

        return $result;
    }

    public function update($data, $where)
    {
        $val = '';

        foreach ($data as $key => $value) {
            $val .= "$key = '" . $this->connect->real_escape_string($value) . "',";
        }

        // Sau vòng lặp biến $val sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'UPDATE ' . $this->table . ' SET ' . trim($val, ',') . ' WHERE id = ' . $where;

        return $this->_query($sql);
    }

    public function destroy($id)
    {
        // Delete
        $sql = "DELETE FROM $this->table WHERE id = $id";

        return $this->_query($sql);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $data = [];

        // $row = mysqli_fetch_assoc($result);
        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getAllPost($search)
    {
        $keysearch = empty(trim($search)) ? "" : $search;
        if (!empty($keysearch)) {
            // have key searching
            $sql = "SELECT * FROM $this->table WHERE content LIKE '%$keysearch%' OR sort_description LIKE '%$keysearch%' OR title LIKE '%$keysearch%'";
        } else {
            $sql = "SELECT * FROM $this->table";
        }

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $data = [];

        // $row = mysqli_fetch_assoc($result);
        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getAllWithPaginate($offset = 0, $search)
    {
        $keysearch = empty(trim($search)) ? "" : $search;
        if (!empty($keysearch)) {
            // have key searching
            $sql = "SELECT * FROM $this->table WHERE content LIKE '%$keysearch%' OR sort_description LIKE '%$keysearch%' OR title LIKE '%$keysearch%' ORDER BY updated_at DESC LIMIT {$offset}, 3";
        } else {
            // none key searching
            $sql = "SELECT * FROM $this->table ORDER BY updated_at DESC LIMIT {$offset}, 3";
        }
        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $data = [];

        // $row = mysqli_fetch_assoc($result);
        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function getAllPostByCategoryAndPaginate($categoryId, $offset = 0)
    {
        $sql = "SELECT * FROM posts WHERE category_id = {$categoryId} ORDER BY updated_at DESC LIMIT {$offset}, 3";

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $data = [];

        // $row = mysqli_fetch_assoc($result);
        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $row = mysqli_fetch_assoc($result);

        if ($row) {
            return $row;
        }

        return false;
    }

    public function findByLogin($login)
    {
        $sql = "SELECT * FROM $this->table WHERE username  = '{$login['username']}' AND password = '{$login['password']}'";

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $row = mysqli_fetch_assoc($result);

        if ($row) {
            return $row;
        }

        return false;
    }

    public function haveUserInUsers($username)
    {
        $sql = "SELECT * FROM $this->table WHERE username  = '{$username}'";

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $row = mysqli_num_rows($result);

        if ($row) {
            return false;
        }
        return true;
    }

    public function havePostInCategory($categoryId)
    {
        $sql = "SELECT * FROM $this->table WHERE category_id  = '{$categoryId}'";

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $row = mysqli_fetch_assoc($result);

        if ($row) {
            return true;
        }
        return false;
    }

    public function getCommentByPost($postId)
    {
        $sql = "SELECT * FROM $this->table WHERE post_id  = '{$postId}' ORDER BY created_at ASC";

        $result = $this->_query($sql);

        if (!$result) {
            die ('Query Error !!!');
        }

        $data = [];

        // $row = mysqli_fetch_assoc($result);
        // Lặp qua kết quả để đưa vào mảng
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }
}
