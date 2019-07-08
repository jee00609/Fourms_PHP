<!DOCTYPE html>
<html>
<style>
    body {
        background-image: url('space.jpg');
        margin-left: auto;
        margin-right: auto;
    }

    table {
        margin-left: auto;
        margin-right: auto;
    }

    form {
        margin: 0 auto;
        width: 250px;
    }
</style>

<body>
    <form>
        <h1 style="color:white;">Read</h1>
    </form>
    <hr>
    <table width=800 height=200>
        <?php
        $num = $_GET['num'];

        $link = mysql_connect("localhost", "kimmije1009", "mskimmije1009M") or die("DB connection failed!");
        mysql_select_db("kimmije1009", $link) or die ("DB selection failed!");

        //$query = "update board set search = search + 1 where id = '$num'";
        $res = mysql_query("update board set search = search + 1 where id = '$num'", $link); //??????

        //$query = "select title, name, ip, date, contents from board where id = '$num'";
        $res = mysql_query("select title, name, ip, date, contents, file from board where id = $num", $link);

        while($row = mysql_fetch_array($res)) {
                echo "<tr bgcolor = '#b8a9c9'><td width=120>제목 : </td><td bgcolor = '#d6d4e0'>$row[0]</td></tr>";
                echo "<tr bgcolor = '#b8a9c9'><td>작성자 : </td><td bgcolor = '#d6d4e0'>$row[1]</td></tr>";
                echo "<tr bgcolor = '#b8a9c9'><td>IP : </td><td bgcolor = '#d6d4e0'>$row[2]</td></tr>";
                echo "<tr bgcolor = '#b8a9c9'><td>작성일자 : </td><td bgcolor = '#d6d4e0'>$row[3]</td></tr>";
                echo "<tr bgcolor = '#b8a9c9'><td>내용 : </td><td height=150 bgcolor = '#d6d4e0'>$row[4]</td></tr>";
                echo "<tr bgcolor = '#b8a9c9'><td>이미지 : </td><td><img src='$row[5]' alt='이글에는 이미지가 없습니다!' height=150 weight=150 bgcolor = '#d6d4e0'></td></tr>";
        }

        echo "</table>";
        ?>
    </table>

    <?php
            $query = "select writer, contents, date from comment where id = '$num'";
            $res = mysql_query($query, $link);
            $comment_cnt=0;

            echo "<table align = center border='1' width=800>";
            while($row = mysql_fetch_array($res)) {
                echo "<tr>
                    <td width=120 bgcolor = '#b8a9c9'><b>$row[0]</b></td>
                    <td bgcolor = '#d6d4e0' width='360'>$row[1]</td>
                    <td bgcolor = '#d6d4e0'>$row[2]</td>
                      </tr>";
                $comment_cnt=$comment_cnt+1;
            }
            echo "<tr bgcolor = '#b8a9c9'><th>댓글 수</th><th>";
            echo $comment_cnt."</th>";
            echo "<td '#d6d4e0'>End of Search</td></tr>";         
            $comment_cnt=0;            

            echo "</table>";
            echo "<p align = center>";
            echo "<a href = 'comment_delete.php?num=$num'><button>댓글 삭제</button></a>";
            echo "<a href = 'comment_write.php?num=$num'><button>댓글 작성</button></a></p>";
    ?>



    <form>
        <br>
        <a href="board.php" style="color: white">[글목록]</a>
        <a href="boardwrite.php" style="color: white">[글쓰기]</a>
        <a href="boardedit.php" style="color: white">[글수정]</a>
        <a href="boarddel.php" style="color: white">[글삭제]</a>
    </form>

</body>

</html>
