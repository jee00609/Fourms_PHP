<DOCTYPEhtml>
<html>

    <style>
        body {
            background-image: url('cool-background_6');
        }

        table {
            margin-left:auto;
            margin-right:auto;
            opacity: 0.7;
        }
        p{
            text-align: center;
        }


    </style>
    <head>
        <h3 align="center">
            <font color="white" size="10">Board</font>
        </h3>
    </head>

    <body>
        <audio src="icepond.mp3" controls loop autoplay>Your browser does not su                                                                                                             pport the audio element.</audio>
        <table boarder=1 width=1000 center>
            <tr bgcolor='#92a8d1'>
                <th width="70" height="50">번호</th>
                <th width="500" height="50">제목</th>
                <th width="120" height="50">작성자</th>
                <th width="120" height="50">작성일자</th>
                <th width="100" height="50">조회수</th>
            </tr>

            <?php
            $link = mysql_connect('localhost', 'kimmije1009', 'mskimmije1009M');
            mysql_select_db('kimmije1009', $link);


            $page = $_GET["page"];
            $view = 10;

            if($page == "" || $page == "1"){
                $page1=0;
            }
            else{
                $page1 = ($page*$view)-$view;
            }

            $q = "select id, title, name, date, search from board limit 1";
            $res = mysql_query($q,$link);

            while( $row=mysql_fetch_row($res) ) {
                echo "<tr bgcolor = '#c83349' ><td>".$row[0]."</td>";
                echo "<td><a href = 'boardread.php?num=$row[0]'>$row[1]</a></td>                                                                                                             <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
            }

            $q = "select id, title, name, date, search from board where not id=0                                                                                                              order by id asc limit $page1,$view";
            $res = mysql_query($q,$link);
            $cou=0;

            while( $row=mysql_fetch_row($res) ) {
                echo "<tr bgcolor = '#f4e1d2' ><td>".$row[0]."</td>";
                echo "<td><a href = 'boardread.php?num=$row[0]'>$row[1]</a></td>                                                                                                             <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
            }
            ?>
        </table>

        <?php

        $res1 = mysql_query("select * from board");
        $cou = mysql_num_rows($res1);

        $a = $cou/$view;
        $a = ceil($a);
        //echo $a;

        echo "<br>";
        echo "<br>";

        echo "<table align='center' bgcolor = 'white'><tr><th>";
        for($b=1;$b<=$a;$b++){
            ?><a href="board.php?page=<?php echo $b; ?>" style="text-decoration:                                                                                                             none "><?php echo $b." "; ?></a><?php
        }

        echo "</th></tr></table>";
        ?>
        <p>
            <a href="./boardwrite.php"><button>글쓰기</button></a>
            <a href="./boardedit.php"><button>글수정</button></a>
            <a href="./boarddel.php"><button>글삭제</button></a>
            <a href="./Calendar.php"><button>달력</button></a>
        </p>

    </body>
</html>
