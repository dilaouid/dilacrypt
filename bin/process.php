<?php

function dilacrypt($key, $buffer, $mode)
{
    if (strlen($key) < 1 || strlen($buffer) < 1)
        return null;
    $lenkey = strlen($key);
    $data   = [];
    $j      = 0;
    for ($i=0;$i<strlen($buffer);$i++)
    {
        if (!in_array($mode, [ENCRYPT, DECRYPT]))
            return null;
        if ($lenkey == $j) $j = 0;
        if ($mode == ENCRYPT)
            $data[$i] = chr(ord($buffer[$i]) + ord($key[$j]) + strlen($key));
        else if ($mode == DECRYPT)
            $data[$i] = chr(ord($buffer[$i]) - ord($key[$j]) - strlen($key));
        $j++;
    }
    return implode('', $data);
}

if (isset($_POST['submit'])) {
    $path       = $_FILES["file"]["tmp_name"];
    $key        = trim($_POST['key']);
    $contents   = file_get_contents($path);

    if (strlen($key) < 1 || strlen($contents) < 1)
        throw new Exception(WRONG_LENGTH);
    if (!in_array($_POST['extension'], EXTENSIONS))
        throw new Exception(WRONG_EXTENSION);
    else
        $ext = $_POST['extension'];

    if ($_POST['mode'] == ENCRYPT) {
        $options = [
            "filename" => pathinfo($_FILES['file']['name'], PATHINFO_FILENAME) . '.dea',
            "mode"     => ENCRYPT,
            'contents' => base64_encode($contents),
        ];
    } else if ($_POST['mode'] == DECRYPT) {
        $options = [
            "filename" => pathinfo($_FILES['file']['name'], PATHINFO_FILENAME) . '.' . $ext,
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