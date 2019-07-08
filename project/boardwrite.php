<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
            <style>
                head {
                    margin-left: auto;
                    margin-right: auto;
                }
                
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
<!--
        <table width = 800 height = 200>
            <tr><td bgcolor='yellow' width ='100'>작성자 : </td><td><input type='text' name='name' /></td></tr>
            <tr><td bgcolor='yellow'>제목: </td><td><input type='text' name='title' /></td></tr>
            <tr><td bgcolor='yellow' height = '400'>내용 : </td><td><input type='text' name='content'/></td></tr>
            <tr><td bgcolor='yellow'>비밀번호 : </td><td><input type='password' name='password'/></td></tr>
        </table>
-->
            
        
        <form name='my_form' enctype="multipart/form-data" action="boardwrite.php" method="POST">
            <h1>Write</h1>
            <hr>
            <script>
                //<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                //<input name="userfile" type="file" />
                
                document.write("<table width = 800 height = 200>");
                document.write("<tr><td bgcolor='yellow' width ='100'>작성자 : </td><td><input type='text' name='name' /></td></tr>");
                document.write("<tr><td bgcolor='yellow'>제목: </td><td><input type='text' name='title' /></td></tr>");
                document.write("<tr><td bgcolor='yellow' height = '400'>내용 : </td><td><textarea placeholder=\"이미지 파일-PNG/JPG-이 크면 들어가지 않습니다.\" name = content rows=\"26\" cols=\"22\" bgcolor=\"white\"></textarea></td></tr>");
                document.write("<tr><td bgcolor='yellow'>파일: </td><td><input type='hidden' name='MAX_FILE_SIZE' value='80000' /><input name='userfile' type='file' /></td></tr>");
                document.write("<tr><td bgcolor='yellow'>비밀번호 : </td><td><input type='password' name='password'/></td></tr>");
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
    
    $q = "select id, title, name, date, search from board order by id asc";
    $res = mysql_query($q,$link);
    
    while( $row=mysql_fetch_row($res) ) {
        $id = $row[0];
    }
    $id=$id+1;
    
    date_default_timezone_set('Asia/Seoul');
    $date = Date("Y/n/j, H:i:s D");
    $ip = $_SERVER["REMOTE_ADDR"];
    
    $name = $_POST['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $password = $_POST['password'];
    
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
    
    echo $id;
    echo "<br>";
    echo $date;
    echo $ip;
    echo "<br>";
    
//    if($name != '')echo $name; else echo "no name";
//    if($title != '')echo $title; else echo "no title";
//    if($content != '')echo $content; else echo "no content";
//    if($password != '')echo $password; else echo "no password";
    
//    $s_name = "'".$name."'";
//    $s_title = ".".$title."'";
//    $s_content = ".".$content."'";
//    $s_password = ".".$password."'";
    echo "<br>".$file;
    $filestring = "'".$file."'";

    if(($name != '') && ($title != '') && ($content != '') && ($password != '')){
        
        //INSERT INTO `kimmije1009`.`board` (`id`, `name`, `password`, `title`, `contents`, `ip`, `date`, `search`, `file`) VALUES ('', '$name', '$password', '$title', '$content'', '$ip', '$date', '0', '');
        //$query = "insert into board(name, password, title, contents, ip, date, search) values('$name', '$password', '$title', '$content', '$ip', '$date', '0')";
        //->this is not work!
        echo "<br>".$filestring;
        $res = mysql_query("INSERT INTO `board`(`id`, `name`, `password`, `title`, `contents`, `ip`, `date`, `search`, `file`) VALUES ($id,'$name', '$password', '$title', '$content', '$ip', '$date', '0',$filestring)",$link) or die("insert fail!");
        echo("<script>location.href='board.php';</script>");
    }
    else{
        echo "<br>You should write all thing!<br>";
    }
    
    

    
    //echo("<script>location.href='board.php';</script>");

    
    ?>
</body>
</html>
