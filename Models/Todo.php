<?php

// require_once('config/dbconnect.php');
require_once 'config/dbconnect.php';

class Todo
{
    private $table = 'tasks';
    private $db_manager;

    public function __construct()
    {
        $this->db_manager = new DbManager();
        $this->db_manager->connect();
    }

    public function create($name)
    {
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO '.$this->table.' (name) VALUES (?)');
        $stmt->execute([$name]);
    }

    //一覧を呼び出すためのメソッド
    public function all()
    {
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM '.$this->table);
        $stmt->execute();
        $tasks = $stmt->fetchAll();

        return $tasks;
    }

    //editするためのデータを取得
    public function get($id)
    {
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM '.$this->table.' WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch();

        return $task;
    }

    public function update($name, $id)
    {
        // $stmt = $this->db_manager->dbh->prepare('UPDATE '.$this->table.' SET name = ? WHERE id = ?');
        // $stmt->execute([$name, $id]);
        $stmt = $this->db_manager->dbh->prepare('UPDATE '.$this->table.' SET name = ? , updated_at = ? WHERE id = ?');
        // updated_at の時間も更新する。更新した時間を取得する。
        $updated = date('Y-m-d H:i:s', time());
        $stmt->execute([$name, $updated, $id]);
    }

    //削除するためのメソッド
    public function delete($id)
    {
        $stmt = $this->db_manager->dbh->prepare('DELETE FROM '.$this->table.' WHERE id = ?');
        $stmt->execute([$id]);
    }
}
