<html>
    <head>
        <title>Australia's random pictures</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>
        <h1>Australia's chat</h1><br />don't forget me, <a href="index.php">look at my pictures</a>


        <?php
        include 'smile.php';
        $sep_message = '::@@::@@::';
        $sep_name = '::__::__::';
        $nbPerPage = 20;
        function print_pages($total)
        {
            global $nbPerPage;
            $res = '';

            if (!isset($_GET['page'])) {
                $_GET['page'] = ceil($total / $nbPerPage);
            }

            $res .= 'pages: ' . ($_GET['page'] > 1 ? '<a href="chat.php?page=' . ($_GET['page'] - 1) . '"><<</a>' : '<<');
            for ($i = 1; $i <= ceil($total / $nbPerPage); ++$i) {
                if ($i == $_GET['page']) {
                    $res .= ' ' . $i;
                } else {
                    $res .= ' <a href="chat.php?page=' . $i . '">' . $i . '</a>';
                }
            }

            $res .= ' ' . ($_GET['page'] < ceil($total / $nbPerPage) ? '<a href="chat.php?page=' . ($_GET['page'] + 1) . '">>></a>' : '>>');

            return $res;
        }

        if (file_exists('chat.txt')) {
            $messages = explode($sep_message, implode(file('chat.txt'), ''));

            echo '<table width="90%">';
            echo '<tr><td colspan="3" style="background-color: white; text-align: center;">' . print_pages(count($messages)) . '</td><tr>';
            $i = 0;
            $first = $nbPerPage * ($_GET['page'] - 1);
            $last = $nbPerPage * $_GET['page'];

            $nicks = [];
            foreach ($messages as $line) {
                $array = explode($sep_name, $line);
                $nicks[$array[1]] = $array[1];
            }
            sort($nicks);
            $newNicks = [];
            foreach ($nicks as $x => $n) {
                $newNicks[$x] = '<span class="nickname">' . $n . '</span>';
            }

            echo '<tr><td colspan="3" style="background-color: white; text-align: center;">' . print_pages(count($messages)) . '</td><tr>';
            echo '</table>';
            foreach ($nicks as $n) {
                echo $n . '<br />';
            }
        }
        ?>
    </body>
</html>
