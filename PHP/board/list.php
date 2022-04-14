<?php
    include_once "db.php";

    $conn = get_conn();
    $sql = "SELECT i_board, title, create_at FROM t_board ORDER BY i_board DESC";
    $result = mysqli_query($conn, $sql);
    //mysqli_query(연결 함수, 내가 실행하고 싶은 쿼리문)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리스트</title>
</head>
<body>
    <h1>리스트</h1>
    <a href="write.php"><button>글쓰기</button></a>
    <table>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성일시</th>
        </tr>
        <?php
            while($row = mysqli_fetch_assoc($result)) //mysqli_fetch_assoc :$result에서 한줄씩 들고온다
            {
                $i_board = $row['i_board'];
                $title = $row['title'];
                $create_at = $row['create_at'];
                print "<tr>";
                print "<td>${i_board}</td>";
                print "<td><a href='detail.php?i_board=${i_board}'>${title}</a></td>";
                print "<td>${create_at}</td>";
                print "</tr>";
            }
            mysqli_close($conn);
        ?>
    </table>
</body>
</html>

<!-- 
    form태그에 method="post"하면 post

    나머지는 method="get"방식
    '?'로 시작하고, '키=value' 형식으로 표시 =>쿼리스트링 
   
    post방식으로 보내면 i_board=10만 post방식으로 전달(주소창에 효시)되고 나머지는 바디에 담아서 전송
    get방식은 주소창에 키값 value값이 같이 담겨서 전송(주소창에 보인다-보안에 안좋다)
-->