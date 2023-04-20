
<?php
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
    $url = $_POST['url'];
    
    
}
 
 
 function getYouTubeVideoID($url) {
    $queryString = parse_url($url, PHP_URL_QUERY);
    parse_str($queryString, $params);
    if (isset($params['v']) && strlen($params['v']) > 0) {
        return $params['v'];
    } else {
        return "";
    }
}
 
  $api_key = 'AIzaSyAyS4POPx5hqvaHrvIFFdWwpUZ1XQQHEfg';
 
 
  $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . getYouTubeVideoID($url) . '&key=' . $api_key;
 
  $data = json_decode(file_get_contents($api_url));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информация О видеоролике с youtube</title>
    <style>
   body {
    background: #dbdbdb;
    color: red; 
    font-size: 40px;
   }
  </style>
</head>
<body>
    <form action="#" method="POST">
    <h1>Вставте ссылку на ролик с youtube</h1>
    <input type="text" name="url" paceholder="Enter video url">
    <input type="submit" name="submit" value="Отправить">
    </form>

    <hr>
  
    <table>
    <tr>
        <td>
            <img src="https://img.youtube.com/vi/api_url/0.jpg" alt="">
        </td>
    </tr>
        <tr>
            <td>Название канала:</td>
            <td><?php echo $data->items[0]->snippet->channelTitle ;?></td>
        </tr>
        <tr>
            <td>Название видеоролика:</td>
            <td><?php echo $data->items[0]->snippet->title;?></td>
        </tr>
        <tr>
            <td>Дата публикации:</td>
            <td><?php  echo $published = $data->items[0]->snippet->publishedAt;
            ?></td>
        </tr>
        <tr>
            <td>Продолжительность:</td>
            <td><?php $duration = $data->items[0]->contentDetails->duration;
             echo $duration;
            ?></td>
        </tr>
        <tr>
            <td>Количество просмотров:</td>
            <td><?php echo $data->items[0]->statistics->viewCount;?></td>
        </tr>
        <tr>
            <td>Количество лайков:</td>
            <td><?php echo $data->items[0]->statistics->likeCount;?></td>
        </tr>
    </table>
</body>
</html>
