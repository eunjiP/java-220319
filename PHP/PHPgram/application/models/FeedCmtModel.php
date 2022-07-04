<?php
    namespace application\models;
    use PDO;
    
    class FeedCmtModel extends Model {

        public function insFeedCmt(&$param) {
            $sql = "INSERT INTO t_feed_cmt
                (ifeed, iuser, cmt)
                VALUES
                (:ifeed, :iuser, :cmt)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":ifeed", $param['ifeed']);
            $stmt->bindValue(":iuser", getIuser());
            $stmt->bindValue(":cmt", $param['cmt']);
            $stmt->execute();
            return intval($this->pdo->lastInsertId());
        } 

        //--------------------- Cmt -------------------------------//
        public function selFeedCmt(&$param) {
            $sql = "SELECT G.*, COUNT(G.icmt)-1 AS ismore
                FROM (
                SELECT B.iuser, B.nm AS writer, B.mainimg AS writerimg, A.icmt,A.cmt, A.ifeed, A.regdt 
                FROM t_feed_cmt A
                INNER JOIN t_user B
                ON A.iuser = B.iuser
                WHERE A.ifeed = :ifeed
                ORDER BY icmt DESC
                LIMIT 2
                ) G
                GROUP BY G.ifeed";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":ifeed", $param['ifeed']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }