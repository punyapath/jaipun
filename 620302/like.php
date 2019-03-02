<? 
    include ('db_config.php');
if (isset($_GET['liked'])) {
    $postid = $_GET[content_id];
    $result = $conn->query("SELECT * FROM tblcontent WHERE content_id=$postid");
    $row = $result->fetch_assoc();
    $n = $row['contentLike'];

    if (getenv(HTTP_X_FORWARDED_FOR))
    $ip=getenv(HTTP_X_FORWARDED_FOR);
    else
    $ip=getenv(REMOTE_ADDR);


    $conn->query( "INSERT INTO tbllike (user_ip, content_id) VALUES ('$ip', $postid)");
    $conn->query( "UPDATE tblcontent SET contentLike=$n+1 WHERE content_id=$postid");

    echo $n+1;
    exit();
}

?>