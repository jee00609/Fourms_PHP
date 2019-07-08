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
<head>
    <form>
        <h1 style="color:white;">EDIT</h1>
    <hr>
    </form>

    <table boarder=1 width=1000>
        <tr bgcolor='#c0ded9'>
            <th width="70" height="50">번호</th>
            <th width="500" height="50">제목</th>
            <th width="120" height="50">작성자</th>
            <th width="120" height="50">작성일자</th>
            <th width="100" height="50">조회수</th>
        </tr>
        <?php
        $link=mysql_connect("localhost","kimmije1009","mskimmije1009M") or die("Read DB Fail!");
        mysql_select_db("kimmije1009",$link);

        $q = "select id, title, name, date, search from board order by id asc";
        $res = mysql_query($q,$link);


        while( $row=mysql_fetch_row($res) ) {
            echo "<tr bgcolor = '#eaece5' ><td>".$row[0]."</td>";
            echo "<td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
        }

        $find_p = "select id, password, name from board order by id asc";
        $find_p_res = mysql_query($find_p,$link);

        while( $row=mysql_fetch_row($find_p_res) ) {
            $pass_arr[$pass_num]=$row[1];
            $pass_num++;

            $name_arr[$name_num]=$row[2];
            $name_num++;
        }



        echo "<br>";
        ?>
    </table>


    <form name='my_form' enctype="multipart/form-data" action="boardedit.php" method="POST">
        <script>
            document.write("<table width = 800 height = 200>");
            document.write("<tr><td bgcolor='#c0ded9' width ='100'>번호이름 : </td><td><input type='text' name='id' /></td></tr>");

            document.write("<tr><td bgcolor='#c0ded9'>제목: </td><td><input type='text' name='title' /></td></tr>");
            document.write("<tr><td bgcolor='#c0ded9' height = '400'>내용 : </td><td><textarea name = content rows=\"26\" cols=\"22\" bgcolor=\"white\"></textarea></td></tr>");
            document.write("<tr><td bgcolor='#c0ded9'>파일: </td><td><input type='hidden' name='MAX_FILE_SIZE' value='80000' /><input name='userfile' type='file' /></td></tr>")
            document.write("<tr><td bgcolor='#c0ded9'>비밀번호 : </td><td><input type='password' name='password'/></td></tr>");
            document.write("</table>");

            document.write("<br>");
            document.write("<input type= button value=\"취소\" onClick = \" location.href='board.php'\">");
            document.write("<input type = submit />");
        </script>
    </form>

</head>

<body>
    <?php
    $link=mysql_connect("localhost","kimmije1009","mskimmije1009M") or die("Read DB Fail!");
    mysql_select_db("kimmije1009",$link);


    $find_p = "select id, password, name from board order by id asc";
    $find_p_res = mysql_query($find_p,$link);

    $id_arr = array();
    $id_num=0;

    $pass_arr = array();
    $pass_num=0;

    $name_arr = array();
    $name_num =0;

    while( $row=mysql_fetch_row($find_p_res) ) {
        $id_arr[$id_num] = $row[0];
        $id_num++;

        $pass_arr[$pass_num]=$row[1];
        $pass_num++;

        $name_arr[$name_num]=$row[2];
        $name_num++;
    }

    $sum = $pass_num;

    date_default_timezone_set('Asia/Seoul');
    $date = Date("Y/n/j, H:i:s D");
    $ip = $_SERVER["REMOTE_ADDR"];

    $id = $_POST['id'];


    $title = $_POST['title'];
    $content = $_POST['content'];
    $password = $_POST['password'];

    echo $date."<br>";
    echo $ip;
    echo "<br>";

    if($id != '')echo "<br>id: ".$id."<br>"; else echo "no id!";

    if($title != '')echo "<br>title: ".$title."<br>"; else echo "no title";
    if($content != '')echo "<br>content: ".$content."<br>"; else echo "no content";
    if($password != '')echo "<br>password: ".$password."<br>"; else echo "no password";

//    for($i=0;$i<$sum;$i++){
//        echo "pass_arrrrrrrr->".$pass_arr[$i]."<br>";
//    }

    $id_solution;
    $pass_solution;
    $name_solution;

    $id_pos = array_search($id, $id_arr);
    if ($id_pos !== false) {
//        echo "Stefanie Mcmohn found at $id_pos";
        $id_solution = $id_pos;
        $name_solution = $id_pos;
    }


    $pass_pos = array_search($password, $pass_arr);
    if ($pass_pos !== false) {
//        echo "Stefanie Mcmohn found at $pass_pos";
        $pass_solution = $pass_pos;
    }

//    echo "<br>id_arr[pass_num]: ".$id_arr[$id_solution];
//    echo "<br>pass_arr[pass_num]: ".$pass_arr[$pass_solution];
//    echo "<br>name_arr[pass_num]: ".$name_arr[$name_solution];

    $name = $name_arr[$name_solution];
    
    ini_set("display_errors", "1");
    $uploaddir = '/home/student/kimmije1009/public_html/project/';
    $uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
    echo '<pre>';
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
    } else {
        print "파일 업로드 공격의 가능성이 있습니다!\n";
    }
    echo '자세한 디버깅 정보입니다:';
    $file=$_FILES['userfile']['name'];

    print_r($_FILES);
    print "</pre>";
    
    $filestring = "'".$file."'";

    if(($id == $id_arr[$id_solution]) && ($title != '') && ($content != '') && ($password == $pass_arr[$pass_solution])){

        $res = mysql_query("UPDATE `board` SET `name`='$name',`title`='$title',`contents`='$content',`ip`='$ip',`date`='$date',`file`=$filestring WHERE id = $id;",$link) or die("update fail!");
        echo("<script>location.href='board.php';</script>");
    }
    else{
        echo "<br>You should write all thing!<br>";
    }


    ?>
</body>

</html>
