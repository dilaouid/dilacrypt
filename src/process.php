<?php

function dilacrypt($key, $buffer, $mode)
{
    $lenkey = strlen($key);
    $data   = [];
    $j      = 0;
    for ($i=0;$i<strlen($buffer);$i++)
    {
        if ($lenkey == $j) $j = 0;
        if ($mode == ENCRYPT)
            $data[$i] = chr(ord($buffer[$i]) + ord($key[$j]) + strlen($key));
        else if ($mode == DECRYPT)
            $data[$i] = chr(ord($buffer[$i]) - ord($key[$j]) - strlen($key));
        $j++;
    }
    return implode('', $data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $path       = $_FILES["file"]["tmp_name"];
    $key        = trim($_POST['key']);
    $contents   = file_get_contents($path);

    $fileError = $_FILES["file"]["error"];
    switch($fileError) {
        case UPLOAD_ERR_INI_SIZE:
            throw new Exception(MAX_SIZE);
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception(NO_FILE_UPLOADED);
            break;
        case UPLOAD_ERR_CANT_WRITE:
            throw new Exception(CANT_WRITE);
            break;
        default:
            break;
    }
    if (strlen($key) < 1 || strlen($contents) < 1)
        throw new Exception(WRONG_LENGTH);
    if (!in_array($_POST['extension'], EXTENSIONS))
        throw new Exception(WRONG_EXTENSION);
    else
        $ext = $_POST['extension'];
    
    $uploadFilename = $_FILES['file']['name'];
    if ($_POST['mode'] == ENCRYPT) {
        $options = [
            "filename" => pathinfo($uploadFilename, PATHINFO_FILENAME) . '.dea',
            "mode"     => ENCRYPT,
            'contents' => base64_encode($contents),
        ];
    } else if ($_POST['mode'] == DECRYPT) {
        if (pathinfo($uploadFilename)['extension'] !== 'dea') {
            throw new Exception(WRONG_DECRYPT_EXTENSION);
        }
        $options = [
            "filename" => pathinfo($uploadFilename, PATHINFO_FILENAME) . '.' . $ext,
            "mode"     => DECRYPT,
            'contents' => $contents,
        ];
    } else {
        throw new Exception(WRONG_MODE);
    }
    $contents   = dilacrypt(trim($_POST['key']), $options['contents'], $options['mode']);
    if ($options['mode'] == DECRYPT) {
        $contents = base64_decode($contents);
    }

    header("Content-type: text/plain");
    header("Content-Disposition: attachment; filename=" . $options['filename']);
    echo $contents;
    exit();
}