<DOCTYPEhtml>
    <html>

    <head>
    </head>

    <style>
        body {
            background-image: url('dark_back.jpg');
            margin-left: auto;
            margin-right: auto;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        form {
            margin: 0 auto;
            width:250px;
        }



    </style>

    <body>
        <table>
            <tr bgcolor='lightblue'>
                    <th width = "70" height = "50">번호</th>
                    <th width = "500" height = "50">제목</th>
                    <th width = "120" height = "50">작성자</th>
                    <th width = "120" height = "50">작성일자</th>
                    <th width = "100" height = "50">조회수</th>
            </tr>

            <?php
            $de = $_POST['de'];
            $pw = $_POST['pw'];

            $link=mysql_connect("localhost","kimmije1009","mskimmije1009M") or die("Read DB Fail!");
            mysql_select_db("kimmije1009",$link);


            $q = "select id, title, name, date, search from board where id not in(0) order by id desc";
            $res = mysql_query($q,$link);

            while( $row=mysql_fetch_row($res) ) {
                echo "<tr bgcolor = '#cfe0e8'><td align = center>".$row[0]."</td>";
                echo "<td align = center><a href = 'boardread.php?num=$row[0]'>$row[1]</a></td>
                <td align = center>$row[2]</td>
                <td align = center>$row[3]</td>
                <td align = center>$row[4]</td>
                </tr>";
            }

           echo gettype($de);
            $de = $de-'0';
            echo gettype($de);
            echo $pw;


            if(($de!=0)&&($pw!=='')) {
                $q = "delete from board where id=$de and password ='$pw';";
                echo $q;
                $res = mysql_query($q,$link)or die("delete fail!")or die("delete fail!");
                echo("<script>location.href='board.php';</script>");
            }

            ?>
        </table>
        <form action="boarddel.php" method=post style="color: white">
            삭제할 번호(id)를 입력하세요: <input type=text name="de"><br>
            암호를 입력하세요: <input type=text name="pw"><br>
            <input type=submit>
            <br>
        </form>

        <form>
            <br>
            <a href="board.php" style="color: white">[글목록]</a>
            <a href="boardwrite.php" style="color: white">[글쓰기]</a>
            <a href="boarddel.php" style="color: white">[글삭제]</a>
        </form>
    </body>

    </html>
