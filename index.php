<?php
require('./helpers/getData.php');
$data = getData('./data/preguntas.json');
$preguntas = $data->preguntas;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Test sobre php">
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cuestionario sobre PHP</title>
</head>

<body>
    <main class="main-container">

        <form class="form-container" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <h1>Cuestionario sobre PHP</h1>
            <ol class="preguntas">
                <?php
                $total = 0;
                if ($preguntas && count($preguntas) > 0) :
                    foreach ($preguntas as $key => $pregunta) :
                ?>
                        <li>
                            <fieldset>
                                <legend><?= $pregunta->pregunta ?></legend>
                                <ul class="options">
                                    <?php
                                    foreach ($pregunta->opciones as $opcion) :
                                        $checked = '';
                                        $inputName = 'pregunta' . ($key + 1);
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST[$inputName]) && $_POST[$inputName] === $opcion) {
                                            $checked = 'checked';
                                            if ($_POST[$inputName] === $pregunta->respuesta_correcta) {
                                                $total++;
                                            }
                                        }
                                    ?>
                                        <li>
                                            <label><input <?= $checked ?> class="form-input" name="<?= $inputName ?>" type="radio" value="<?= $opcion; ?>"><?= $opcion; ?></label>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </fieldset>

                        </li>
                <?php
                    endforeach;
                endif;
                ?>

            </ol>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') :
            ?>
                <div role="alert" class="error-message">
                    Has acertado <?=$total?> preguntas/s.
                </div>
            <?php
            endif;
            ?>
            <button class="form-submit">Enviar respuestas</button>
        </form>
    </main>
</body>

</html>