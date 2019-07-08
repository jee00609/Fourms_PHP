<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('cool-background_6');
        }

        td {
            text-align: center;
        }

        form {
            margin: 0 auto;
            width:1000px;
            text-align: center;
        }

        table {
            margin-left:auto;
            margin-right:auto;
        }

    </style>
    <h1 align = center><font color="white">comment write</font></h1>
    <hr>
    <?php
    $link = mysql_connect('localhost', 'kimmije1009', 'mskimmije1009M');
    mysql_select_db('kimmije1009', $link);

    date_default_timezone_set('Asia/Seoul');
    $date = Date("Y/n/j");

    $num = $_GET['num'];


    $res = mysql_query("select title, name, ip, date, contents, file from board where id = $num", $link);

    echo "<table>";
    while($row = mysql_fetch_array($res)) {
            echo "<tr bgcolor = '#fe6f5e'><td width=120>제목 : </td><td bgcolor = 'white'>$row[0]</td></tr>";
            echo "<tr bgcolor = '#fe6f5e'><td>작성자 : </td><td bgcolor = 'white'>$row[1]</td></tr>";
            echo "<tr bgcolor = '#fe6f5e'><td>IP : </td><td bgcolor = 'white'>$row[2]</td></tr>";
            echo "<tr bgcolor = '#fe6f5e'><td>작성일자 : </td><td bgcolor = 'white'>$row[3]</td></tr>";
            echo "<tr bgcolor = '#fe6f5e'><td>내용 : </td><td height=150 bgcolor = 'white'>$row[4]</td></tr>";
            echo "<tr bgcolor = '#fe6f5e'><td>이미지 : </td><td><img src='$row[5]' alt='NO Image' height=150 weight=150 bgcolor = 'white'></td></tr>";
    }

        echo "</table>";

    $query = "select writer, contents, date from comment where id = '$num'";
    $res = mysql_query($query, $link);

    echo "<table align = center border='1' width=800>";
    while($row = mysql_fetch_array($res)) {
        echo "<tr>
            <td width=120 bgcolor = '#fe6f5e'><b>$row[0]</b></td>
            <td bgcolor = 'white' width='360'>$row[1]</td>
            <td bgcolor = 'white'>$row[2]</td>
              </tr>";
    }

            echo "</table>";

//    echo "num:".$num."<br>";

    $save_n =$num;
    ?>

    <form action='comment_write.php' method="GET">
        <script>
            var string_num = <?= $save_n ?>;
            var jsint_num = parseInt(string_num);
//            document.write(string_num);
//            document.write(typeof(jsint_num));


            document.write("<table border='1' align=center>");

            document.write("<tr align=center>");
            document.write("<td bgcolor='#fe6f5e' width ='80'>글번호 : </td><td><input type='text' name='id' value='"+jsint_num+"' readonly/></td>");
            document.write("</tr>");

            document.write("<tr align=center>");
            document.write("<td bgcolor='#fe6f5e' width ='80'>작성자 : </td><td><input type='text' name='writer' /></td>");
            document.write("</tr>");

            document.write("<tr align=center>");
            document.write("<td bgcolor='#fe6f5e'>비밀번호 : </td><td><input type='password' name='password'/></td>");
            document.write("</tr>");

            document.write("<tr>");
            document.write("<td bgcolor='#fe6f5e'>내용 : </td>");
            document.write("<td><input type='text' name='content' width='400'></td>");
            document.write("</tr>");

            document.write("</table>");
            document.write("<input type= button value='취소' onClick = location.href='boardread.php?num="+string_num+"'>");
            document.write("<input type='submit' name='re'>");
        </script>
    </form>
</head>
<body>
    <?php
        $link=mysql_connect("localhost","kimmije1009","mskimmije1009M") or die("Read DB Fail!");
        mysql_select_db("kimmije1009",$link);

        $q = "select no from comment order by no asc";
        $res = mysql_query($q,$link);
        $no=0;
        while( $row=mysql_fetch_row($res) ) {
            $no = $row[0];
        }
        $no=$no+1;

        $intnum = $_GET['id'];
        $writer = $_GET['writer'];
        $password = $_GET['password'];
        $content = $_GET['content'];

//        echo $intnum;
//        echo "<br>".$intnum;
//        echo gettype($intnum);
//        if($intnum != '')echo $name; else echo "no name<br>";
//        if($writer != '')echo $title; else echo "no title<br>";
//        if($content != '')echo $content; else echo "no content<br>";
//
//        if($password != '')echo $password; else echo "no password<br>";
//        echo $intnum;


        if(($writer != '') && ($password != '') && ($content != '')) {

            //$top =  mysql_query("INSERT INTO content_count (content , count) VALUES ($search_text,1) ON DUPLICATE KEY UPDATE count=count+1;", $link) or die("insert content_count fail!");
            $result = mysql_query("INSERT INTO `comment`(`no`,`id`, `writer`, `password`, `contents`, `date`) VALUES ($no,'$intnum', '$writer', '$password', '$content', '$date') ON DUPLICATE KEY UPDATE no=no+1;", $link) or die("Insert comment Failed");

             echo("<script>location.href='board.php?num=$intnum';</script>");
        }
    ?>
</body>
</html>
