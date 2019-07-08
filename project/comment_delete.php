<DOCTYPEhtml>
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
            width:1000px;
            text-align: center;
        }



    </style>
    <head>
        <form>
        <h3><font color="white">Comment Delete</font></h3><hr>
        </form>
        <?php
        $link=mysql_connect("localhost","kimmije1009","mskimmije1009M") or die("Read DB Fail!");
        mysql_select_db("kimmije1009",$link);

        $num = $_GET['num'];

        echo "num:".$num."<br>";

        $save_n =$num;

        ?>
        <form action="comment_delete.php" method=GET style="color: white">
            <table border = 1>
                <tr bgcolor='#92a8d1'>
                    <th width="70" height="50">번호</th>
                    <th width="120" height="50">작성자</th>
                    <th width="120" height="50">내용</th>
                    <th width="100" height="50">날짜</th>
                </tr>
                    <?php
                    //"select * from comment where id=$num ";
                    $q = "select no, writer, contents, date from comment where id=$num order by id desc";
                    $res = mysql_query($q,$link);

                    while( $row=mysql_fetch_row($res) ) {
                        echo "<tr bgcolor = '#cfe0e8'><td align = center>".$row[0]."</td>";
                        echo "<td align = center><a href = 'boardread.php?num=$row[0]'>$row[1]</a></td>
                        <td align = center>$row[2]</td>
                        <td align = center>$row[3]</td>
                        </tr>";
                    }

                    ?>
            </table>
            <br>
            삭제할 번호(no)를 입력하세요: <input type=text name="de"><br>
            암호를 입력하세요: <input type=text name="pw"><br>
            <input type = button value='취소-보드로 나가기'onclick="location.href='board.php'">
            <input type=submit>
        </form>
    </head>

    <body>
        <?php
        $de = $_GET['de'];
        $pw = $_GET['pw'];

        echo $de;
        echo $pw;

        $link=mysql_connect("localhost","kimmije1009","mskimmije1009M") or die("Read DB Fail!");
        mysql_select_db("kimmije1009",$link);


        if(($de!=0)&&($pw!='')) {
            $q = "delete from comment where no=$de and password ='$pw';";
            echo $q;
            $res = mysql_query($q,$link)or die("delete fail!");
            echo("<script>location.href='board.php';</script>");
        }


        ?>

    </body>

    </html>
